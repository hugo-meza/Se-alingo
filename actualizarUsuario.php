<?php
    session_name("USUARIO");
    session_start();
    $correo = $_SESSION['correo'];
	include('db.php');
    $datos = json_decode(file_get_contents("php://input"), true);

    // Maneja los datos (puedes realizar alguna lógica aquí)
    $usu = $datos['usuario'];
    $gen = $datos['genero'];
    $fna = $datos['fnac'];
    $sql = "UPDATE usuario SET nUsuario = '$usu', fNacU = '$fna', generoU = '$gen' WHERE emailU = '$correo'";
    if ($conexion->query($sql) === TRUE) {
        echo "alert('Se ha actualizado correctamente la informacion');";
    } else {
        echo "alert('Error al actualizar el registro:');";
    }
?>