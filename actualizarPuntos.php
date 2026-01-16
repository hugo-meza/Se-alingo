<?php
    session_name("USUARIO");
    session_start();
    $c = $_SESSION['correo'];
    $n = $_SESSION['idNivel'];
    $pts = $_SESSION['puntos'];	
    include('db.php');
    $consulta = "SELECT * FROM accede WHERE emailU = '$c' AND idNivel = $n";
    $resultado = mysqli_query($conexion,$consulta);
    $fila = mysqli_fetch_assoc($resultado);
    if($fila > 0){
        //$sum = $fila['sumatoria'];
        $pMax = $fila['pMax'];
        if($pMax < $pts){
            $pMax = $pts;
        }
        mysqli_begin_transaction($conexion);
        try{
            $sql = "UPDATE accede SET sumatoria = sumatoria + $pts, pMax = $pMax, veces = veces + 1 WHERE emailU = '$c' AND idNivel = $n";
            if (!mysqli_query($conexion, $sql)) {
                throw new Exception(mysqli_error($conexion));
            }

            $sqlNiv = "UPDATE niveles SET vecesJugado = vecesJugado + 1, sumaPts = sumaPts + $pts WHERE idNivel = $n";
            if (!mysqli_query($conexion, $sqlNiv)) {
                throw new Exception(mysqli_error($conexion));
            }
            mysqli_commit($conexion);
        }catch(Exception $e){
            // En caso de error, revierte la transacción
            mysqli_rollback($conexion);

            // Muestra un mensaje de error
            echo "Error: " . $e->getMessage();
        }
    }else{
        echo "error al actualizar los datos :(";
    }
?>