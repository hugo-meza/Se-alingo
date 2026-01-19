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
						<!--<li><a href="#" class="button fit">Log In</a></li>-->
					</ul>
				</nav>

				<!-- Banner -->
					<section id="banner" class="major">
						<div class="inner">
							<header class="major">
								<h1>Material de apoyo</h1>
							</header>
							<div class="content">
								<p>Aquí encontrarás material de apoyo de las lecciones que ya hayas completado.<br />
								Video y documento explicativos :).</p>
								<!--<ul class="actions">
									<li><a href="#one" class="button next scrolly">Get Started</a></li>
								</ul>-->
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one" class="tiles">
								<?php
									session_start();
									
									// Validate user is logged in
									if (empty($_SESSION['correo'])) {
										header("Location: index.php");
										exit();
									}
									
									include('db.php');
									
									// Use prepared statement
									$stmt = $conexion->prepare("SELECT nombreN, descripcionN, idNivel FROM niveles");
									if (!$stmt) {
										error_log("Prepare failed: " . $conexion->error);
										die('Error al cargar repaso');
									}
									
									$stmt->execute();
									$result = $stmt->get_result();
									
                                    if ($result) {
                                        // Recorre los resultados
                                        while ($row = $result->fetch_assoc()) {
                                            $nombre = htmlspecialchars($row['nombreN'], ENT_QUOTES, 'UTF-8');
											$desc = htmlspecialchars($row['descripcionN'], ENT_QUOTES, 'UTF-8');
											$id = (int)$row['idNivel'];
                                            echo "<article>
											<span class='image'>
												<img src='images/pic01.jpg' alt='' />
											</span>
											<header class='major'>
												<h3><a href='contenidos.php?nivel=$id&nombre=$nombre' class='link'>$nombre</a></h3>
												<p>$desc</p>
											</header>
										</article>";
                                        }
                                    } else {
                                        // Maneja el caso en que la consulta no sea exitosa
                                        echo "Error al obtener las tablas: " . $conexion->error;
                                    }
									$stmt->close();
								?>								
							</section>

						<!-- Two 
							<section id="two">
								<div class="inner">
									<header class="major">
										<h2>Massa libero</h2>
									</header>
									<p>Nullam et orci eu lorem consequat tincidunt vivamus et sagittis libero. Mauris aliquet magna magna sed nunc rhoncus pharetra. Pellentesque condimentum sem. In efficitur ligula tate urna. Maecenas laoreet massa vel lacinia pellentesque lorem ipsum dolor. Nullam et orci eu lorem consequat tincidunt. Vivamus et sagittis libero. Mauris aliquet magna magna sed nunc rhoncus amet pharetra et feugiat tempus.</p>
									<ul class="actions">
										<li><a href="landing.html" class="button next">Get Started</a></li>
									</ul>
								</div>
							</section>-->

					</div>

				<!-- Contact 
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

				<!-- Footer 
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