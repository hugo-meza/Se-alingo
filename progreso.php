<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Progreso</title>
		<meta charset="utf-8" />
        <link rel="shortcut icon" href="images/senalingo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/InicioSesion/main.css" />
	</head>
	<body class="is-preload" style = "background-image: url(images/FondoLecciones.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;">

		<!-- Wrapper -->
			<div id="wrapper">

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

				<!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" class="style2">
						<div class="inner">
							<header class="major">
								<h1>Progreso</h1>
							</header>
							<div class="content">
								<p>Aqui se muestra tu progreso y desempeño<br />
								de cada nivel.</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main" class = "menu">
						<!-- One -->
							<section id="one" style = "box-sizing: unset;">
								<div class="inner">
                                    <?php
                                        session_name("USUARIO");
                                        session_start();
                                    ?>
                                    <style>
                                        #progress-bar {
                                        max-width: 600px;
                                        margin-left: 0; /* Cambia margin-left a 0 para que comience desde la izquierda */
                                        padding: 20px;
                                        width: 100%;
                                        box-sizing: unset;
                                        height: 30px;
                                        background-color: #f2f2f2;

                                        }

                                        .progreso {
                                            width: 0%;
                                            height: 100%;
                                            background-color: #2db7b0;
                                            transition: width 0.5s;
                                        }

                                        #progress {
                                        width: 0%;
                                        height: 100%;
                                        background-color: #2db7b0;
                                        transition: width 0.5s;
                                        }

                                        #progressL1 {
                                        width: 0%;
                                        height: 100%;
                                        background-color: #2db7b0;
                                        transition: width 0.5s;
                                        }

                                        #progressL2 {
                                        width: 0%;
                                        height: 100%;
                                        background-color: #2db7b0;
                                        transition: width 0.5s;
                                        }
                                    </style>
                                    <h1>Desempeño total de todos los niveles</h1>
									
                                    <div class = "desempeno_tot">
                                        <div id="progress-bar">
                                        <div id="progress"></div>
                                        </div>
                                    </div>

                                    <script>
                                        // Obtener el progreso desde PHP
                                        var progreso = <?php echo obtenerProgreso(); ?>;
                                            
                                        // Actualizar la barra de progreso
                                        actualizarBarraD(progreso);
                                            
                                        // Función para actualizar la barra de progreso
                                        function actualizarBarraD(progreso) {
                                            var barra = document.getElementById("progress");
                                            barra.style.width = progreso + "%";
                                            document.write("<div class = 'porcentaje'>" + progreso + '%' + "</div>");
                                        }
                                    </script>
                                    <?php
                                        function obtenerProgreso() {
                                            $correo = $_SESSION['correo'];
                                            include('db.php');
                                            $consulta = "SELECT * FROM accede where emailU = '$correo'";
                                            $resultado = mysqli_query($conexion,$consulta);
                                            $cont = 0;
                                            $sumPts = 0;
                                            if (mysqli_num_rows($resultado) > 0) {
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    $sumPts += $fila['pMax'];
                                                    $cont++;
                                                }
                                            } else {
                                                echo "No se encontraron niveles.";
                                            }
                                            // Acceder al valor de la columna
                                            $porc = ($sumPts * 100)/($cont * 5);
                                            echo $porc;
                                        }
                                    ?>
								</div>
							</section>
                            <section id = 'two'>
                                <ul class = "pagination" style="
                                display: flex;
                                justify-content: center;">
                                    <li><span class="button small disabled">Prev</span></li>
                                    <?php
                                        $correo = $_SESSION['correo'];
                                        include('db.php');
                                        $sql = "SELECT * FROM accede WHERE emailU = '$correo' ORDER BY idNivel ASC";
                                        $res = mysqli_query($conexion,$sql);
                                        $elementosPorPagina = 1; // Establece el número de elementos por página
                                        $totalNiveles = mysqli_num_rows($res);
                                        $totalPaginas = ceil($totalNiveles / $elementosPorPagina);

                                        for ($i = 1; $i <= $totalPaginas; $i++) {
                                            echo "<li><a href='#$i' id = 'li$i' class='page' onclick='mostrarPagina($i)'>$i</a></li>";
                                        }
                                    ?>
                                    <li><a href="#" class="button small">Next</a></li>
                                </ul>
                                <div class = 'inner progresos'>
                                    <script>
                                        function actualizarBarra(n, p){
                                            let progress = "progressN" + n;
                                            console.log(progress);
                                            var barra = document.getElementById(progress);
                                            barra.style.width = p + "%";
                                            //document.write("<div class = 'porcentaje'>" + p + '%' + "</div>");
                                        }
                                    </script>
                                    <?php
                                        
                                        if (mysqli_num_rows($res) > 0) {
                                            while ($f = mysqli_fetch_assoc($res)) {
                                                $idN = $f['idNivel'];
                                                $sum = $f['sumatoria'];
                                                $veces = $f['veces'];
                                                $pMax = $f['pMax'];
                                                //echo $idN;
                                                $sqlN = "SELECT nombreN,numeroN FROM niveles WHERE idNivel = $idN";
                                                $resN = mysqli_query($conexion,$sqlN);
                                                $fN = mysqli_fetch_assoc($resN);
                                                $nom = $fN['nombreN'];
                                                $num = $fN['numeroN'];
                                                $porcentaje = $pMax * 20;
                                                if($veces == 0){
                                                    $promedio = 0;
                                                }else{
                                                    $promedio = $sum / $veces;
                                                }
                                                echo "<div class = 'inner-nivel' id = 'inner$num' style = 'width:100%;'>
                                                <div class = 'desempeno' id = 'n$num'>
                                                    <h2>$nom nivel $num</h2>
                                                    <div id = 'progress-bar'>
                                                        <div id = 'progressN$num' class = 'progreso'></div>
                                                        <script>actualizarBarra($num,$porcentaje);</script>
                                                    </div>
                                                    <div class = 'porcentaje'>$porcentaje %</div>
                                                </div>
                                                <div class = 'info-pro'>
                                                    <h3>INFORMACION :)</h3>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Puntaje maximo obtenido</td>
                                                                <td>$pMax/5</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Veces jugadas</td>
                                                                <td>$veces</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Sumatoria de puntajes</td>
                                                                <td>$sum</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Promedio</td>
                                                                <td>$promedio</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                                </div>";
                                                
                                            }
                                        } else {
                                            echo "No se encontraron niveles.";
                                        }
                                    ?>
                                    
                                </div>
                            </section>
                            <script>
                                function mostrarPagina(pagina) {
                                    // Oculta todos los niveles
                                    var niveles = document.querySelectorAll('.inner-nivel');
                                    var lis = document.querySelectorAll(".page");
                                    niveles.forEach(function (nivel) {
                                        nivel.style.display = 'none';
                                    });
                                    lis.forEach(function (e){
                                        e.classList.remove("active");
                                    });

                                    // Muestra los niveles de la página seleccionada
                                    var elementosPorPagina = <?php echo $elementosPorPagina; ?>;
                                    var inicio = (pagina - 1) * elementosPorPagina;
                                    var fin = inicio + elementosPorPagina;
                                    var li = document.getElementById('li' + pagina);
                                    for (var i = inicio; i < fin; i++) {
                                        var nivel = document.getElementById('inner' + (i + 1));
                                        if (nivel) {
                                            li.classList.add("active");
                                            nivel.style.display = 'block';
                                        }
                                    }
                                }
                                mostrarPagina(1);
                            </script>
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