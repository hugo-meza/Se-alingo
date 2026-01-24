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
    ">

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
						<svg id="lienzo-svg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;">
							<path id="linea-rastro" d="" />
						</svg>
						<section id="two" class="spotlights">
							<?php
								session_start();
								
								// Validate user is logged in
								if (empty($_SESSION['correo'])) {
									header("Location: index.php");
									exit();
								}
								
								$correo = $_SESSION['correo'];
								include('db.php');

								// Use prepared statement
								$stmt = $conexion->prepare("SELECT idNivel, promedioMin, numeroN FROM niveles");
								if (!$stmt) {
									error_log("Prepare failed: " . $conexion->error);
									die('Error al cargar lecciones');
								}
								
								$stmt->execute();
								$resultado = $stmt->get_result();

								if ($resultado) {
									$filas = $resultado->num_rows;
									if ($filas > 0) {
										while ($fila = $resultado->fetch_assoc()) {
											$idNivel = $fila['idNivel'];
											$numero = $fila['numeroN'];
											echo "<section>
													<div class='content level'>
														<div class='inner-level'>
															<button class='btn-niv' id='btn$numero' onclick='aNivel($idNivel)'>$numero</button>
														</div>
													</div>
												</section>";
										}
									} else {
										echo "No se encontraron niveles.";
									}
								} else {
									echo "Error en la consulta: " . $conexion->error;
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

									function conectarBotones() {
										const btn1 = document.getElementById('btn1');
										const btn2 = document.getElementById('btn2');
										const path = document.getElementById('linea-rastro');
										const svg = document.getElementById('lienzo-svg');

										if (!btn1 || !btn2 || !path || !svg) return;

										// --- FUNCIÓN MÁGICA PARA CORREGIR EL DESFASE ---
										// Convierte cualquier coordenada de la pantalla (clientX, clientY)
										// al sistema de coordenadas exacto dentro de tu SVG.
										function getSVGCoordinates(element) {
											const rect = element.getBoundingClientRect();
											const pt = svg.createSVGPoint();
											
											// Tomamos el centro del elemento
											pt.x = rect.left + rect.width / 2;
											pt.y = rect.top + rect.height / 2;

											// Transformamos ese punto usando la matriz del SVG
											// Esto corrige scroll, zoom, viewBox y posición absoluta automáticamente
											return pt.matrixTransform(svg.getScreenCTM().inverse());
										}

										// 1. Obtener coordenadas exactas en el mundo SVG
										const p1 = getSVGCoordinates(btn1);
										const p2 = getSVGCoordinates(btn2);

										// 2. Calcular la curva
										// En lugar de una altura fija (-150), la hacemos proporcional a la distancia.
										// Si están lejos, la curva es alta. Si están cerca, es baja.
										const deltaX = p2.x - p1.x;
										const deltaY = p2.y - p1.y;
										const distancia = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
										
										// Altura del arco: 30% de la distancia total (ajusta el 0.3 a tu gusto)
										// El Math.min es para que no sea exageradamente alto si están muy lejos
										const alturaArco = Math.min(distancia * 0.4, 300); 

										// Punto medio
										const midX = (p1.x + p2.x) / 2;
										const midY = (p1.y + p2.y) / 2;

										// El punto de control jala la línea hacia arriba (restando a Y)
										// Nota: Si quieres que la curva siempre vaya "hacia arriba" visualmente, resta a Y.
										// Si quieres que sea perpendicular a la línea, requiere más trigonometría.
										const controlX = midX;
										const controlY = midY - alturaArco;

										// 3. Dibujar de Centro a Centro (La clave estética)
										// Deja que el CSS (z-index) tape el inicio de la línea.
										const d = `M ${p1.x} ${p1.y} Q ${controlX} ${controlY} ${p2.x} ${p2.y}`;

										const dist = Math.abs(p2.x - p1.x) * 0.5; // La fuerza depende de la distancia
										const cp1_s = { x: p1.x + dist, y: p1.y }; 
										const cp2_s = { x: p2.x - dist, y: p2.y };
										const d_s = `M ${p1.x} ${p1.y} C ${cp1_s.x} ${cp1_s.y} ${cp2_s.x} ${cp2_s.y} ${p2.x} ${p2.y}`;

										const cp1_loop = { x: p1.x, y: p1.y + 300 }; // Baja mucho
										const cp2_loop = { x: p2.x, y: p2.y - 100 }; // Sube por debajo del destino
										const d_loop = `M ${p1.x} ${p1.y} C ${cp1_loop.x} ${cp1_loop.y} ${cp2_loop.x} ${cp2_loop.y} ${p2.x} ${p2.y}`;

										path.setAttribute('d', d_loop);
									}

									// Esperar a que el DOM esté completamente cargado
									document.addEventListener('DOMContentLoaded', function() {
										conectarBotones();
										window.addEventListener('resize', conectarBotones);
									});

								</script>
						</section>
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