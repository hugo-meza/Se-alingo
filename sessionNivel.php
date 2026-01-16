<?php
    session_name("ADMIN");
    session_start();
    if (!isset($_SESSION['respuestas'])) {
        $_SESSION['respuestas'] = array();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        // Verifica la acción solicitada
        if ($accion === 'Datos') {
            // Llama a la función 'datos' y pasa las variables
            $resultado = datos($_POST['v1'], $_POST['v2']);
            //echo $resultado;
        } elseif ($accion === 'archivos') {
            $resultado = archivos($_FILES['documento']);
        }elseif ($accion === 'video') {
            $resultado = video($_FILES['video']);
        } elseif($accion === 'gif'){
            $resultado = gifs($_FILES['gif'],$_POST['significado']);
        } elseif($accion === 'act'){
            $resultado = act($_POST['memo'],$_POST['desc'], $_POST['sOp'],$_POST['sGif']);
        }
    }

    function act($m,$d,$o,$g){
        $_SESSION['memorama'] = $m;
        $_SESSION['describe'] = $d;
        $_SESSION['sOp'] = $o;
        $_SESSION['sGif'] = $g;
        echo "ya quedo uwuwuwuw";
    }

    function datos($n,$d){
        $_SESSION['nombreN'] = $n;
        $_SESSION['descN'] = $d; 
        echo "olee";
    }

    function archivos($documento){
        $carpetaTemporal = 'Lecciones/temporal/';

        // Nombre del archivo
        $nombreArchivo = $documento['name'];

        // Ruta completa del archivo en la carpeta temporal
        $rutaCompleta = $carpetaTemporal . $nombreArchivo;

        // Mueve el archivo a la carpeta temporal
        if (move_uploaded_file($documento['tmp_name'], $rutaCompleta)) {
            echo "Documento cargado temporalmente en: " . $rutaCompleta;
            $_SESSION['doc'] = $rutaCompleta;
            // Llamada a la función específica con la ruta del archivo temporal
        } else {
            error_log("Error al cargar el documento. Detalles: " . print_r(error_get_last(), true));
            echo "Error al cargar el documento.";
        }
    }
    $respuestas = array();

    function gifs($gif, $sign){
        $carpetaTemporal = 'Lecciones/temporal/Gifs/';

        if(!file_exists($carpetaTemporal)){
            if (!mkdir($carpetaTemporal, 0777, true)) {
                die('Error al crear el directorio...');
            }
        }
        // Nombre del archivo
        $nombreArchivo = $gif['name'];

        // Ruta completa del archivo en la carpeta temporal
        $rutaCompleta = $carpetaTemporal . $nombreArchivo;

        // Mueve el archivo a la carpeta temporal
        if (move_uploaded_file($gif['tmp_name'], $rutaCompleta)) {
            echo "Gif cargado temporalmente en: " . $rutaCompleta;
            $respuestas = array('ruta' => $rutaCompleta, 'nombre' => $sign);
            $_SESSION['respuestas'][] = $respuestas;
            
            print_r($_SESSION['respuestas']);
            // Llamada a la función específica con la ruta del archivo temporal
        } else {
            error_log("Error al cargar el documento. Detalles: " . print_r(error_get_last(), true));
            echo "Error al cargar el documento.";
        }
    }

?>