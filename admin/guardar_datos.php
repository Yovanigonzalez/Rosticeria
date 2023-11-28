<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "p";

// Crear una conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Variable para almacenar el mensaje de éxito
$mensajeExito = "";

// Variable para almacenar el mensaje de error
$mensajeError = "";

function guardarDatos($cantidad, $descripcion, $precio, $categoria, $conexion) {
    // Consulta SQL para verificar la existencia de un registro con los mismos valores
    $sql_verificar = "SELECT COUNT(*) AS count FROM productos WHERE cantidad = ? AND descripcion = ? AND precio = ?";
    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("sss", $cantidad, $descripcion, $precio);
    $stmt_verificar->execute();
    $result = $stmt_verificar->get_result();
    $row = $result->fetch_assoc();
    $registro_existente = $row['count'];

    if ($registro_existente > 0) {
        // Mostrar mensaje de error con la clase .error-message
        return "El registro ya existe en la base de datos.";
    } else {
        // Prepara la consulta SQL para la inserción
        $sql = "INSERT INTO productos (cantidad, descripcion, precio, categoria) VALUES (?, ?, ?, ?)";

        // Prepara la declaración
        $stmt = $conexion->prepare($sql);

        // Vincula los parámetros
        $stmt->bind_param("ssss", $cantidad, $descripcion, $precio, $categoria);

        // Ejecuta la consulta de inserción
        if ($stmt->execute()) {
            return "Los datos se han guardado correctamente en la base de datos.";
        } else {
            // Mostrar mensaje de error con la clase .error-message
            return "Error al guardar los datos en la base de datos: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    }
}

// Llama a la función guardarDatos con los valores apropiados
$mensajeResultado = guardarDatos($cantidad, $descripcion, $precio, $categoria, $conexion);

// Cierra la conexión a la base de datos
$conexion->close();

// Imprime el mensaje de éxito o error
echo $mensajeResultado;
?>
