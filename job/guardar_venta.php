<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p"; // Nombre de la base de datos

// Establecer la zona horaria a GMT-6 (Hora Central de México)
date_default_timezone_set('America/Mexico_City');

// Obtener la fecha y hora actual en formato deseado
$fechaHora = date('Y-m-d H:i:s'); // Formato: Año-Mes-Día Hora:Minutos:Segundos

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la venta de la solicitud POST
$descripcion = $_POST['descripcion'];
$total = $_POST['total'];

// Crear una consulta SQL para insertar la venta en la base de datos
$sql = "INSERT INTO ventas (descripcion, total, fecha_hora) VALUES ('$descripcion', $total, '$fechaHora')";

if ($conn->query($sql) === TRUE) {
    echo "Venta registrada con éxito.";
} else {
    echo "Error al registrar la venta: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
