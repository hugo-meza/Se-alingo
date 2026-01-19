<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Perfil - Señalingo</title>
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="images/senalingo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/InicioSesion/main.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<noscript><link rel="stylesheet" href="assets/css/InicioSesion/noscript.css" /></noscript>
	</head>
	<body class="is-preload" style = "background-image: url(images/FondoLecciones.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
	height: 100vh;">

		<!-- Wrapper -->
			<div id="wrapper" style="height: 100%;">

				<!-- Header -->
				<!-- Note: The "styleN" class below should match that of the banner element. -->
				<header id="header" class="alt style2" style = "background-color: #242943;">
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
							<section id="one" style="height: 100%;">
								<div class="inner" style="height: 100%;">
                                    <div class="contenedor" style= "width: 100%;height:100%;">
                                        <div class="row" style="height: 100%;">
											<?php
												session_start();
												
												// Validate user is logged in
												if (empty($_SESSION['correo'])) {
													header("Location: index.php");
													exit();
												}
												
												$correo = $_SESSION['correo'];
												include('db.php');
												
												// Use prepared statement to avoid SQL injection
												$stmt = $conexion->prepare("SELECT imagenU, nUsuario, fNacU, generoU FROM usuario WHERE emailU = ?");
												if (!$stmt) {
													error_log("Prepare failed: " . $conexion->error);
													die('Error al cargar el perfil');
												}
												
												$stmt->bind_param("s", $correo);
												$stmt->execute();
												$result = $stmt->get_result();
												
												if (!($fila = $result->fetch_assoc())) {
													header("Location: index.php");
													exit();
												}
												
												$img = $fila['imagenU'];
												$nU = $fila['nUsuario'];
												$fnac = $fila['fNacU'];
												$genero = $fila['generoU'];
												$stmt->close();
											?>
                                            <div class="col-md-3 border-right">
												<?php
													echo "<div class='d-flex flex-column align-items-center text-center p-3 py-5'>
													<div id='fotoPrincipal' onclick='mostrarMenu()'>
														<img class = 'perfil-foto' src = '$img'>
													</div>
													<div id='menuImagenes' style='display: none;position: absolute;top: 90%;left: 50%;transform: translate(-50%, -50%);'>";
													$archivos = scandir("images/Perfil");
													$cont = 1;
													foreach ($archivos as $archivo) {
														// Excluir los directorios "." y ".."
														if ($archivo != '.' && $archivo != '..') {
															echo "<img src='images/Perfil/$archivo' alt='Perfil $cont' onclick='cambiarFoto('images/Perfil/$archivo')'>'";
															$cont++;
														}
													}
													echo "</div>"
												?>
												<script>
													function mostrarMenu() {
														var menuImagenes = document.getElementById('menuImagenes');
														menuImagenes.style.display = (menuImagenes.style.display === 'flex') ? 'none' : 'flex';
													}

													function cambiarFoto(nuevaImagen) {
														var fotoPrincipal = document.getElementById('fotoPrincipal').getElementsByTagName('img')[0];
														fotoPrincipal.src = nuevaImagen;
														ocultarMenu();
													}

													function ocultarMenu() {
														var menuImagenes = document.getElementById('menuImagenes');
														menuImagenes.style.display = 'none';
													}
												</script>
												<?php
													echo "<span class='text-black-50'>$correo</span><span> </span></div>";
												?>
                                            </div>
											<div class="col-md-5 border-right">
												<div class="p-3 py-5">
													<div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h4 class="text-right">Configuración de reseña</h4>
                                                    </div>
													<div class="fields">
														<?php
															$enca = '';
															$puntaje = '';
															$desc = '';
															// Use prepared statement
															$stmt = $conexion->prepare("SELECT encabezado, puntaje, descRes FROM resena WHERE emailU = ? AND puntaje IS NOT NULL AND encabezado IS NOT NULL AND descRes IS NOT NULL");
															if ($stmt) {
																$stmt->bind_param("s", $correo);
																$stmt->execute();
																$r = $stmt->get_result();
																if ($filaR = $r->fetch_assoc()) {
																	$enca = $filaR['encabezado'];
																	$puntaje = $filaR['puntaje'];
																	$desc = $filaR['descRes'];
																}
																$stmt->close();
															}
														?>
														<div class = "field">
															<label for="name">Calificacion</label>
															<div class="calificacion" id="calificacion">
															<img class="abeja" src="images/abeja-calif.png" data-valor="1" alt="Abeja 1">
															<img class="abeja" src="images/abeja-calif.png" data-valor="2" alt="Abeja 2">
															<img class="abeja" src="images/abeja-calif.png" data-valor="3" alt="Abeja 3">
															<img class="abeja" src="images/abeja-calif.png" data-valor="4" alt="Abeja 4">
															<img class="abeja" src="images/abeja-calif.png" data-valor="5" alt="Abeja 5">
															<script>
																// Define la variable en JavaScript con el valor de PHP
																var calif = <?php echo json_encode($puntaje); ?>;
															</script>
															
															</div>
														</div>
														<div class="field">
															<label for="name">Encabezado</label>
															<?php
																echo "<input type='text' name='encabezado' id='encabezado' maxlength ='30' value = $enca>";
															?>
															
														</div>
														<div class="field">
															<label for="message">Reseña</label>
															<textarea name="resena" id="resena" rows="6" maxlength = '100'><?php echo $desc;?></textarea>
														</div>
														<div class = "field">
																<ul class = "actions">
																	<li>
																		<input type="submit" value="Guardar datos" class="primary">
																	</li>
																</ul>
														</div>
													</div>
												</div>
                                            </div>
                                            <div class="col-md-3 border-right">
                                                <div class="p-3 py-5">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h4 class="text-right">Configuración de perfil</h4>
                                                    </div>
													<form>
														<div class = "row gtr-uniform">
															<div class='row mt-2'>
																<div class='col-md-6'><label class='labels'>Usuario</label>
																<?php
																	echo "<input type='text' id = 'usuario' class='form-control' value='$nU' >";
																?>
																</div>
															</div>
															<div class="row mt-3">
																<div class="col-md-12"><label class="labels">Fecha de nacimiento</label>
																<?php
																	echo "<input type='date' id = 'fnac' class='form-control' value='$fnac' >"
																?>
																</div>
																<div class="col-md-12"><label class="labels">Género</label>
																<?php
																	echo "<select class = 'datos' id = 'genero' name = 'genero' >
																	<option value='Masculino'>Masculino</option>
																	<option value='Femenino'>Femenino</option>
																	<option value='Otro'>Otro</option>
																	</select>";
																	echo "<script>
																	var g = '$genero';
																	var select = document.getElementById('genero');
																	for (var i = 0; i < select.options.length; i++) {
																		// Compara el valor de la opción con la variable
																		if (select.options[i].value === g) {
																			// Si coincide, establece la opción como seleccionada
																			select.options[i].selected = true;
																			break; // Rompe el bucle una vez que se ha encontrado una coincidencia
																		}
																	}
																	</script>";
																?>
																</div>
															</div>
															<div class = "col-12">
																<ul class = "actions">
																	<li>
																		<input type="button" onclick = 'verificar()' value="Guardar datos" class="primary">
																	</li>
																</ul>
																<?php
																	// Use prepared statement
																	$stmt = $conexion->prepare("SELECT nUsuario FROM usuario WHERE emailU != ?");
																	if ($stmt) {
																		$stmt->bind_param("s", $correo);
																		$stmt->execute();
																		$r = $stmt->get_result();
																		// Initialize array to store usernames
																		$f = array();
																		while ($fila = $r->fetch_assoc()) {
																			$f[] = $fila['nUsuario'];
																		}
																		$stmt->close();
																	} else {
																		$f = array();
																	}
																?>
																<script>
																	function verificar(){
																		var lista = <?php echo json_encode($f); ?>;
																		var usutxt = document.getElementById("usuario").value;
																		var fnac = document.getElementById("fnac").value;
																		var genero = document.getElementById("genero").value;
																		console.log("usuario " + usutxt + " f nac " + fnac + " genero " +genero);
																		
																		if (lista.includes(usutxt)) {
																			alert("Ese usuario no esta disponible :(");
																		}else{
																			var datos = {
																				usuario : usutxt,
																				genero : genero,
																				fnac : fnac
																			};
																			// Supongamos que tienes datos que quieres enviar al servidor
																			// Crea una instancia de XMLHttpRequest
																			var xhr = new XMLHttpRequest();

																			xhr.open("POST", "actualizarUsuario.php", true);
																			xhr.setRequestHeader("Content-Type", "application/json");

																			xhr.onerror = function () {
																				console.error("Error en la solicitud AJAX");
																			};

																			xhr.onreadystatechange = function () {
																				if (xhr.readyState == 4) {
																					if (xhr.status == 200) {
																						console.log("Respuesta del servidor:", xhr.responseText);
																						eval(xhr.responseText);
																						// Maneja la respuesta del servidor según sea necesario
																					} else {
																						console.error("Error en la solicitud. Código de estado:", xhr.status);
																					}
																				}
																			};

																			xhr.send(JSON.stringify(datos));
																		}
																	}
																</script>
															</div>
														</div>
													</form>                                                   
                                                </div>
                                            </div>
											
                                        </div>
                                    </div>
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
			<script src="assets/js/InicioSesion/script-perfil.js"></script>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	</body>
</html>