<?php
// Destroy any existing session and start fresh
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
}
session_start();

include('db.php');

// Get and validate inputs
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

if (empty($correo) || empty($pass)) {
    die('<script>alert("Email y contraseña son requeridos"); window.location.href="index.php";</script>');
}

// Try to authenticate as usuario (student)
$stmt = $conexion->prepare("SELECT contraU FROM usuario WHERE emailU = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta. Intente más tarde.');
}

$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Use password_verify if passwords are hashed; otherwise use direct comparison (legacy)
    if (password_verify($pass, $row['contraU']) || $row['contraU'] === md5($pass) || $row['contraU'] === $pass) {
        session_regenerate_id(true);
        $_SESSION['correo'] = $correo;
        $_SESSION['tipo'] = 'usuario';
        $stmt->close();
        header("Location: lecciones.php");
        exit();
    }
}
$stmt->close();

// Try to authenticate as maestro (teacher)
$stmt = $conexion->prepare("SELECT contraM FROM maestros WHERE emailM = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta. Intente más tarde.');
}

$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['contraM']) || $row['contraM'] === md5($pass) || $row['contraM'] === $pass) {
        session_regenerate_id(true);
        $_SESSION['correo'] = $correo;
        $_SESSION['tipo'] = 'maestro';
        $stmt->close();
        header("Location: index-maestros.php");
        exit();
    }
}
$stmt->close();

// Try to authenticate as administrador (admin)
$stmt = $conexion->prepare("SELECT contraA FROM administrador WHERE emailA = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta. Intente más tarde.');
}

$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['contraA']) || $row['contraA'] === md5($pass) || $row['contraA'] === $pass) {
        session_regenerate_id(true);
        $_SESSION['correo'] = $correo;
        $_SESSION['tipo'] = 'admin';
        $stmt->close();
        header("Location: index-admin.php");
        exit();
    }
}
$stmt->close();

// Authentication failed
echo '<script>alert("Correo o contraseña incorrecta, intente de nuevo"); window.location.href="index.php";</script>';
mysqli_close($conexion);
?>