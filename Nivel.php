<!DOCTYPE HTML>
<html>
	<head>
		<title>Nivel</title>
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
	height: 100%;">

		<!-- Wrapper -->
			<div id="wrapper" style="height: 100%;">

				<!-- Header -->
				<!-- Note: The "styleN" class below should match that of the banner element. -->
				<header id="header" class="alt style2" style = "background-color: #242943; opacity: 0.85;">
					<a href="lecciones.php" class="logo"><img src="images/letras.png" class="logo"><!--<strong>Señalingo</strong>--></a>
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
						<!--<li><a href="#" class="button fit">Log In</a></li>-->
					</ul>
				</nav>

				<!-- Main -->
					<div id="main" class="alt">

						<!-- One -->
							<section id="one">
								
								<div class="inner">
								<?php
									session_name("USUARIO");
									session_start();
									$correo = $_SESSION['correo'];
									$nivel = $_SESSION['idNivel'];
									include('db.php');
									$consulta = "SELECT nombreN, video FROM niveles WHERE idNivel = $nivel";
									$resultado = mysqli_query($conexion,$consulta);
									$fila = mysqli_fetch_assoc($resultado);
									$nombre = $fila['nombreN'];
									$video = $fila['video'];
									echo "<header class='major' style = 'width: 100%; align-items: center;'> <h1>$nombre</h1>  <a class = 'btn-vid' href=Actividad.php>Siguiente</a> </header> <span class='image main'> <video src='$video' controls></video></span>";
									
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