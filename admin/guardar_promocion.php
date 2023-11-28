<?php
// Conexión a la base de datos 'pollo'
$conexion = mysqli_connect('localhost', 'root', '', 'pollo');

// Verifica la conexión
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Procesa los datos del formulario
$cantidad = $_POST['cantidad'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];

// Verifica si ya existe un registro con los mismos valores de cantidad y descripción
$sql_verificar = "SELECT COUNT(*) AS cantidad_registros FROM producto WHERE cantidad = ? AND descripcion = ?";
$stmt_verificar = mysqli_prepare($conexion, $sql_verificar);
mysqli_stmt_bind_param($stmt_verificar, "ss", $cantidad, $descripcion);
mysqli_stmt_execute($stmt_verificar);
$resultado_verificar = mysqli_stmt_get_result($stmt_verificar);
$fila_verificar = mysqli_fetch_assoc($resultado_verificar);

if ($fila_verificar['cantidad_registros'] > 0) {
    // Ya existe un registro con los mismos valores, muestra un mensaje de error y no guarda nuevamente
    header('Location: pollo.php?success=false&error_message=Los+datos+ya+existen.');
    exit();
}

// Inserta los datos en la tabla de promociones en la base de datos 'pollo'
$sql = "INSERT INTO producto (cantidad, descripcion, precio, categoria) VALUES (?, ?, ?, ?)";

// Prepara la consulta SQL
$stmt = mysqli_prepare($conexion, $sql);

// Vincula los parámetros
mysqli_stmt_bind_param($stmt, "ssds", $cantidad, $descripcion, $precio, $categoria);

// Ejecuta la consulta
if (mysqli_stmt_execute($stmt)) {
    // Redirige con mensaje de éxito
    header('Location: pollo.php?success=true');
    exit();
} else {
    // Redirige con mensaje de error y el mensaje de error
    $error_message = mysqli_error($conexion);
    header('Location: pollo.php?success=false&error_message=' . urlencode($error_message));
    exit();
}

// No es necesario cerrar la conexión aquí, ya que la página se redirige antes de llegar a este punto
?>
