<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="images/senalingo.png">
        <title>Recuperar contraseña - Señalingo</title>
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="assets/css/new.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    
                                    <div class="card-header">
                                        <img src = "images/letras.png" class = "logo-RC">
                                        <h3 class="text-center font-weight-light my-4">Restablecer Contraseña</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            if (isset($_GET['token'])) {
                                                $token = $_GET['token'];
                                                include('db.php');
                                                $sql = "SELECT tokenU, fVencimU FROM usuario WHERE tokenU = '$token'";
                                                $result = $conexion->query($sql);
                                                if ($result->num_rows > 0) {
                                                    // Token encontrado en la base de datos
                                                    $row = $result->fetch_assoc();
                                                    
                                                    $tokenBD = $row["tokenU"];
                                                    $fechaVencimiento = $row["fVencimU"];
                                                
                                                    // Verificar si el token está vencido
                                                    if (time() < $fechaVencimiento) {
                                                        // Token válido y no ha caducado
                                                        echo "<form action='recuperarcontra.php?token=$token' method = 'post'>
                                                        <div class='small mb-3 text-muted'>Ingresa tu nueva contraseña</div>
                                                        <div class='form-floating mb-3'>
                                                            <span class='icon' id='ver' onclick='mostrar()'>
                                                                <ion-icon id ='icon' name='eye-outline'></ion-icon>                                      
                                                            </span>
                                                            <input class='form-control' name ='pass1' id='inputPass' type='password'/>
                                                            <label for='inputPass'>Contraseña</label>
                                                            <script>
                                                                function mostrar(){
                                                                    console.log('aqui entraaa');
                                                                    var contra = document.getElementById('inputPass');
                                                                    var iconElement = document.getElementById('icon');
            
                                                                    // Verificar el nombre actual del icono
                                                                    if (iconElement.getAttribute('name') === 'eye-outline') {
                                                                        // Cambiar a 'eye-off-outline'
                                                                        iconElement.setAttribute('name', 'eye-off-outline');
                                                                        contra.type = 'text';
                                                                    } else {
                                                                        // Cambiar de vuelta a 'eye-outline' (por ejemplo, si se presiona de nuevo)
                                                                        iconElement.setAttribute('name', 'eye-outline');
                                                                        contra.type = 'password';
                                                                    }
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class='small mb-3 text-muted'>Ingresa de nuevo tu nueva contraseña</div>
                                                        <div class='form-floating mb-3'>
                                                            <span class='icon' id='ver' onclick='mostrar2()'>
                                                                <ion-icon id ='icon2'name='eye-outline'></ion-icon>                                      
                                                            </span>
                                                            <input class='form-control' name='pass2' id='inputPass2' type='password'/>
                                                            <label for='inputPass'>Contraseña</label>
                                                            <script>
                                                                function mostrar2(){
                                                                    console.log('aqui entraaa');
                                                                    var contra2 = document.getElementById('inputPass2');
                                                                    var iconElement2 = document.getElementById('icon2');
            
                                                                    // Verificar el nombre actual del icono
                                                                    if (iconElement2.getAttribute('name') === 'eye-outline') {
                                                                        // Cambiar a 'eye-off-outline'
                                                                        iconElement2.setAttribute('name', 'eye-off-outline');
                                                                        contra2.type = 'text';
                                                                    } else {
                                                                        // Cambiar de vuelta a 'eye-outline' (por ejemplo, si se presiona de nuevo)
                                                                        iconElement2.setAttribute('name', 'eye-outline');
                                                                        contra2.type = 'password';
                                                                    }
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class='d-flex align-items-center justify-content-between mt-4 mb-0'>
                                                            <button class='btn btn-primary' name = 'btn'>Reset Password</button>
                                                        </div>
                                                    </form>";
                                                    if (isset($_POST['btn'])) {
                                                        
                                                        $nueva = $_POST['pass1'];
                                                        $otra = $_POST['pass2'];
                                                    
                                                        if ($nueva == $otra) {
                                                            include('db.php'); // Incluye el archivo de conexión a la base de datos
                                                    
                                                            // Escapa las variables para evitar inyección SQL
                                                            $nueva = mysqli_real_escape_string($conexion, $nueva);
                                                            //$token = mysqli_real_escape_string($conexion, $token);
                                                
                                                            echo $token;
                                                            // Construye y ejecuta la consulta de actualización
                                                            $actualizar = "UPDATE usuario SET contraU = '$nueva',tokenU = NULL, fVencimU = NULL WHERE tokenU = '$token'";
                                                            if (mysqli_query($conexion, $actualizar)) {
                                                                // La contraseña se ha actualizado con éxito
                                                                echo "La contraseña ha sido actualizada.";
                                                            } else {
                                                                echo "Error al actualizar la contraseña: " . mysqli_error($conexion);
                                                            }
                                                    
                                                            // Cierra la conexión a la base de datos
                                                            mysqli_close($conexion);
                                                    
                                                            // Redirige al usuario a 'lecciones.php'
                                                            echo "<script>alert('La contraseña ha sido actualizada');</script>";
                                                            echo "<script>window.location.href = 'lecciones.php';</script>";
                                                        } else {
                                                            // Las contraseñas no coinciden
                                                            echo "<script>alert('Las contraseñas no coinciden');</script>";
                                                        }
                                                    }    
                                                    } else {
                                                        // Token caducado
                                                        echo "El token ha caducado. Debes generar uno nuevo.";
                                                    }
                                                } else {
                                                    // Token no encontrado en la base de datos
                                                    echo "Token no válido. Verifica el enlace o genera uno nuevo.";
                                                }
                                            } else {
                                                echo "No se seleccionó ninguna opción.";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
</div>
        </div>
        <div id="bg"></div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
    </body>
</html>
