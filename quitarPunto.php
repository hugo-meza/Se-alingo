<?php
    session_name("USUARIO");
    session_start();
    $pts = $_SESSION['puntos'];
    $pts--;
    //echo "$pts te quite un punto :(";
    $_SESSION['puntos'] = $pts;
    
    $imagenActualizada = 'images/jarron/pts'. $pts .'.png';// lógica para obtener la URL de la imagen actualizada
    header('Content-Type: application/json');
    echo json_encode(['imagen' => $imagenActualizada]);
?>