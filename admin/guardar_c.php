<?php
include 'conexion.php';

// Define un objeto que mapea la descripción al precio correspondiente
$precioMapping = array(
    "¼ de Costilla de Puerco" => 60,
    "½ de Costilla de Puerco" => 120,
    "1 kg de Costilla de Puerco" => 230,
    // Agrega otras descripciones y precios aquí
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST["cantidad"];
    $descripcion = $_POST["descripcion"];
    $precio = $precioMapping[$descripcion]; // Obtén el precio del mapeo
    $categoria = $_POST["categoria"];

    // Verifica si ya existe un registro con la misma cantidad y descripción
    $sql_verificar = "SELECT COUNT(*) AS cantidad_registros FROM producto WHERE cantidad = ? AND descripcion = ?";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bind_param("ss", $cantidad, $descripcion);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();
    $fila_verificar = $resultado_verificar->fetch_assoc();

    if ($fila_verificar['cantidad_registros'] > 0) {
        // Ya existe un registro con los mismos valores, redirecciona con un mensaje de error
        header('Location: costilla.php?success=false&error_message=Los+datos+ya+existen.');
        exit();
    } else {
        // No existe un registro con los mismos valores, procede a la inserción

        // Prepara la consulta SQL para insertar datos en la base de datos
        $sql = "INSERT INTO producto (cantidad, descripcion, precio, categoria) VALUES (?, ?, ?, ?)";

        // Prepara la sentencia
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        // Vincula los parámetros
        $stmt->bind_param("ssss", $cantidad, $descripcion, $precio, $categoria);

        // Ejecuta la sentencia
        if ($stmt->execute()) {
            // El registro se insertó con éxito, redirecciona con un mensaje de éxito
            header('Location: costilla.php?success=true');
            exit();
        } else {
            // Hubo un error al insertar el registro, redirecciona con un mensaje de error
            header('Location: costilla.php?success=false&error_message=' . urlencode("Error al guardar los datos en la base de datos: " . $stmt->error));
            exit();
        }

        // Cierra la sentencia
        $stmt->close();
    }

    // Cierra la sentencia de verificación
    $stmt_verificar->close();
    // Cierra la conexión
    $conn->close();
}
?>
