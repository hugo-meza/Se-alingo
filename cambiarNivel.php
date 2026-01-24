<?php
session_start();

// Validate user is logged in
if (empty($_SESSION['correo'])) {
    die('Error: Usuario no autenticado');
}

// Validate and sanitize GET parameter
$n = isset($_GET['nivel']) ? (int)$_GET['nivel'] : 0;

if ($n <= 0) {
    die('Error: Nivel inválido');
}

include('db.php');

// Use prepared statement
$stmt = $conexion->prepare("SELECT idNivel FROM niveles WHERE idNivel = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta');
}

$stmt->bind_param("i", $n);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['idNivel'] = $n;
    $stmt->close();
    header("Location: Nivel.php");
    exit();
} else {
    $stmt->close();
    die('Error: Nivel no encontrado');
}

mysqli_close($conexion);
?>