<?php
session_name("ADMIN");
session_start();
//$_SESSION["doc"] = "";
//$_SESSION["video"] = "";
// Al cargar la página
$nombreNivel = isset($_SESSION['nombreN']) ? $_SESSION['nombreN'] : '';
$descripcionNivel = isset($_SESSION['descN']) ? $_SESSION['descN'] : '';
$documento = isset($_SESSION['doc']) ? $_SESSION['doc'] : '';
$video = isset($_SESSION['video']) ? $_SESSION['video'] : '';
if (!isset($_SESSION['respuestas']) || $_SESSION['respuestas'] === null) {
    // Si no está definida o es null, inicializarla como un array vacío
    $_SESSION['respuestas'] = [];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Crear Nivel - Señalingo Admin</title>
        <link rel="shortcut icon" href="images/senalingo.png">
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="assets/css/admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" style = "background-image: url(images/Fonde.jpg);">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class = "header-crearN"><h1 class="mt-4">CREAR NIVEL</h1> <button class = "btn" onclick="mostrarMenuConfirmacion()" >SALIR</button></div>
                        <!--<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index-admin.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Static Navigation</li>
                        </ol>-->
                        <div class="card mb-4">
                            <div class="progress-bar">
                                <div class="progress" id="step"></div>
                            </div>
                            <div class="card-body">
                                <div id = "pasos-container">
                                    <div class = 'step active' id = "paso-1">
                                        <div class = "header-crearN"><h2>Paso 1: Datos</h2></div>
                                        <?php
                                            $nombres = array();
                                            include("db.php");
                                            $sql = "SELECT nombreN FROM niveles";
                                            $resultado = mysqli_query($conexion,$sql);
                                            $i = 0;
                                            if (mysqli_num_rows($resultado) > 0) {
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    $nombres[$i] = $fila['nombreN'];
                                                    //echo $nombres[$i];
                                                    $i++;
                                                }
                                            } else {
                                                echo "No se encontraron niveles.";
                                            }
                                            //echo $_SESSION['doc'];
                                            //echo $_SESSION['video'];
                                            $fila = mysqli_fetch_assoc($resultado);
                                            //$jsonArray = json_encode($nombres);
                                            //echo $jsonArray;
                                        ?>
                                        <p>Nombre del nivel: </p>
                                        <input type = 'text' class = 'input-niv' id = "nom" maxlength="30" value="<?php echo htmlspecialchars($nombreNivel); ?>" required>
                                        <p>Descripción del nivel:</p>
                                        <input type = 'text' class = 'input-niv' id = "desc" maxlength="50" value="<?php echo htmlspecialchars($descripcionNivel); ?>" required><br>
                                        <button onclick="verificarDatos()" class = "btn">Siguiente</button>
                                        <script>
                                            function verificarDatos(){
                                                var nombres = <?php echo json_encode($nombres); ?>;
                                                var nom = document.getElementById("nom").value.trim();
                                                var descr = document.getElementById("desc").value.trim();
                                                var seguir = true;
                                                //console.log(nom);
                                                if(nom == "" || descr == ""){
                                                    alert("Completa todos los campos");
                                                    seguir = false; 
                                                }
                                                    
                                                for(let i = 0; i < nombres.length; i++){
                                                    if(nombres[i].toLowerCase() === nom.toLowerCase()){
                                                        seguir = false;
                                                        alert("Ya existe un nivel con tal nombre");
                                                        break;
                                                    }
                                                }
                                                //alert ('este es nom: ' + nom + " y este es el vector uwu: " +nombres);
                                                if(seguir != false){
                                                    console.log("uwu");
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "sessionNivel.php",
                                                        data: {
                                                            accion: 'Datos',
                                                            v1: nom,
                                                            v2: descr
                                                        },
                                                        success: function (respuesta) {
                                                            // Maneja la respuesta del servidor
                                                            console.log("Respuesta del servidor:", respuesta);
                                                        },
                                                        error: function () {
                                                            console.error("Error en la solicitud AJAX");
                                                        }
                                                    });
                                                    completarPaso();
                                                    nextStep();
                                                }
                                            }
                                        </script>
                                    </div>
                                    <!-- En el segundo paso (step-2) -->
                                    <div class="step" id="paso-2">
                                        <div class = "header-crearN"><h2>Paso 2: Cargar Documento y Video</h2></div>
                                        
                                        <form id="upload-form">
                                            <label for="video">Video:</label>
                                            <input type="file" id="video" name="video" accept=".mp4, .avi, .mov" onchange="updateFileName('video')" style = "color: transparent;width:25%">
                                            <span id="videoFileName">
                                                <?php
                                                $abled = true;
                                                if (!empty($video)) {
                                                    $info = pathinfo($video);
                                                    // Obtener el nombre del archivo con la extensión
                                                    $nombreCompleto = $info['basename'];
                                                    echo htmlspecialchars($nombreCompleto);
                                                } else {
                                                    $abled = false;
                                                    echo "Sin archivos seleccionados";
                                                }
                                                ?>
                                            </span>
                                            <button type="button" class = "btn" onclick="uploadVideo()">Subir video</button><br>
                                            <label for="documento">Documento:</label>
                                            <input type="file" id="document" name="document" accept=".pdf, .doc, .docx" onchange="updateFileName('document')" style = "color: transparent; width: 25%">
                                            <span id="documentFileName">
                                                <?php
                                                if (!empty($documento)) {
                                                    $info = pathinfo($documento);
                                                    // Obtener el nombre del archivo con la extensión
                                                    $nombreCompleto = $info['basename'];
                                                    echo htmlspecialchars($nombreCompleto);
                                                } else {
                                                    $abled = false;
                                                    echo "Sin archivos seleccionados";
                                                }
                                                ?>
                                            </span>
                                            <button type = "button" class = "btn" onclick = "uploadDoc()">Subir documento</button>
                                            <br>
                                            <button type = "button" id = "siguiente-button" onclick = "sig()" class = "btn" disabled>Siguiente</button>
                                            <?php
                                                if($abled == true){
                                                    echo "<script>let b = document.getElementById('siguiente-button'); b.disabled = false;</script>";
                                                }
                                            ?>
                                            <br>
                                            <br>
                                        </form>
                                        <script>
                                            function updateFileName(inputId) {
                                                const input = document.getElementById(inputId);
                                                const fileNameSpan = document.getElementById(inputId + 'FileName');
                                                if (input.files.length > 0) {
                                                    fileNameSpan.textContent = input.files[0].name;
                                                } else {
                                                    fileNameSpan.textContent = "Sin archivos seleccionados";
                                                }
                                            }
                                        </script>
                                    </div>

                                    <div class = 'step' id = "paso-3">
                                        <div class = "header-crearN"><h2>Paso 3: Subir respuestas (Gif y significado)</h2></div>
                                        <div class = "row">
                                            <div class = "col-xl">
                                                <input type="file" id="gif" name="gif" accept=".gif">
                                                <p>Significado del gif:</p>
                                                <input type = 'text' class = 'input-sig' id = "sign" maxlength="30" required><br>
                                                <button type="button" class = "btn" onclick="uploadGif()">Subir respuesta</button>
                                                <button type="button" class = "btn" onclick="sig()" id = "botonSeguir" disabled>Seguir</button>
                                            </div>
                                            <div class = "col-xl">
                                                <div class = "card-header">Respuestas</div>
                                                <table id = "gifs">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre de archivo</th>
                                                            <th>Significado</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Las filas se agregarán aquí -->
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Nombre de archivo</th>
                                                            <th>Significado</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                </div>
                                            </div>
                                    </div>
                                    <div class = 'step' id = "paso-4">
                                        <div class = "header-crearN"><h2>Paso 4: Definir actividades</h2></div>
                                        <div class = "header-cantR">
                                            <h4>Cantidad respuestas</h4>
                                            <?php
                                               // if (isset($_SESSION['respuestas']) && $_SESSION['respuestas'] !== null) {
                                                    // Obtener la cantidad de elementos en $_SESSION['respuestas']
                                                    //$cantidadRespuestas = count($_SESSION['respuestas']);
                                                    echo "<p style='margin: 0px 22px 0px 0px;'>".count($_SESSION['respuestas'])."</p>";
                                                    // Resto del código que utiliza $cantidadRespuestas
                                                    // ...
                                                
                                                //} else {
                                                    // Manejar el caso en el que $_SESSION['respuestas'] no está definido o es null
                                                    //echo "La clave 'respuestas' no está definida o es null.";
                                                //}
                                                
                                            ?>
                                            <div class="progress-bar" id = "barra-progreso">
                                                <div class="progress" id="aciertos"></div>
                                            </div>
                                        </div>
                                        <div class = "col-xl">
                                            <table class = "acts">
                                                <tr>
                                                    <th></th>
                                                    <th>Memorama</th>
                                                    <th><input type="number" name="memorama" id="memorama" min="0" value = "0"></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>Describir</th>
                                                    <th><input type="number" name="describir" id="describir" min="0" value = "0"></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>Selecciona opcion</th>
                                                    <th><input type="number" value = "0" name="selecOp" id="selecOp" min="0"></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>Selecciona gif</th>
                                                    <th><input type="number" name="selecGif" value = "0" id="selecGif" min="0"></th>
                                                </tr>
                                            </table>
                                            <button type="button" class = "btn" onclick="uploadActs()" id = "botonFinal" disabled>Seguir</button>
                                        </div>
                                        <script>
                                            try{
                                                var total = <?php echo json_decode(count($_SESSION['respuestas']))?>;
                                                var btnSiguiente = document.getElementById('botonFinal');
                                                const memorama = document.getElementById('memorama');
                                                const describir = document.getElementById('describir');
                                                const selecOp = document.getElementById('selecOp');
                                                const selecGif = document.getElementById('selecGif');
                                                const barraProgreso = document.getElementById('barra-progreso');
                                                const aciertos = document.getElementById('aciertos');

                                                // Agrega un evento de escucha a cada input
                                                memorama.addEventListener('input', actualizarBarraProgreso);
                                                describir.addEventListener('input', actualizarBarraProgreso);
                                                selecOp.addEventListener('input', actualizarBarraProgreso);
                                                selecGif.addEventListener('input', actualizarBarraProgreso);

                                                function actualizarBarraProgreso() {
                                                    // Obtén los valores de los inputs
                                                    const valorMemorama = parseInt(memorama.value) * 3;
                                                    const valorDescribir = parseInt(describir.value);
                                                    const valorSelecOp = parseInt(selecOp.value);
                                                    const valorSelecGif = parseInt(selecGif.value);

                                                    // Calcula la puntuación total y el porcentaje
                                                    const puntuacionTotal = valorMemorama + valorDescribir + valorSelecOp + valorSelecGif;

                                                    var pT = parseInt(memorama.value) + valorDescribir + valorSelecOp + valorSelecGif;
                                                    pt = Math.min(pT, total);
                                                    var porcentaje = (puntuacionTotal / total) * 100;
                                                    console.log(porcentaje);
                                                    
                                                    console.log(pT);
                                                    if(pT == 5){
                                                        console.log("ajas");
                                                        btnSiguiente.disabled = false;
                                                    } else {
                                                        console.log("no ajas");
                                                        btnSiguiente.disabled = true;
                                                    }
                                                    // Actualiza el ancho de la barra de progreso
                                                    aciertos.style.width = `${porcentaje}%`;
                                                    //btnSiguiente.disabled = puntuacionTotal !== 5;
                                                    memorama.value = Math.min(parseInt(memorama.value), total / 3);
                                                    describir.value = Math.min(parseInt(describir.value), total - valorMemorama);
                                                    selecOp.value = Math.min(parseInt(selecOp.value), total - valorMemorama - valorDescribir);
                                                    selecGif.value = Math.min(parseInt(selecGif.value), total - valorMemorama - valorDescribir - valorSelecOp);
                                                }
                                            }catch(error){
                                                console.log(",mmm");
                                            }
                                            
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/admin.js"></script>
    </body>
</html>
