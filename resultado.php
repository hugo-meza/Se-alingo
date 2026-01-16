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
	overflow: hidden">
		<script>
			window.onload = function () {
                history.replaceState({ fromHistory: true }, null, window.location.href);
            };

		</script>

		<!-- Wrapper -->
		<div id="wrapper" style = "padding-top: 4em;">

			<!-- Header -->
			<!-- Note: The "styleN" class below should match that of the banner element. -->
			<header id="header" class="alt act" style="
				background-color: #242943;
				opacity: 0.85;
				height: 4em;">
				<nav>
                    <?php
                        session_name("USUARIO");
						session_start();
                        $pts = $_SESSION['puntos'];
                        //echo "<img id = 'img-puntos' class = 'puntos-abeja' src = 'images/jarron/pts$pts.png'>";
                    ?>
                    <h1>Resultados</h1>
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
							<button onclick = 'regresar()' id = 'btn-sig' >Siguiente</button>
						</div>
						<span class="image-act">
                            
							<?php
                                echo "<img src = 'images/jarron/resultado$pts.png' style = 'height: 77vh;'>";
                                //echo $_SESSION['puntos'];
							?>						
						</span>
						<script>
							function regresar(){
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        // Respuesta del servidor
                                        console.log(this.responseText);

                                        // Agrega un nuevo estado al historial antes de redirigir
                                        history.pushState({ fromHistory: true }, null, window.location.href);
    
                                        // Redirige a lecciones.php
                                        window.location.href = "lecciones.php";
                                    }
                                };

                                // Enviar la solicitud POST al archivo PHP sin enviar ningún dato
                                xmlhttp.open("POST", "actualizarPuntos.php", true);
                                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xmlhttp.send();
                            }
						</script>
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