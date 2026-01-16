<?php
session_name("USUARIO");
session_start();

if (isset($_POST['idNivel'])) {
    // Obtener el valor de idNivel desde la solicitud POST
    $idNivel = $_POST['idNivel'];

    // Actualizar la sesión con el nuevo valor
    $_SESSION['idNivel'] = $idNivel;

    echo "Sesión actualizada correctamente con idNivel: $idNivel";
} else {
    echo "Error: No se proporcionó el valor de idNivel.";
}
?>
