<!DOCTYPE HTML>
<html>
	<head>
		<title>Lecciones - Señalingo</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="images/senalingo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/InicioSesion/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/InicioSesion/noscript.css" /></noscript>
		<!--<script src="btnN2.js"></script>-->
		<script type="text/javascript">
    		if (window.history.replaceState) {
        		window.history.replaceState(null, null, window.location.href);
    		}
		</script>

	</head>
	<body class="is-preload" style = "background-image: url(images/FondoLecciones.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
				<!-- Note: The "styleN" class below should match that of the banner element. -->
				<header id="header" class="alt style2">
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
					</ul>
				</nav>

				<!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" class="style2">
						<div class="inner">
							<!--<span class="image">
								<img src="images/FondoLecciones.jpg" alt="" />
							</span>-->
							<header class="major" style = 'flex-wrap: wrap;
							flex-direction: row;
							align-items: center;
							justify-content: space-between;'>
								<h1>Lecciones</h1>
								<img class = 'brujula' src = 'images/brujula.png' style="width: 15%;">
							</header> 
							<div class="content">
								<p>Avanza con las lecciones<br />
								conquista los cielos. ¡Nuevos niveles pronto!</p>
							</div>
						</div>
					</section>


				<!-- Main -->
					<div id="main">
							<section id="two" class="spotlights">
							<?php
								session_name("USUARIO");
								session_start();
								$correo = $_SESSION['correo'];
								include('db.php');

								$consulta = "SELECT idNivel, promedioMin,numeroN FROM niveles";
								$resultado = mysqli_query($conexion, $consulta);

								if ($resultado) {
									$filas = mysqli_num_rows($resultado);
									if ($filas > 0) {
										while ($fila = mysqli_fetch_assoc($resultado)) {
											$idNivel = $fila['idNivel'];
											$numero = $fila['numeroN'];
											echo "<section>
													<div class='content level'>
														<div class='inner-level'>
															<button class='btn-niv' onclick='aNivel($idNivel)'>$numero</button>
														</div>
													</div>
												</section>";
										}
									} else {
										echo "No se encontraron niveles.";
									}
								} else {
									echo "Error en la consulta: " . mysqli_error($conexion);
								}
								?>

								<script type="text/javascript">
									function aNivel(no) {
										console.log(no);

										// Llamada AJAX para actualizar la sesión en el servidor
										var xmlhttp = new XMLHttpRequest();
										xmlhttp.onreadystatechange = function () {
											if (this.readyState == 4 && this.status == 200) {
												// Respuesta del servidor
												console.log(this.responseText);

												// Redireccionar a Nivel.php después de actualizar la sesión
												window.location.href = "Nivel.php";
											}
										};

										// Enviar el valor de idNivel al servidor mediante POST
										xmlhttp.open("POST", "guardar_id_nivel.php", true);
										xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
										xmlhttp.send("idNivel=" + no);
									}
								</script>

					</div>
					
				<!-- Contact --><!--
					<section id="contact">
						<div class="inner">
							<section>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" />
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="message" rows="6"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Clear" /></li>
									</ul>
								</form>
							</section>
							<section class="split">
								<section>
									<div class="contact-method">
										<span class="icon solid alt fa-envelope"></span>
										<h3>Email</h3>
										<a href="#">information@untitled.tld</a>
									</div>
								</section>
								<section>
									<div class="contact-method">
										<span class="icon solid alt fa-phone"></span>
										<h3>Phone</h3>
										<span>(000) 000-0000 x12387</span>
									</div>
								</section>
								<section>
									<div class="contact-method">
										<span class="icon solid alt fa-home"></span>
										<h3>Address</h3>
										<span>1234 Somewhere Road #5432<br />
										Nashville, TN 00000<br />
										United States of America</span>
									</div>
								</section>
							</section>
						</div>
					</section>-->

				<!-- Footer --><!--
					<footer id="footer">
						<div class="inner">
							<ul class="icons">
								<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
							</ul>
							<ul class="copyright">
								<li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>-->
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