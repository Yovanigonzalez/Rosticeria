<?php
// Conexión a la base de datos
include '../sql/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Obtener la fecha actual (puedes cambiarla a la fecha que desees)
$fechaElegida = date("Y-m-d");

// Consulta SQL para obtener el total de ventas en una fecha específica
$sql = "SELECT SUM(total) AS total_ventas FROM ventas WHERE DATE(fecha_hora) = '$fechaElegida'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtenemos el total de ventas
    $row = $result->fetch_assoc();
    $totalVentas = $row["total_ventas"];

    // Aquí puedes calcular la ganancia (por ejemplo, restando los costos si los tienes)
    $ganancia = $totalVentas;

    // Cerrar la conexión
    $conn->close();
} else {
    echo "No se encontraron ventas para la fecha seleccionada.";
}
?>
