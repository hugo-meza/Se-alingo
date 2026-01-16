<?php
    session_name("ADMIN");
    session_start();
    if (isset($_SESSION['nombreN'], $_SESSION['descN'], $_SESSION['doc'], $_SESSION['video'],$_SESSION['respuestas'],$_SESSION['memorama'],$_SESSION['describe'],$_SESSION['sOp'],$_SESSION['sGif'])) {
        $nombreN = $_SESSION['nombreN'];
        
        $carpetaDirectorio = "Lecciones/{$nombreN}";
        if (!file_exists($carpetaDirectorio)) {
            mkdir($carpetaDirectorio, 0777, true);
        }

        $nuevaRuta = $carpetaDirectorio."/".basename($_SESSION['doc']);
        rename($_SESSION['doc'], $nuevaRuta);
        $_SESSION['doc'] = $nuevaRuta;

        $nuevaRuta = $carpetaDirectorio."/".basename($_SESSION['video']);
        rename($_SESSION['video'], $nuevaRuta);
        $_SESSION['video'] = $nuevaRuta;
        
        
        // Recupera los datos de la sesión
        $video = $_SESSION['video'];
        $doc = $_SESSION['doc'];
        $descN = $_SESSION['descN'];
        $memo = $_SESSION['memorama'];
        $describe = $_SESSION['describe'];
        $sOp = $_SESSION['sOp'];
        $sGif = $_SESSION['sGif'];
        // Aquí debes realizar la lógica para guardar los datos en la base de datos
        // Puedes usar la información de $nombreNivel y $descripcionNivel
        include('db.php');
        $sql = "INSERT INTO niveles (nombreN, video, documento, descripcionN, memorama, describir, selectOp, selectGif, promedioMin, vecesJugado, sumaPts) VALUES 
        ('$nombreN', '$video', '$doc', '$descN',$memo,$describe,$sOp,$sGif,3,0,0)";
        if ($conexion->query($sql) === TRUE) {
            echo "Datos agregados correctamente";
        } else {
            echo "Error al agregar datos: " . $conexion->error;
        }

        $sql = "SELECT idNivel FROM niveles WHERE nombreN = '$nombreN'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            // Obtiene el resultado de la consulta
            $fila = $resultado->fetch_assoc();
            $idN = $fila['idNivel'];
            $rutaCarpeta = "Lecciones/".$nombreN."/Gifs";
            if (!file_exists($rutaCarpeta)) {
                mkdir($rutaCarpeta, 0777, true);
            }
            $archivos = $_SESSION['respuestas'];

            foreach ($archivos as &$archivo) { // Nota el "&" para referenciar el valor
                $rutaArchivo = $archivo['ruta'];
                $nuevaRutaArchivo = $rutaCarpeta . '/' . basename($rutaArchivo);

                // Mueve el archivo a la nueva carpeta
                rename($rutaArchivo, $nuevaRutaArchivo);

                // Actualiza la ruta en el arreglo de archivos
                $archivo['ruta'] = $nuevaRutaArchivo;
                $sig = $archivo['nombre'];

                $sql = "INSERT INTO gif (rutaGif, significado, idNivel) VALUES ('$nuevaRutaArchivo', '$sig', '$idN')";
                
                if ($conexion->query($sql) === TRUE) {
                    //echo "Datos agregados correctamente";
                } else {
                    echo "Error al agregar datos: " . $conexion->error;
                }

                $sqlNiv = "SELECT emailU FROM usuario";
                $resultadoNiv = mysqli_query($conexion, $sqlNiv);
                if (!$resultadoNiv) {
                    throw new Exception(mysqli_error($conexion));
                }

                // Cuarta operación: Inserción en la tabla 'accede'
                if (mysqli_num_rows($resultadoNiv) > 0) {
                    while ($filaNiv = mysqli_fetch_assoc($resultadoNiv)) {
                        $email = $filaNiv['emailU'];
                        $sqlAccede = "INSERT INTO accede (sumatoria, pMax, veces, emailU, idNivel) VALUES (0,0,0,'$email',$idN)";
                        if (!mysqli_query($conexion, $sqlAccede)) {
                            throw new Exception(mysqli_error($conexion));
                        }
                    }
                } else {
                    echo "No se encontraron niveles.";
                }
            }
            // Muestra el ID de la fila
            //echo "ID de la fila: " . $fila['idNivel'];
        } else {
            echo "No se encontró ninguna fila con ese ID.";
        }
        // Después de guardar, puedes limpiar la sesión si es necesario
        unset($_SESSION['nombreN']);
        unset($_SESSION['descN']);
        unset($_SESSION['doc']);
        unset($_SESSION['video']);
        unset($_SESSION['respuestas']);
        unset($_SESSION['memorama']);
        unset($_SESSION['describe']);
        unset($_SESSION['sOp']);
        unset($_SESSION['sGif']);
    } else {
        // No hay datos en la sesión, manejar según tus necesidades
        echo 'No hay datos en la sesión para guardar.';
    }
?>