<?php
    session_name("ADMIN");
    session_start();
    ini_set('max_execution_time', 300); // 5 minutos (ajusta según sea necesario)
    ini_set('memory_limit', '128M');    // Ajusta según sea necesario
    //echo $_SESSION['doc'];
    //echo $_SESSION['video'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        // Verifica la acción solicitada
        if ($accion === 'video') {
            $resultado = video($_FILES['video']);
        }
    }
    function video($video){
        $carpetaTemporal = 'Lecciones/temporal/';

        // Nombre del archivo
        $nombreArchivo = $video['name'];

        // Ruta completa del archivo en la carpeta temporal
        $rutaCompleta = $carpetaTemporal . $nombreArchivo;

        // Mueve el archivo a la carpeta temporal
        if (move_uploaded_file($video['tmp_name'], $rutaCompleta)) {
            echo "Video cargado temporalmente en: " . $rutaCompleta;
            $_SESSION['video'] = $rutaCompleta;
            // Llamada a la función específica con la ruta del archivo temporal
        } else {
            error_log("Error al cargar el video. Detalles: " . print_r(error_get_last(), true));
            http_response_code(500); // Agrega esto para indicar un error interno del servidor
            echo "Error al cargar el video.";
        }
    }
?>