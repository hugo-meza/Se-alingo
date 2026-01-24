<?php
session_start();

// Validate user is logged in
if (empty($_SESSION['correo']) || empty($_SESSION['idNivel']) || !isset($_SESSION['puntos'])) {
    die('Error: Sesión inválida');
}

$c = $_SESSION['correo'];
$n = (int)$_SESSION['idNivel'];
$pts = (int)$_SESSION['puntos'];

include('db.php');

// Use prepared statement to get current data
$stmt = $conexion->prepare("SELECT pMax FROM accede WHERE emailU = ? AND idNivel = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta');
}

$stmt->bind_param("si", $c, $n);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    $pMax = $fila['pMax'];
    
    // Update pMax if new score is higher
    if ($pMax < $pts) {
        $pMax = $pts;
    }
    
    $stmt->close();
    
    // Start transaction
    mysqli_begin_transaction($conexion);
    try {
        // Update accede table
        $stmtUpdate = $conexion->prepare("UPDATE accede SET sumatoria = sumatoria + ?, pMax = ?, veces = veces + 1 WHERE emailU = ? AND idNivel = ?");
        if (!$stmtUpdate) {
            throw new Exception("Prepare failed: " . $conexion->error);
        }
        
        $stmtUpdate->bind_param("iisi", $pts, $pMax, $c, $n);
        if (!$stmtUpdate->execute()) {
            throw new Exception("Error updating accede: " . $stmtUpdate->error);
        }
        $stmtUpdate->close();
        
        // Update niveles table
        $stmtNiv = $conexion->prepare("UPDATE niveles SET vecesJugado = vecesJugado + 1, sumaPts = sumaPts + ? WHERE idNivel = ?");
        if (!$stmtNiv) {
            throw new Exception("Prepare failed: " . $conexion->error);
        }
        
        $stmtNiv->bind_param("ii", $pts, $n);
        if (!$stmtNiv->execute()) {
            throw new Exception("Error updating niveles: " . $stmtNiv->error);
        }
        $stmtNiv->close();
        
        // Commit transaction
        mysqli_commit($conexion);
        
    } catch (Exception $e) {
        // Rollback on error
        mysqli_rollback($conexion);
        error_log("Update error: " . $e->getMessage());
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Error: No se encontraron datos del usuario en este nivel";
    $stmt->close();
}

mysqli_close($conexion);
?>