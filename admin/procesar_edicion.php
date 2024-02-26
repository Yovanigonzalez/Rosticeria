<?php
// Establecer la conexión a la base de datos (reemplaza los valores con los de tu configuración)
include 'sql/conexion.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $product_id = $_POST["product_id"];
    $cantidad = $_POST["cantidad"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $categoria = $_POST["categoria"];

    // Inicializar una variable de éxito/error
    $success = false;

    // Actualizar los datos del producto en la base de datos de manera segura utilizando declaraciones preparadas
    $sql = "UPDATE producto SET cantidad = ?, descripcion = ?, precio = ?, categoria = ? WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $cantidad, $descripcion, $precio, $categoria, $product_id);

    if ($stmt->execute()) {
        // La actualización se realizó con éxito
        $success = true;
    }

    // Cierra la declaración preparada
    $stmt->close();

    // Cierra la conexión a la base de datos al finalizar
    $conn->close();

    // Realiza las redirecciones en función de la variable de éxito/error
    if ($success) {
        header("Location: acciones.php?success=true");
    } else {
        header("Location: acciones.php?success=false&error_message=" . urlencode("Error al guardar los datos en la base de datos: " . $stmt->error));
    }
}
?>
