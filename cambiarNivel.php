<?php
    session_name("USUARIO");
    session_start();
    $n = isset($_GET['nivel']) ? $_GET['nivel'] : '';
    //echo $n;
    $sql = "SELECT * FROM niveles WHERE idNivel = $n";
    include('db.php');
    $result = 
?>