<?php
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    
    include('db.php');

    $consulta = "SELECT*FROM usuario where emailU = '$correo' and contraU = '$pass'";
    $resultado = mysqli_query($conexion,$consulta);
    $filas = mysqli_num_rows($resultado);
    if($filas > 0){
        session_name("USUARIO");
        session_start();
        $_SESSION['correo'] = $correo;
        header("location:lecciones.php");
    }else{
        $consulta = "SELECT*FROM maestros where emailM = '$correo' and contraM = '$pass'";
        $resultado = mysqli_query($conexion,$consulta);
        $filas = mysqli_num_rows($resultado);
        if($filas > 0){
            session_name("MAESTRO");
            session_start();
            $_SESSION['correo'] = $correo;
            header("location:index-maestros.php");
        }else{
            $consulta = "SELECT*FROM administrador where emailA = '$correo' and contraA = '$pass'";
            $resultado = mysqli_query($conexion,$consulta);
            $filas = mysqli_num_rows($resultado);
            if($filas > 0){
                session_name("ADMIN");
                session_start();
                $_SESSION['correo'] = $correo;
                header("location:index-admin.php");
            }else{
                echo '<script language="javascript">window.location.href="index.php";alert("Correo o contraseña incorrecta, intente de nuevo");
                </script>';
            }
        }
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);

    ?>