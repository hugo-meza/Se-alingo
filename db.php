<?php
// 1. Cargar el "cargador" automático de Composer
require_once __DIR__ . '/vendor/autoload.php';

// 2. Buscar y cargar el archivo .env (busca en la misma carpeta donde está este archivo)
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Now read the variables
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS']; 
$name = $_ENV['DB_NAME'];

$conexion = mysqli_connect($host, $user, $pass, $name);
if (!$conexion) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    die('Database connection error. Please try again later.');
}
mysqli_set_charset($conexion, 'utf8mb4');
?>