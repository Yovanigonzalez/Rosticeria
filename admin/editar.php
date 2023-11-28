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

// Verificar si se ha proporcionado un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Realizar una consulta SQL para obtener los datos del producto a editar
    $sql = "SELECT id, cantidad, descripcion, precio, categoria FROM producto WHERE id = $product_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Aquí puedes utilizar los valores de $row para llenar los campos del formulario de edición
        $cantidad = $row["cantidad"];
        $descripcion = $row["descripcion"];
        $precio = $row["precio"];
        $categoria = $row["categoria"];
    } else {
        echo "No se encontró el producto.";
    }
} else {
    echo "ID de producto no válido.";
}

// Cierra la conexión a la base de datos al finalizar
$conn->close();
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barra de navegación y sidebar aquí -->
        <!-- Contenido principal -->
        <div class="content-wrapper">                                                                                                                                                                         
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Editar Producto</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Formulario de edición -->
                                    <form method="POST" action="procesar_edicion.php">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad:</label>
                                            <input type="text" class="form-control" name="cantidad" value="<?php echo $cantidad; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripción:</label>
                                            <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="precio">Precio:</label>
                                            <input type="text" class="form-control" name="precio" value="<?php echo $precio; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="categoria">Categoría:</label>
                                            <input type="text" class="form-control" name="categoria" value="<?php echo $categoria; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
