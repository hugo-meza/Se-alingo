<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel - Señalingo Admin</title>
        <link rel="shortcut icon" href="images/senalingo.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/umd/simple-datatables.min.js"></script>
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
                        <li><a class="dropdown-item" href="cerrarsesion.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style = "background-image: url(images/FondoLecciones.jpg);
        background-size: cover;
        background-attachment: scroll;
        background-repeat: repeat;
        height: auto;">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index-admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel
                            </a>
                            <a class="nav-link" href="niveles.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-puzzle-piece"></i></i></div>
                                Niveles
                            </a>
                            <div class="sb-sidenav-menu-heading">Interfaces</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Lecciones y Modulos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="crearNivel.php">Crear Nivel</a>
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
                                Tablas
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
                        <div class = "header-crearN"><h1 class="mt-4">Niveles</h1><button class = "btn btn-sm order-1 order-lg-0 me-4 me-lg-0" style="display: flex; flex-direction: row; align-items: center;" onclick = "dirigirCN()">  <span style="margin-right: 10px;font-size: 18px;">Crear nivel</span><i class="fa-solid fa-square-plus" style='font-size: 3em;'></i></button></div>
                        <script>
                            function dirigirCN(){
                                window.location.href = "crearNivel.php";
                            }
                        </script>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Crea y edita niveles</li>
                        </ol>
                        <div class="row">
                            <?php
                                include('db.php');
                                $sql = "SELECT * FROM niveles";
                                $result = $conexion->query($sql);
                                if($result){
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['idNivel'];
                                        $nombre = $row['nombreN'];
                                        $numero = $row['numeroN'];
                                        $des = $row['descripcionN'];
                                        $num = 0;
                                        $query = "SELECT COUNT(*) AS num FROM gif WHERE idNivel = $id";
                                        $r = $conexion->query($query);
                                        if ($r->num_rows > 0) {
                                            // Obtener el resultado
                                            $fila = $r->fetch_assoc();
                                            $num = $fila['num'];
                                        
                                            //echo "Total de filas con la clave foránea especifica: " . $totalFilas;
                                        }
                                        echo "<div class = 'col-xl-4 col-md-auto'>";
                                        echo "<div class = 'card bg-secondary text-white mb-4'>";
                                        echo "<div class='card-body'>
                                        <div class = 'card-header'>$numero</div>
                                        <div class = 'card-header'>$nombre</div>
                                        <div class = 'card-subtitle'></div>
                                        <div class = 'card-header'>$des</div>
                                        <div class = 'card-text'>Cantidad de gifs: $num</div>
                                        </div>
                                        <div class='card-footer d-flex align-items-center justify-content-between'>
                                            
                                            <a class='small text-white stretched-link' href='cambiarNivel.php?nivel=$id'>Modificar</a>
                                            <div class='small text-white'><i class='fas fa-angle-right'></i></div>
                                        </div>
                                        </div>
                                        </div>";

                                    }
                                }else{
                                    echo "Error al obtener datos de la tabla: " . $conexion->error;
                                }
                            ?>
                        </div>                        
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <!--<script src="assets/ajs/datatables-simple-demo.js"></script>-->
    </body>
</html>
