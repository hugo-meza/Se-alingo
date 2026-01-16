<?php
    $correo = $_POST['email'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass2'];
    $genero = $_POST['genero'];
    $fNac = $_POST['fNac'];
    session_name("USUARIO");
    session_start();
    $_SESSION['correo'] = $correo;
    $img = 'images/Perfil/sam.png';
    include('db.php');

    $consulta = "SELECT emailU FROM usuario WHERE emailU = '$correo'
    UNION
    SELECT emailA FROM administrador WHERE emailA = '$correo'
    UNION
    SELECT emailM FROM maestros WHERE emailM = '$correo'";
    $resultado = mysqli_query($conexion,$consulta);
    $filas = mysqli_num_rows($resultado);

    if($filas > 0){
        //mandar mensaje y de q ya existe una cuenta con tal correo
        echo '<script language="javascript">window.location.href="index.php";alert("Ya existe una cuenta con tal correo");
        </script>';
    }else{
        $consulta = "SELECT nUsuario FROM usuario WHERE nUsuario = '$usuario'";
        $resultado = mysqli_query($conexion,$consulta);
        $filas = mysqli_num_rows($resultado);
        if($filas > 0){
            echo '<script language="javascript">window.location.href="index.php";alert("Ya existe una cuenta con tal usuario");
            </script>';
        }else{
            if (preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $pass)) {
                // Inicia la transacción
                mysqli_begin_transaction($conexion);
                try {
                    // Primera operación: Inserción en la tabla 'usuario'
                    $sql = "INSERT INTO usuario VALUES ('$correo', '$pass', '$fNac','$usuario','$img','$genero', NULL,NULL)";
                    if (!mysqli_query($conexion, $sql)) {
                        throw new Exception(mysqli_error($conexion));
                    }

                    // Segunda operación: Inserción en la tabla 'resena'
                    $sqlRes = "INSERT INTO resena (puntaje, descRes, encabezado, emailU) VALUES(NULL, NULL, NULL, '$correo')";
                    if (!mysqli_query($conexion, $sqlRes)) {
                        throw new Exception(mysqli_error($conexion));
                    }

                    // Tercera operación: Consulta de idNivel desde la tabla 'niveles'
                    $sqlNiv = "SELECT idNivel FROM niveles";
                    $resultadoNiv = mysqli_query($conexion, $sqlNiv);
                    if (!$resultadoNiv) {
                        throw new Exception(mysqli_error($conexion));
                    }

                    // Cuarta operación: Inserción en la tabla 'accede'
                    if (mysqli_num_rows($resultadoNiv) > 0) {
                        while ($filaNiv = mysqli_fetch_assoc($resultadoNiv)) {
                            $idNivel = $filaNiv['idNivel'];
                            $sqlAccede = "INSERT INTO accede (sumatoria, pMax, veces, emailU, idNivel) VALUES (0,0,0,'$correo',$idNivel)";
                            if (!mysqli_query($conexion, $sqlAccede)) {
                                throw new Exception(mysqli_error($conexion));
                            }
                        }
                    } else {
                        echo "No se encontraron niveles.";
                    }

                    // Termina la transacción
                    mysqli_commit($conexion);

                    // Redirige a lecciones.php después de completar todas las operaciones
                    header("location:lecciones.php");
                } catch (Exception $e) {
                    // En caso de error, revierte la transacción
                    mysqli_rollback($conexion);

                    // Muestra un mensaje de error
                    echo "Error: " . $e->getMessage();
                }

            }else{
                echo '<script language="javascript">window.location.href="index.php";alert("La contraseña no cumple con las condiciones (minimo 8 caracteres, una mayuscula y un numero)");
                    </script>';
            }
        }
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>