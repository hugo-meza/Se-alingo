<?php
//$directorio = 'Lecciones/temporal/Gifs/';
//$archivos = scandir($directorio);

//$datosArchivos = array();
session_name("ADMIN");
session_start();
$datosArchivos = $_SESSION['respuestas'];
//echo "mmmmmmmmmmmmmmm";
//print_r($datosArchivos);
//foreach ($archivos as $archivo) {
    //if ($archivo != "." && $archivo != "..") {
        //$rutaCompleta = $directorio . $archivo;
        //$datosArchivos[] = array('ruta' => $rutaCompleta, 'nombre' => $archivo);
    //}
//}

echo json_encode($_SESSION['respuestas']);
//echo "aa";
?>
