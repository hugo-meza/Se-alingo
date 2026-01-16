<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts - SB Admin</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index-admin.php"> <img src="images\letras.png" class="logo"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav"style = "background-image: url(images/FondoLecciones.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index-admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Lecciones y Modulos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.php">Crear Nivel</a>
                                    <a class="nav-link" href="layout-sidenav-light.php">Editar Niveles</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Páginas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="previsualizacion.php?opcion=index">Principal</a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Inicio
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="previsualizacion.php?opcion=Lecciones">Lecciones</a>
                                            <a class="nav-link" href="previsualizacion.php?opcion=repaso">Repaso</a>
                                            <a class="nav-link" href="previsualizacion.php?opcion=progreso">Progreso</a>
                                            <a class="nav-link" href="previsualizacion.php?opcion=perfil">Perfil</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Graficas
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Usuarios
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Graficas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index-admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Charts</li>
                        </ol>
                        <div class = "row">
                            <div class ="col-xl-6">
                                <div class="card mb-4">
                                    <div class = "card-header">Género de usuarios</div>
                                    <div class="card-body">
                                        <div class = "home_grafica">
                                            <div class = "graficas">
                                                <div class = "graficas_container_genero">
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
                                                    <canvas id="myChart" width="500px" height="500px" style = "width: 100%; height:50%"></canvas>
                                                    <?php
                                                        include('db.php');
                                                        $consulta="SELECT generoU FROM usuario";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                        $mujer=0;
                                                        $hombre=0;
                                                        $otro = 0;
                                                        if($resultado){
                                                        while($row = $resultado->fetch_array()){
                                                            $genero=$row['generoU']; //cambiar lo de adentro por lo q quiero sacar de la base de datos
                                                            if($genero === "Masculino"){
                                                                $hombre = $hombre+1;
                                                            }else if($genero === "Femenino"){
                                                                $mujer = $mujer+1;
                                                            }else{
                                                                $otro = $otro+1;
                                                            }
                                                        }
                                                        }
                                                    ?>
                                                    <script>
                                                        const etiquetas = ['Femenino', 'Masculino','Otro'];
                                                        const valores = [<?php echo $mujer; ?>, <?php echo $hombre; ?>,<?php echo $otro; ?>];
                                                        const ctx = document.getElementById('myChart').getContext('2d');
                                                        const myChart = new Chart(ctx, {
                                                        type: 'pie',
                                                        data: {
                                                            labels: etiquetas,
                                                            datasets: [{
                                                                label: 'Genero',
                                                                data: valores,
                                                                backgroundColor: ['#FF6384','#36A2EB','#ff000']
                                                            }]
                                                        },
                                                            options: {
                                                            responsive: false,
                                                            maintainAspectRatio: true,
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-xl-6">
                                <div class="card mb-4">
                                    <div class = "card-header">Edad de los usuarios</div>
                                    <div class="card-body">
                                        <div class = "graficas_container_edad">
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
                                            <canvas id="myChart2" width="500px" height="500px" style = "width: 100%; height:50%"></canvas>
                                            <?php
                                                include('db.php');
                                                $consulta="SELECT fNacU FROM usuario";
                                                $resultado=mysqli_query($conexion,$consulta);
                                                $menor = 0;
                                                $mayor = 0;
                                                if($resultado){
                                                while($row = $resultado->fetch_array()){
                                                    $fechaNacimientoObj = new DateTime($row['fNacU']);
                                                    // Obtener la fecha actual
                                                    $fechaActual = new DateTime();

                                                    // Calcular la diferencia entre las fechas
                                                    $diferencia = $fechaNacimientoObj->diff($fechaActual);

                                                    // Obtener la edad
                                                    $edad = $diferencia->y;
                                                    //$edad=$row['fNacU']; //cambiar lo de adentro por lo q quiero sacar de la base de datos
                                                    if($edad < 18){
                                                        $menor = $menor+1;
                                                    }else{
                                                        $mayor = $mayor+1;
                                                    }
                                                }
                                                }
                                            ?>
                                            <script>
                                                const etiquetas2 = ['menor(<18)', 'mayor(>=18)'];
                                                const valores2 = [<?php echo $menor; ?>, <?php echo $mayor; ?>];
                                                const ctx2 = document.getElementById('myChart2').getContext('2d');
                                                const myChart2 = new Chart(ctx2, {
                                                type: 'pie',
                                                data: {
                                                    labels: etiquetas2,
                                                    datasets: [{
                                                        label: 'Edad',
                                                        data: valores2,
                                                        backgroundColor: ['#6BF1DF','#5753ED']
                                                    }]
                                                },
                                                    options: {
                                                    responsive: false,
                                                    maintainAspectRatio: true,
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Area Chart Example
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Pie Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
    </body>
</html>
