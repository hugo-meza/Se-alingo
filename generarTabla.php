<?php
// generar_tabla.php

include('db.php');

// Obtén el nombre de la tabla de la solicitud GET
$tablaSeleccionada = $_GET['tabla'];

// Realiza una consulta para obtener el contenido de la tabla seleccionada
$query = "SELECT * FROM $tablaSeleccionada";
$result = $conexion->query($query);

if ($result) {
    // Obtiene los nombres de las columnas
    $columnas = array_keys($result->fetch_assoc());
    echo "<table id = 'datatablesSimple'>";

    echo "<thead>";
    echo "<tr>";
    // Muestra los nombres de las columnas como encabezados de tabla
    foreach ($columnas as $columna) {
        echo "<th>$columna</th>";
    }
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
    $result->data_seek(0);

    // Muestra los datos de la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Muestra los valores de cada columna
        foreach ($columnas as $columna) {
            echo "<td>" . $row[$columna] . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
echo "";
} else {
    echo "Error al obtener datos de la tabla: " . $conexion->error;
}

?>

