<?php
session_start();
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
include('db.php');

if (empty($correo)) {
    die(json_encode(['error' => 'No autenticado']));
}

$datos = json_decode(file_get_contents("php://input"), true);

if (!$datos) {
    die(json_encode(['error' => 'Datos inválidos']));
}

// Validate and get data
$usu = isset($datos['usuario']) ? trim($datos['usuario']) : '';
$gen = isset($datos['genero']) ? trim($datos['genero']) : '';
$fna = isset($datos['fnac']) ? trim($datos['fnac']) : '';

if (empty($usu) || empty($gen) || empty($fna)) {
    die(json_encode(['error' => 'Todos los campos son requeridos']));
}

// Use prepared statement for UPDATE
$stmt = $conexion->prepare("UPDATE usuario SET nUsuario = ?, fNacU = ?, generoU = ? WHERE emailU = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conexion->error);
    die(json_encode(['error' => 'Error en la consulta']));
}

$stmt->bind_param("ssss", $usu, $fna, $gen, $correo);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Se ha actualizado correctamente la información']);
} else {
    error_log("Update failed: " . $stmt->error);
    echo json_encode(['error' => 'Error al actualizar el registro']);
}

$stmt->close();
mysqli_close($conexion);
?>