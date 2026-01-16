<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tablas - Señalingo</title>
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
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style = "background-image: url(images/FondoLecciones.jpg);
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
                        <h1 class="mt-4">Tablas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index-admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body tablas">
                                Escoge la tabla de la base de datos a mostrar
                                <select name="tablas" id="tablas" >
                                    <?php
                                        include('db.php');
                                        $sql = "SHOW TABLES FROM senalingo";
                                        $result = $conexion->query($sql);
                                        if ($result) {
                                            // Recorre los resultados
                                            while ($row = $result->fetch_assoc()) {
                                                $tableName = $row['Tables_in_senalingo'];
                                                echo "<option value = '$tableName'>$tableName</option>";
                                            }
                                        } else {
                                            // Maneja el caso en que la consulta no sea exitosa
                                            echo "Error al obtener las tablas: " . $conexion->error;
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla
                            </div>
                            <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Correo</th>
                                                <th>Edad</th>
                                                <th>Genero</th>
                                                <th>Puntaje</th>
                                                <th>Reseña</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Asigna la función al evento de cambio en el elemento select
                                            document.getElementById("tablas").addEventListener("change", mostrarTablaSeleccionada);

                                            // Función para cargar la tabla seleccionada
                                            function mostrarTablaSeleccionada() {
                                                // Obtiene el valor seleccionado del elemento select
                                                var tablaSeleccionada = document.getElementById("tablas").value;
                                                var padre = document.getElementsByClassName("card-body");
                                                var divTableEmpty = document.getElementsByClassName("datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns datatable-empty");
                                                var divTable = document.getElementsByClassName("datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns");
                                                if (divTable[0]) {
                                                    padre[0].removeChild(divTable[0]);
                                                }
                                                if(divTableEmpty[0]){
                                                    padre[0].removeChild(divTableEmpty[0]);
                                                }
                                                // Realiza una solicitud AJAX para obtener el contenido de la tabla
                                                var xhr = new XMLHttpRequest();
                                                xhr.onreadystatechange = function () {
                                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                                        // Actualiza el contenido del contenedor con la respuesta del servidor
                                                        document.getElementById("datatablesSimple").innerHTML = xhr.responseText;

                                                        // Vuelve a inicializar la DataTable después de actualizar el contenido
                                                        const datatablesSimpleUpdated = new simpleDatatables.DataTable('#datatablesSimple');
                                                    }
                                                };

                                                // Realiza una solicitud GET al archivo PHP que genera la tabla correspondiente
                                                xhr.open("GET", "generarTabla.php?tabla=" + tablaSeleccionada, true);
                                                xhr.send();
                                            }
                                        });
                                    </script>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src='assets/js/datatables-simple-demo.js'></script>-->
    </body>
</html>
