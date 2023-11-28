<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p"; // Nombre de la base de datos

// Obtener los datos enviados por la solicitud POST
$categoria = $_POST['categoria'];
$cantidad = $_POST['cantidad'];

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Actualizar el stock en la tabla 'entradas' donde la categoría coincide
$sqlActualizarStock = "UPDATE entradas SET stock = stock - $cantidad WHERE categoria = '$categoria'";

if ($conn->query($sqlActualizarStock) === TRUE) {
    // El stock se actualizó correctamente
    echo "Stock actualizado correctamente en la base de datos.";
} else {
    // Hubo un error al actualizar el stock
    echo "Error al actualizar el stock: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
