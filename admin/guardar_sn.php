<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_de_datos = 'pollo';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base_de_datos", $usuario, $contraseña);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];

        // Verifica si ya existe un registro con los mismos valores de cantidad y descripción
        $stmt_verificar = $pdo->prepare("SELECT COUNT(*) AS cantidad_registros FROM producto WHERE cantidad = :cantidad AND descripcion = :descripcion");
        $stmt_verificar->bindParam(':cantidad', $cantidad);
        $stmt_verificar->bindParam(':descripcion', $descripcion);
        $stmt_verificar->execute();
        $resultado_verificar = $stmt_verificar->fetch(PDO::FETCH_ASSOC);

        if ($resultado_verificar['cantidad_registros'] > 0) {
            // Ya existe un registro con los mismos valores, muestra un mensaje de error y no guarda nuevamente
            header('Location: sn_promo.php?success=false&error_message=Los+datos+ya+existen.');
            exit();
        }

        // Inserta los datos en la tabla de promociones en la base de datos 'pollo'
        $stmt_insertar = $pdo->prepare("INSERT INTO producto (cantidad, descripcion, precio, categoria) VALUES (:cantidad, :descripcion, :precio, :categoria)");
        $stmt_insertar->bindParam(':cantidad', $cantidad);
        $stmt_insertar->bindParam(':descripcion', $descripcion);
        $stmt_insertar->bindParam(':precio', $precio);
        $stmt_insertar->bindParam(':categoria', $categoria);
        $stmt_insertar->execute();

        header("Location: sn_promo.php?success=true");
        exit();
    }
} catch (PDOException $e) {
    echo "Error al guardar en la base de datos: " . $e->getMessage();
}
?>
