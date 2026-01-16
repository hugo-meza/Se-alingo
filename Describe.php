<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/senalingo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Describe</title>
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
           $index = array_rand($disponible);
           $gif = $disponible[$index][2];
           $resp = $disponible[$index][1];
           echo "<img class = 'gif-desc' src=$gif>";
           echo "<textarea id = 'txt' class = 'txt-desc' placeholder = 'Escribe el significado del video'></textarea>";
           unset($disponible[$index]);
            // Reorganizar los índices si es necesario
            $disponible = array_values($disponible);
            $_SESSION['disponible'] = $disponible;
        ?>
        <button id = 'btn-com' onclick = 'comprobar()'>Comprobar</button>
        <script>
            var incorrecto = document.getElementById('incorrecto');
            var correcto = document.getElementById('correcto');
            function comprobar(){
                var resp = <?php echo json_encode($resp); ?>.toLowerCase();
                console.log(resp);
                var txt = document.getElementById('txt').value.trim().toLowerCase();
                console.log(txt);
                if(resp == txt){
                    correcto.play();
                }else{
                    parent.actualizarPuntaje();
                    
                    incorrecto.play();
                }
                document.getElementById('txt').disabled = true;
                document.getElementById('btn-com').disabled = true;
                window.parent.habilitarbtnSig();
            }
        </script>
    </div>
    
</body>
</html>
