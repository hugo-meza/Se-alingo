<?php
session_start();

// Validate user is logged in
if (empty($_SESSION['correo'])) {
    die(json_encode(['error' => 'No autenticado']));
}

// Validate and sanitize idNivel
$idNivel = isset($_POST['idNivel']) ? (int)$_POST['idNivel'] : 0;

if ($idNivel > 0) {
    // Validate that the level exists
    include('db.php');
    
    $stmt = $conexion->prepare("SELECT idNivel FROM niveles WHERE idNivel = ?");
    if ($stmt) {
        $stmt->bind_param("i", $idNivel);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Level exists, save to session
            $_SESSION['idNivel'] = $idNivel;
            echo json_encode(['success' => 'Sesión actualizada correctamente con idNivel: ' . $idNivel]);
        } else {
            echo json_encode(['error' => 'Nivel no encontrado']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Error en la consulta']);
    }
    mysqli_close($conexion);
} else {
    echo json_encode(['error' => 'idNivel inválido']);
}
?>
