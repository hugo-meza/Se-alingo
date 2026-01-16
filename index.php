<!DOCTYPE HTML>
<html lang = 'es'>
	<head>
		<title>Señalingo</title>
        <link rel="shortcut icon" href="images/senalingo.png">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-rwEzj5w5W5WgW5M2r5Pz5OV5Ck5l5F5a5A5Pz5g5f5J5o5i5n5g5T5Q5o5V5u5y5b5q5I" crossorigin="anonymous">
--><noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
						</div>
						<div class="content">
							<div class="inner">
								<img src = "images/letras.png" class = "logo">
								<p>Aqui ponemos info</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="#inicio">Inicio</a></li>
								<li><a href="#plandeestudios">Plan de estudios</a></li>
								<li><a href="#sobrenosotros">Sobre nosotros</a></li>
								<li><a href="#iniciar">Ingresar</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Intro -->
							<article id="inicio">
								<h2 class="major">Inicio</h2>
								<div class = 'contenedor'>
									<?php
										include('db.php');
										$consulta = "SELECT * FROM infopag WHERE seccion = 'Inicio' ORDER BY nParrafo ASC";
										$result = $conexion->query($consulta);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												$subt = $row['subtitulo'];
												$texto = $row['texto'];
												$img = $row['imagen'];
												echo "<div class = 'cont-inicio'>
												<div class = 'info'>
													<h3>$subt</h3>
													<p>$texto</p>
												</div>
												<span class = 'image main'><img src= '$img'></span>
												</div>";
											}
										}
									?>
								</div>
							</article>

						<!-- Work -->
							<article id="plandeestudios">
								<h2 class="major">Plan de estudios</h2>
								<span class="image main"><img src="images/pic02.jpg" alt="" /></span>
								<p>Señalingo ofrece una gama amplia de vocabulario para aprender a comunicarse con el Lengua de Señas Mexicano (LSM). Nosotros te enseñamos de forma dinamica y divertida sin que dejes la comodidad de tu casa. Dentro de nuestro sitio web encontrarás variedad de material, tanto videos como documentos descriptivos de las señas, sobre los temas que se muestran ( y más por agregarse):</p>
								<ul class="materias">
									<?php
										include('db.php');
										$consulta = "SELECT nombreN, descripcionN FROM niveles";
										$result = $conexion->query($consulta);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												$nombre = $row['nombreN'];
												$desc = $row['descripcionN'];
												echo "<li class='materia'>
												<h3>$nombre</h3>
												<p>$desc</p>
												</li>";
											}
										}
									?>
								</ul>
							</article>

						<!-- About -->
							<article id="sobrenosotros">
								<h2 class="major">Sobre nosotros<img src="images/nino-manos.png" style="position: absolute;border-bottom: solid 1px;width: 100px;top: 13.2px;"></h2>
								<!-- CONECTAR A BD CON LA PARTE DE INFO INICIAL-->
								<div class = 'contenedor'>
									<?php
										include('db.php');
										$consulta = "SELECT * FROM infopag WHERE seccion = 'SobreNosotros' ORDER BY nParrafo ASC";
										$result = $conexion->query($consulta);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												$subt = $row['subtitulo'];
												$texto = $row['texto'];
												$img = $row['imagen'];
												echo "<div class = 'cont-inicio'>
												<div class = 'info'>
													<h3>$subt</h3>
													<p>$texto</p>
												</div>
												<span class = 'image main'><img src= '$img'></span>
												</div>";
											}
										}
									?>
								</div>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>
								<p></p>
							</article>

                            <article id="iniciar">
								<h2 class="major">Iniciar sesión</h2>
                                <form action="validarLogin.php" id="Ingresar" method = "post"><!--Aqui esta nuestro form que manda a validar-->  
                                    <div class="input-box">
										<span class="icon"><ion-icon name="mail"></ion-icon></span>
										<input type="email"  class = "input-I-S" id = "correo" name = "correo" required />
										<label>Correo</label>
                                    </div>
                                    <div class="input-box">
                                    <span class="icon" id="ver" onclick='mostrar()'>
										<ion-icon id ='icon'name="eye-outline"></ion-icon>                                      
                                    </span>
                                    <input type="password" class = "input-I-S" id = "pass" name = "pass" required />                                    
                                    <script>
                                        function mostrar(){
                                            console.log("aqui entraaa");
                                            var contra = document.getElementById("pass");
											var iconElement = document.getElementById("icon");

											// Verificar el nombre actual del icono
											if (iconElement.getAttribute("name") === "eye-outline") {
												// Cambiar a "eye-off-outline"
												iconElement.setAttribute("name", "eye-off-outline");
												contra.type = "text";
											} else {
												// Cambiar de vuelta a "eye-outline" (por ejemplo, si se presiona de nuevo)
												iconElement.setAttribute("name", "eye-outline");
												contra.type = "password";
											}
                                        }
                                    </script>
                                    <label>Contraseña</label>
                                    </div>
                                    <div class="remember-forgot">
                                    <a href="#contrasena">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <button type="submit" class="btn" id = "boton">Ingresar</button>
									<div class="login-register">
										<p class = "login-p">
											¿No tienes una cuenta?<a href="#registrar" class="register-link"
											>Registrate</a
											>
										</p>
									</div>
                                </form>
								<ul class="icons">
									<li><a href="https://www.instagram.com/senalingo_271/" class= "redes" ><span class="RedesLogos"><ion-icon name="logo-instagram"></ion-icon></span></a></li>
									<li><a href="https://www.facebook.com/groups/6387604664630120" class= "redes" ><span class="RedesLogos"><ion-icon name="logo-facebook"></ion-icon></span></a></li>
									<li><a href="https://twitter.com/Senalingo271/" class= "redes" ><span class="RedesLogos"><ion-icon name="logo-twitter"></ion-icon></span></a></li>
								</ul>
								<p></p>
							</article>

							<article id="registrar">
								<h2 class="major">Registrate</h2>
                                <form action="registrarse.php" method = "post">
									<div class="input-box">
										<span class="icon"><ion-icon name="mail"></ion-icon></span>
										<input type="email" class = "input-I-S" name = "email" required />
										<label>Correo</label>
									</div>

									<div class="input-box">
										<!--<span class="icon"><ion-icon name="calendar-number-outline"></ion-icon></span>-->
										<input type="date" class = "input-I-S-f" name = "fNac" required onfocus="mostrarPlaceholder()" onblur="ocultarPlaceholder()"/>
										<label>Fecha de nacimiento</label>
										<script>
											function mostrarPlaceholder() {
												let campoFecha = document.querySelector('.input-I-S-f');
												campoFecha.classList.remove('input-I-S-f-placeholder');
											}

											function ocultarPlaceholder() {
												let campoFecha = document.querySelector('.input-I-S-f');
												if (!campoFecha.value) {
													campoFecha.classList.add('input-I-S-f-placeholder');
												}
											}

											// Al cargar la página, oculta el placeholder si hay un valor predeterminado
											window.onload = function () {
												ocultarPlaceholder();
											};
										</script>
									</div>

									<div class = "input-box">
										<span class = "icon"><ion-icon name="transgender-outline"></ion-icon></span>
										<label class = "lbl-g" style="top: -30%;">Género</label>
										<select id = 'genero' name = 'genero'>
											<option value='Masculino'>Masculino</option>
											<option value='Femenino'>Femenino</option>
											<option value='Otro'>Otro</option>
										</select>
									</div>

									<div class = "input-box">
										<span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
										<input type="text" class = "input-I-S" name = "usuario"required />
										<label>Usuario</label>
									</div>

									<div class="input-box">
									<span class="icon" id="ver" onclick='mostrar2()'>
										<ion-icon id ='icon2'name="eye-outline"></ion-icon>                                      
                                    </span>
                                    <input type="password" class = "input-I-S" id = "password" name = "pass2" required />                                    
                                    <script>
                                        function mostrar2(){
                                            console.log("aqui entraaa");
                                            var contra2 = document.getElementById("password");
											var iconElement2 = document.getElementById("icon2");

											// Verificar el nombre actual del icono
											if (iconElement2.getAttribute("name") === "eye-outline") {
												// Cambiar a "eye-off-outline"
												iconElement2.setAttribute("name", "eye-off-outline");
												contra2.type = "text";
											} else {
												// Cambiar de vuelta a "eye-outline" (por ejemplo, si se presiona de nuevo)
												iconElement2.setAttribute("name", "eye-outline");
												contra2.type = "password";
											}
                                        }
                                    </script>
                                    <label>Contraseña</label>

									</div>
									<button type="submit" class="btn">Registrarse</button>
									<div class="login-register">
										<p>
										¿Ya tienes una cuenta? <a href="#iniciar" class="login-link">Ingresar</a>
										</p>
									</div>
                    			</form>
								<ul class="icons">
									<li><a href="https://www.instagram.com/senalingo_271/" class= "redes" ><span class="RedesLogos"><ion-icon name="logo-instagram"></ion-icon></span></a></li>
									<li><a href="https://www.facebook.com/groups/6387604664630120" class= "redes" ><span class="RedesLogos"><ion-icon name="logo-facebook"></ion-icon></span></a></li>
									<li><a href="https://twitter.com/Senalingo271/" class= "redes" ><span class="RedesLogos"><ion-icon name="logo-twitter"></ion-icon></span></a></li>
								</ul>
								<p></p>
							</article>

							<article id="soporte">
								<h2 class="major">Soporte y ayuda<img src = 'images/sam-ayuda.png' style="position: absolute; border-bottom: solid 1px; width: 123px; top: 23.2px;"></h2>
								<p>Describe tu problema/solicitud de manera detallada. Ponte atento a tu correo para poderle darle seguimiento a tu problema.</p>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="email">Correo</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field half">
											<label for="subject">Asunto</label>
											<input type="text" name="text" id="subject" />
										</div>
										<div class="field">
											<label for="message">Descripcion</label>
											<textarea name="message" id="message" rows="7"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
										<li></li>
									</ul>
									
								</form>
							</article>

							<article id="solicitud">
								<h2 class="major">Solicitud de maestro</h2>
								<p>¿Quieres ser parte de los maestros de Señalingo? Podrás crear niveles y subir material. Envía tu solicitud aquí y estate pendiente de tu correo</p>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="email">Correo</label>
											<input type="text" name="email" id="email" />
										</div>
										<div class="field half">
											<label for="subject">Asunto</label>
											<input type="text" name="text" id="subject" />
										</div>
										<div class="field">
											<label for="message">Descripcion</label>
											<textarea name="message" id="message" rows="7"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send Message" class="primary" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</form>
							</article>

							<article id="contrasena">
								<h2 class="major">Restablecer contraseña</h2>
								<p>Te enviaremos instrucciones para que puedas restablecer tu contraseña</p>
								<form method="post" action="olvidocontrasena.php">
									<div class="input-box">
										<input type="email"  class = "input-I-S" id = "correo" name = "correo" required />
										<label>Correo</label>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Enviar" class="primary" /></li>
									</ul>
								</form>
							</article>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">¿Necesitas ayuda?<a href = "#soporte">Haz click aqui</a> ¿Quieres ser maestro? <a href = "#solicitud">Envía solicitud aquí</a>.</p>
					</footer>

			</div>
		<!-- BG -->
			<div id="bg"></div>
		<!-- Scripts -->
			<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>
