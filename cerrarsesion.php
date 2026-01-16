<?php
    if (isset($_SESSION['usuario'])) {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        // Destruye todas las variables de sesión
        session_unset();
    
        // Destruye la sesión
        session_destroy();
    }
    
    // Redirige al usuario a la página de inicio de sesión o a donde desees
    header("Location: index.php"); // Cambia "inicio_sesion.php" al archivo o página de inicio de sesión
    exit(); // Asegura que el script se detenga aquí
?>