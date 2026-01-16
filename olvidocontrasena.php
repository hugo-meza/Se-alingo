<?php
	function generarToken() {
		return bin2hex(random_bytes(32)); // Genera una cadena hexadecimal aleatoria
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$token = generarToken();
		date_default_timezone_set('America/Monterrey'); 
		$fechaActual = new DateTime();
		//echo $fechaActual;
		// Sumar un día a la fecha actual para obtener la fecha de vencimiento
		$vencimiento = $fechaActual->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
		echo $vencimiento;
		 // Genera un token de 64 caracteres hexadecimales (32 bytes)
		$para = $_POST["correo"];
		// Almacena el token en la base de datos junto con la información del usuario
		// Sustituye con tu función para obtener el ID de usuario
		include('db.php');
		// Actualiza la base de datos con la nueva reseña.
		$sql = "UPDATE usuario SET tokenU = '$token',fVencimU = '$vencimiento' WHERE emailU = '$para'";
		if ($stmt = $conexion->prepare($sql)) {
			if ($stmt->execute()) {
				echo "<script> console.log('La reseña ha sido actualizada correctamente.');</script>";
			} else {
				echo "Error al actualizar la reseña: " . $stmt->error;
			}
			
			$stmt->close();
		} else {
			echo "Error en la preparación de la consulta: " . $conn->error;
		}
		$asunto = "Restablecer contraseña";
		$mensaje = "<!DOCTYPE html>
		<html>
		<head>
			<style>
				/* Estilos del botón */
				.boton {
					display: inline-block;
					padding: 10px 20px;
					background-color: #3498db;
					color: #fff;
					text-decoration: none;
					border-radius: 5px;
					font-weight: bold;
				}
		
				/* Estilos cuando se pasa el cursor sobre el botón */
				.boton:hover {
					background-color: #2471a3;
				}
			</style>
		</head>
		<body>
			<img src = 'images/letras.png'>
			<p>Se ha solicitado restablecer su contraseña y se le envió un correo para esta acción. Haga click en el botón para terminar de reestablecer la contraseña</p>
			<a class='boton' href='http://localhost/practicas/ABP/Nuevo%20ABP/ABP/Nuevo%20ABP/recuperarcontra.php?token=$token'>Visitar Sitio Web</a>
		</body>
		</html>
		";
						
		$cabeceras = "From: senalingo@gmail.com";

		$cabeceras .= "MIME-Version: Señalingo\r\n";
		$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$cabeceras .= "SMTPSecure: tls\r\n"; // Configura TLS
											
		// Enviar el correo
		$enviado = mail($para, $asunto, $mensaje, $cabeceras);
		
		if ($enviado) {
			echo "<script> alert('El correo ha sido enviado con éxito.');window.location.href='index.php';</script>";
		} else {
			echo "<script> alert('Hubo un error al enviar el correo.'); </script>";
		}
	}
?>