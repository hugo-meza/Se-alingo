<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Nivel</title>
		<meta charset="utf-8" />
        <link rel="shortcut icon" href="images/senalingo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/InicioSesion/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/InicioSesion/noscript.css" /></noscript>
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	</head>
	<body class="is-preload"  style = "background-image: url(images/FondoLecciones.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
	overflow: hidden;
	height: 100vh">

		<!-- Wrapper -->
		<div id="wrapper" style = "padding-top: 4em; height: 100%">

			<!-- Header -->
			<!-- Note: The "styleN" class below should match that of the banner element. -->
			<header id="header" class="alt act" style="
				background-color: #242943;
				opacity: 0.85;
				height: 4em;">
				<nav>
					<img id = 'img-puntos' class = 'puntos-abeja' src = 'images/jarron/pts5.png'>
					<a href="#menu" style = '    display: flex;
    				align-content: center;
    				flex-wrap: wrap;'>
					Salir</a>
				</nav>
			</header>				
			
			<!-- Menu -->
			<nav id="menu">
				<p>¿Estás seguro de salir? Perderás tu progreso del nivel</p>
				<ul class="links">
					<li><a href="">Regresar</a></li>
					<li><a href="lecciones.php">Salir</a></li>
				</ul>
			</nav>

			<!-- Main -->
			<div id="main" class="alt">
			<!-- One -->
				<section id="uno">
					<div class="inner-act">
						<div class = 'btns'>
							<button onclick = 'cambio()' id = 'btn-sig' disabled>Siguiente</button>
							<script>
								function habilitarbtnSig() {
									// Habilitar el botón cuando se llame a esta función desde el iframe
									document.getElementById('btn-sig').disabled = false;
								}
								function btnDes() {
									// Habilitar el botón cuando se llame a esta función desde el iframe
									document.getElementById('btn-sig').disabled = true;
								}
								document.getElementById('btn-sig').disabled = true;
							</script>
							
						</div>
						<span class="image-act">
							<?php
								session_name("USUARIO");
								session_start();
								$correo = $_SESSION['correo'];
								$nivel = $_SESSION['idNivel'];
								$_SESSION['puntos'] = 5;
								include('db.php');
								$consulta = "SELECT * FROM niveles WHERE idNivel = $nivel";
								$resultado = mysqli_query($conexion,$consulta);
								$fila = mysqli_fetch_assoc($resultado);
								$tipoAct = [$fila['memorama'], $fila['describir'],$fila['selectOp'],$fila['selectGif']];
								//echo count($tipoAct);
								$sqlGif = "SELECT * FROM gif WHERE idNivel = $nivel";
								$res = mysqli_query($conexion,$sqlGif);
								$disp = array();
								//$usado = array();
								$i = 0;
								while ($row = mysqli_fetch_assoc($res)) {
									//echo "Significado: " . $row['idGif'] . "<br>";
									$disp[$i][0] = $row['idGif'];
									$disp[$i][1] = $row['significado'];
									$disp[$i][2] = $row['rutaGif'];
									$i++; 
								}
								$_SESSION['disponible'] = $disp;
								$_SESSION['todos'] = $disp;
								//$_SESSION['usado'] = $usado;								
							?>
							<iframe src = ''  id = 'iframeActividades'class = 'actividades' ></iframe>	
							<script>
								// Array de actividades
								var act = <?php echo json_encode($tipoAct); ?>;
								
								// Función para cambiar la actividad en el iframe
								function cambiarActividad(i) {
									var iframe = document.getElementById('iframeActividades');
									var tipo = "";
									console.log("cant de act " + act[i]);
									// Verifica si el índice es válido y la actividad existe
									switch(i){
										case 0:
											tipo = "memorama.php";
											break;
										case 1:
											btnDes();
											tipo = "Describe.php"
											break;
										case 2:
											btnDes();
											tipo = "selecOp.php";
											break;
										case 3:
											btnDes();
											//console.log('aaaa');
											tipo = "selecGif.php";
											break; 
									}
									if(tipo == iframe.src){
										console.log("son iguales uwu");
									}
									iframe.src = tipo;
								}
								var i = 0;
								function buscarIndex(){
									var cont = 0;
									let sigue = false;
									while(cont < 5){
										console.log("esto es i " + i);
										console.log(act[i]);
										if(act[i] > 0){
											sigue = true;
											break;
										}else{
											cont++;
										}
										if(i > 3){
											i = 0;
										}else{
											i++;
										}
										console.log("contadoor "+cont);
									}
									return sigue;
								}
								function cambio(){
									if(buscarIndex()){
										cambiarActividad(i);
										act[i]--;
										console.log("esto es lo que quedo del array " + act[i]);
										i++;
									}else{
										window.location.href = "resultado.php";
										console.log("se acaboooo");
									}
								}
								cambio();			
							</script>						
						</span>
						<script>
							function actualizarPuntaje() {
								//console.log("aja");
								$.ajax({
									type: 'GET',
									url: 'quitarPunto.php?t=' + new Date().getTime(), // Archivo PHP que actualiza el puntaje en la sesión
									success: function(data) {
										//console.log(data);
										if (data.error) {
											console.error('Error en la respuesta del servidor:', data.error);
										} else {
											//console.log(data);
											$('#img-puntos').attr('src', data.imagen);
											
										}
									},
									error: function(error) {
										console.error('Error en la solicitud AJAX: ', error);
									}
								});
							}
						</script>
					</div>
				</section>
				</div>
		</div>

		<!-- Scripts -->
		<script>
			
			window.addEventListener('popstate', function(event) {
				// Mostrar el menú de confirmación cuando se detecta un cambio en el historial
				console.log("ajales ");
				document.body.classList.add('is-menu-visible');
			});

			// Agregar una entrada en el historial para que se pueda detectar el primer cambio
			history.pushState({}, '');
		</script>
		<!--<script>
			// Variable para rastrear si el usuario está saliendo de la actividad
			var leavingActivity = false;

			// Evento beforeunload
			window.addEventListener('beforeunload', function (event) {
				console.log("ammmmamamamma");
				// Verifica si el usuario está saliendo de la actividad
				if (leavingActivity) {
					// Agrega la clase al body
					

					// Si necesitas realizar alguna acción específica al regresar al Nivel.php,
					// como limpiar datos o hacer alguna verificación, puedes hacerlo aquí.
					
					// Cancela el evento beforeunload para evitar que aparezca el cuadro de diálogo
					event.preventDefault();

					// Evita que el usuario avance nuevamente a Actividad.php
					history.forward();
				}
			});

			// Agrega un nuevo estado al historial cuando se carga Actividad.php
			window.onload = function () {
				history.replaceState({ fromHistory: true }, null, window.location.href);
			};

			// Función para marcar que el usuario está saliendo de la actividad
			function leaveActivity() {
				leavingActivity = true;
			}
		</script>-->

			<script src="assets/js/InicioSesion/jquery.min.js"></script>
			<script src="assets/js/InicioSesion/jquery.scrolly.min.js"></script>
			<script src="assets/js/InicioSesion/jquery.scrollex.min.js"></script>
			<script src="assets/js/InicioSesion/browser.min.js"></script>
			<script src="assets/js/InicioSesion/breakpoints.min.js"></script>
			<script src="assets/js/InicioSesion/util.js"></script>
			<script src="assets/js/InicioSesion/main.js"></script>

	</body>
</html>