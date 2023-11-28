<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    
    // Verificar si ya existe un registro con la misma cantidad y descripción
    $sql_verificar = "SELECT COUNT(*) AS cantidad_registros FROM producto WHERE cantidad = ? AND descripcion = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("ss", $cantidad, $descripcion);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();
    $fila_verificar = $resultado_verificar->fetch_assoc();

    if ($fila_verificar['cantidad_registros'] > 0) {
        // Ya existe un registro con los mismos valores, muestra un mensaje de error
        $error_message = "Los datos ya existen en la base de datos.";
    } else {
        // No existe un registro con los mismos valores, procede a la inserción
        // Definir un objeto que mapea la descripción al precio correspondiente
        $precioMapping = array(
            "Molleja" => 35,
            "Ensalada Rusa" => 25,
            "Sopa de codo" => 25,
            "Patas de pollo" => 25,
            "½ Orden de Alitas Habanero" => 60,
            "1 Orden de Alitas Habanero" => 110,
            "1 ½ Orden de Alitas Habanero" => 170,
            "2 Orden de Alitas Habanero" => 220,
            "½ Orden de Alitas BBQ" => 60,
            "1 Orden de Alitas BBQ" => 110,
            "1 ½ Orden de Alitas BBQ" => 170,
            "2 Orden de Alitas BBQ" => 220,
            "½ Orden de Boneles Búfalo" => 35,
            "1 Orden de Boneles Búfalo" => 70,
            "1 ½ Orden de Boneles Búfalo" => 105,
            "2 Orden de Boneles Búfalo" => 140,
            "½ Orden Boneles Limón" => 35,
            "1 Orden Boneles Limón" => 70,
            "1 ½ Orden Boneles Limón" => 105,
            "2 Orden Boneles Limón" => 140,
            "Palomitas de pollo" => 70,
            "Frijoles" => 15,
            "Arroz" => 5,
            "Salsa" => 5
        );

        // Verificar si la descripción existe en el mapeo
        if (array_key_exists($descripcion, $precioMapping)) {
            $precio = $precioMapping[$descripcion];
        } else {
            $precio = 0; // Otra acción si la descripción no se encuentra en el mapeo
        }

        // Preparar la consulta SQL para la inserción
        $sql = "INSERT INTO producto (cantidad, descripcion, precio, categoria) VALUES (?, ?, ?, ?)";

        // Preparar una declaración
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros
        $stmt->bind_param("ssds", $cantidad, $descripcion, $precio, $categoria);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // El registro se insertó con éxito
            $success_message = "Los datos se han guardado correctamente en la base de datos.";
        } else {
            // Hubo un error al insertar el registro
            $error_message = "Error al guardar los datos en la base de datos: " . $stmt->error;
        }

        // Cerrar la declaración de inserción
        $stmt->close();
    }

    // Cerrar la declaración de verificación
    $stmt_verificar->close();
    // Cerrar la conexión
    $conn->close();
}

// Redirigir a la página anterior con mensajes de éxito o error
if (isset($success_message)) {
    header('Location: extra.php?success=true&message=' . urlencode($success_message));
    exit();
} elseif (isset($error_message)) {
    header('Location: extra.php?success=false&error_message=' . urlencode($error_message));
    exit();
}
?>
