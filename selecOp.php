<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/senalingo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciona una opcion</title>
    <link rel="stylesheet" href="assets/css/InicioSesion/main.css"/>
</head>
<body>
    <audio id="correcto" src="sonidos/interface-124464.mp3"></audio>
    <audio id="incorrecto" src="sonidos/error-126627.mp3"></audio>
    <div class="describe-game" style="
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    width: 100%;">
        <?php
           session_name("USUARIO");
           session_start();
           $disponible = $_SESSION['disponible'];
           $todos = $_SESSION['todos'];
           $index = array_rand($disponible);
           $id = $disponible[$index][0];
           $gif = $disponible[$index][2];
           $resp = $disponible[$index][1];
           echo "<img class = 'gif-desc' src=$gif>";
           unset($disponible[$index]);
           // Reorganizar los índices si es necesario
           $disponible = array_values($disponible);
           $datosBuscados = [$id,$resp,$gif];
           foreach ($todos as $indice => $fila) {
            if ($fila == $datosBuscados) {
                unset($todos[$indice]);
                // Reorganizar los índices si es necesario
                $todos = array_values($todos);
                break; // Si encuentras la fila, puedes salir del bucle
            }
            }
           echo "<div class = 'cont-op'>";
           $elementosElegidos = array_rand($todos, 3);
           $filasSeleccionadas = array_slice($todos, $elementosElegidos[0], 3);
           array_push($filasSeleccionadas, $datosBuscados);
           shuffle($filasSeleccionadas);
           //print_r($filasSeleccionadas);
           foreach($filasSeleccionadas as $i => $f){
                $v = $f[1];
                echo "<button id = 'op$i'class = 'btn-op' onclick = 'comprobar($i)'>$v</button>";
           }
           echo "</div>";
           $_SESSION['disponible'] = $disponible;
         ?>
        <script>
            var incorrecto = document.getElementById('incorrecto');
            var correcto = document.getElementById('correcto');
            function comprobar(i){
                var op = 'op' + i;
                console.log(op);
                op = document.getElementById(op).innerText;
                console.log(op); 
                var opCor= <?php echo json_encode($resp); ?>;
                if(opCor == op){
                    correcto.play();
                }else{
                    parent.actualizarPuntaje();
                    incorrecto.play();
                }
                var btns = document.getElementsByClassName("btn-op");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].disabled = true;
                }
                window.parent.habilitarbtnSig();
            }
        </script>
    </div>
    
</body>
</html>