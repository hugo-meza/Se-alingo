<!DOCTYPE HTML>

<html>
	<head>
		<title>Repaso</title>
		<meta charset="utf-8" />
        <link rel="shortcut icon" href="images/senalingo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/InicioSesion/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/InicioSesion/noscript.css" /></noscript>
	</head>
	<body class="is-preload" style = "background-image: url(images/FondoLecciones.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
	height: 100vh;">

		<!-- Wrapper -->
			<div id="wrapper">

		
            <!-- Header -->
				<!-- Note: The "styleN" class below should match that of the banner element. -->
				<header id="header">
				<a class="button back" onclick = "regresar()">Regresar</a>
					<nav>
						<a href="#menu">Menu</a>
					</nav>
				</header>				
				
				<!-- Menu -->
				<nav id="menu">
				<ul class="links">
						<li><a href="lecciones.php">Lecciones</a></li>
						<li><a href="repaso.php">Repaso</a></li>
						<li><a href="progreso.php">Progreso</a></li>
						<li><a href="perfil.php">Perfil</a></li>
					</ul>
					<ul class="actions stacked">
						<li><a href="cerrarsesion.php" class="button primary fit">Cerrar Sesión</a></li>
					</ul>
				</nav>

                    

				<!-- Main -->
					<div id="main" class="alt" style="height: 100%">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<div class="menor">
									
										<?php
											$n = isset($_GET['nombre']) ? $_GET['nombre'] : '';
											echo "<div ><h1 style = 'margin:0;'>$n</h1></div>";
										?>
										
										<div class="contenedor">
											<button class="boton first video" onclick="seleccionarOpcion('video')">Video</button>
											<button class="boton middle doc" onclick="seleccionarOpcion('doc')">Documento</button>
											<button class="boton last senas" onclick="seleccionarOpcion('senas')">Señas</button>
										</div>
										<script>
											function seleccionarOpcion(opcion) {
												// Obtener todos los botones
												var botones = document.querySelectorAll('.boton');

												// Reiniciar estilos para todos los botones
												botones.forEach(function (boton) {
													boton.style.backgroundColor = '#ccc';
													boton.style.color = '#333';
												});

												// Establecer estilos para el botón seleccionado
												var botonSeleccionado = document.querySelector('.' + opcion);
												botonSeleccionado.style.backgroundColor = '#3498db';
												botonSeleccionado.style.color = '#fff';
												mostrarContenido(opcion);
											}
											function regresar(){
                                                window.location.href = "repaso.php";
                                            }
											function mostrarContenido(tipo) {
												// Oculta todos los contenidos
												var contenidos = document.getElementsByClassName('content');
												for (var i = 0; i < contenidos.length; i++) {
													contenidos[i].style.display = 'none';
												}

												// Muestra el contenido específico según el tipo
												var contenidoEspecifico = document.getElementById(tipo);
												if (contenidoEspecifico) {
													contenidoEspecifico.style.display = 'block';
												}
											} 
										</script>
										<!--<h1>Video</h1>-->
									</div>

									<!-- Content -->
                                    <?php
										session_name("USUARIO");
                                        session_start();
                                        $correo = $_SESSION['correo'];
                                        include('db.php');
										$nombreNivel = isset($_GET['nivel']) ? $_GET['nivel'] : '';

										// Verificar si se proporcionó el parámetro "nivel"
										if (!empty($nombreNivel)) {
											$consulta = "SELECT * FROM niveles WHERE idNivel = $nombreNivel";
											$resultado = mysqli_query($conexion,$consulta);
											$fila = mysqli_fetch_assoc($resultado);
											$nombre = $fila['nombreN'];
											$video = $fila['video'];
											$doc = $fila['documento'];
											echo "<div id='video' class='content' style = 'display: block;'>
											<div class = 'box'>
												<div class = 'videos-con'>
													<div class = 'container-videos'>
														<div class = 'vid'>
															<video src='$video' controls></video>
														</div>
													</div>
													<p></p>
												</div>
											</div>
											</div>";
											echo "<div id = 'doc' class = 'content' style='height: 100%;width: 100%;'>
											<div class = 'box'>
												<iframe width='600' height='700' src='$doc'></iframe>
											</div>
											</div>";
											echo "<div id = 'senas' class = 'content'>
											<div class = 'box alt'>
											<div class='row gtr-50 gtr-uniform'>";
											$sql = "SELECT * FROM gif WHERE idNivel = $nombreNivel";
											$r = $conexion->query($sql);
											while ($row = $r->fetch_assoc()) {
												$gif = $row['rutaGif'];
												$resp = $row['significado'];
												echo "<div class='col-4'>
												<span class='image fit' style='
												display: flex;
												align-items: center;
												flex-direction: column;'><h4>$resp</h4><img src='$gif' alt=''></span>
												</div>";
											}
											
											echo "</div>
											</div>
											</div>";
											
										} else {
											echo "El parámetro 'nivel' no se proporcionó o está vacío.";
										}
                                        
                                    ?>
								</div>
							</section>

					</div>

				
			</div>

		<!-- Scripts -->
			<script src="assets/js/InicioSesion/jquery.min.js"></script>
			<script src="assets/js/InicioSesion/jquery.scrolly.min.js"></script>
			<script src="assets/js/InicioSesion/jquery.scrollex.min.js"></script>
			<script src="assets/js/InicioSesion/browser.min.js"></script>
			<script src="assets/js/InicioSesion/breakpoints.min.js"></script>
			<script src="assets/js/InicioSesion/util.js"></script>
			<script src="assets/js/InicioSesion/main.js"></script>

	</body>
</html>