<?php
// Establecer la conexión a la base de datos (reemplaza los valores con los de tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pollo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Verificar si se ha proporcionado un ID de producto válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Utilizar una sentencia preparada para evitar inyección SQL
    $sql = "DELETE FROM producto WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a 'acciones.php' con un mensaje de éxito
        header("Location: acciones.php?success=true");
        exit();
    } else {
        // Redirigir a 'acciones.php' con un mensaje de error
        header("Location: acciones.php?success=false&error_message=" . urlencode("Error al eliminar el producto: " . $stmt->error));
        exit();
    }
} else {
    // Redirigir a 'acciones.php' con un mensaje de error si el ID de producto no es válido
    header("Location: acciones.php?success=false&error_message=" . urlencode("ID de producto no válido."));
    exit();
}

// Cerrar la conexión a la base de datos (este código no se ejecutará debido a las redirecciones)
$conn->close();
?>
