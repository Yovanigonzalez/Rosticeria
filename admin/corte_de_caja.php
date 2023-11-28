<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "pollo";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Consulta SQL para obtener el total de ventas en todas las fechas
$sql = "SELECT SUM(total) AS total_ventas FROM ventas";

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
    echo "No se encontraron ventas.";
}
?>
