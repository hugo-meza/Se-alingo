<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/senalingo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorama</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <audio id="correcto" src="sonidos/interface-124464.mp3"></audio>
    <audio id="incorrecto" src="sonidos/error-126627.mp3"></audio>
    <div class="memory-game">
        <?php
            session_name("USUARIO");
            session_start();
            $disponible = $_SESSION['disponible'];
            $cont = 0;
            //$usado = array();
            //echo "Matriz Original:\n";
            //print_r($disponible);
            do{
                $claveAleatoria = array_rand($disponible);                
                // Acceder al elemento correspondiente usando la clave aleatoria
                $elementoAleatorio = $disponible[$claveAleatoria][2];
                //tomar el significado
                $nombreArchivo = $disponible[$claveAleatoria][1];
                echo "<div class='card gif' id='id-gif' data-framework='$cont'><img src=$elementoAleatorio class = 'card-content' alt='GIF'></div>";     
                echo "<div class='card op' id='id-op' data-framework='$cont'><p class = 'card-content'>$nombreArchivo</p></div>";
                //$usado[] = $gifs[$claveAleatoria];
                unset($disponible[$claveAleatoria]);
                // Reorganizar los índices si es necesario
                $disponible = array_values($disponible);
                $cont++;
            }while($cont < 3);
            $_SESSION['disponible'] = $disponible;                    
        ?>
        
    </div>
    <script src="script.js"></script>
</body>
</html>
