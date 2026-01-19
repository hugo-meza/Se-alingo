<?php
include('db.php');

// Get and validate inputs
$correo = isset($_POST['email']) ? trim($_POST['email']) : '';
$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$pass = isset($_POST['pass2']) ? $_POST['pass2'] : '';
$genero = isset($_POST['genero']) ? $_POST['genero'] : '';
$fNac = isset($_POST['fNac']) ? $_POST['fNac'] : '';

if (empty($correo) || empty($usuario) || empty($pass) || empty($genero) || empty($fNac)) {
    die('<script>alert("Todos los campos son requeridos"); window.location.href="index.php";</script>');
}

// Validate password: min 8 chars, 1 uppercase, 1 number
if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $pass)) {
    die('<script>alert("La contraseña no cumple con las condiciones (mínimo 8 caracteres, una mayúscula y un número)"); window.location.href="index.php";</script>');
}

$img = 'images/Perfil/sam.png';

// Check if email already exists (using prepared statement)
$stmt = $conexion->prepare("SELECT emailU FROM usuario WHERE emailU = ? UNION SELECT emailA FROM administrador WHERE emailA = ? UNION SELECT emailM FROM maestros WHERE emailM = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta. Intente más tarde.');
}
$stmt->bind_param("sss", $correo, $correo, $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $stmt->close();
    die('<script>alert("Ya existe una cuenta con tal correo"); window.location.href="index.php";</script>');
}
$stmt->close();

// Check if username already exists
$stmt = $conexion->prepare("SELECT nUsuario FROM usuario WHERE nUsuario = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die('Error en la consulta. Intente más tarde.');
}
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $stmt->close();
    die('<script>alert("Ya existe una cuenta con tal usuario"); window.location.href="index.php";</script>');
}
$stmt->close();

// Start transaction for registration
mysqli_begin_transaction($conexion);
try {
    // Insert usuario
    $stmt = $conexion->prepare("INSERT INTO usuario (emailU, contraU, fNacU, nUsuario, imagenU, generoU) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conexion->error);
    }
    $stmt->bind_param("ssssss", $correo, $pass, $fNac, $usuario, $img, $genero);
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar usuario: " . $stmt->error);
    }
    $stmt->close();

    // Insert resena
    $stmt = $conexion->prepare("INSERT INTO resena (puntaje, descRes, encabezado, emailU) VALUES (NULL, NULL, NULL, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conexion->error);
    }
    $stmt->bind_param("s", $correo);
    if (!$stmt->execute()) {
        throw new Exception("Error al insertar reseña: " . $stmt->error);
    }
    $stmt->close();

    // Get all levels and insert accede records
    $stmt = $conexion->prepare("SELECT idNivel FROM niveles");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conexion->error);
    }
    $stmt->execute();
    $resultadoNiv = $stmt->get_result();

    if ($resultadoNiv->num_rows > 0) {
        $stmtAccede = $conexion->prepare("INSERT INTO accede (sumatoria, pMax, veces, emailU, idNivel) VALUES (0, 0, 0, ?, ?)");
        if (!$stmtAccede) {
            throw new Exception("Prepare failed: " . $conexion->error);
        }
        while ($filaNiv = $resultadoNiv->fetch_assoc()) {
            $idNivel = $filaNiv['idNivel'];
            $stmtAccede->bind_param("si", $correo, $idNivel);
            if (!$stmtAccede->execute()) {
                throw new Exception("Error al insertar acceso a nivel: " . $stmtAccede->error);
            }
        }
        $stmtAccede->close();
    }
    $stmt->close();

    // Commit transaction
    mysqli_commit($conexion);

    // Destroy any existing session and create a fresh one
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    session_start();
    session_regenerate_id(true);
    $_SESSION['correo'] = $correo;
    header("Location: lecciones.php");
    exit();

} catch (Exception $e) {
    // Rollback on error
    mysqli_rollback($conexion);
    error_log("Registration error: " . $e->getMessage());
    die('<script>alert("Error al registrarse: ' . htmlspecialchars($e->getMessage()) . '"); window.location.href="index.php";</script>');
}

mysqli_close($conexion);
?>