<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entradas</title>

    <!-- Agregar enlaces a los archivos CSS de Bootstrap (CSS y Tema opcional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-theme.min.css">

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
                                    <h3 class="card-title">Edita Entradas</h3>
                                </div>

                                <?php
                                include '../sql/conexion.php'; 

                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }

                                // Inicializar variables
                                $producto = "";
                                $stock = "";

                                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
                                    $producto_id = $_GET["id"];

                                    $sql = "SELECT * FROM entradas WHERE id = $producto_id";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        $producto = $row["producto"];
                                        $stock = $row["stock"];
                                    } else {
                                        echo "No se encontró el producto";
                                        exit();
                                    }
                                } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar"])) {
                                    $producto_id = $_POST["id"];
                                    $nuevo_producto = $_POST["producto"];
                                    $nuevo_stock = $_POST["stock"];

                                    $sql_update = "UPDATE entradas SET producto = '$nuevo_producto', stock = '$nuevo_stock' WHERE id = $producto_id";

                                    if ($conn->query($sql_update) === TRUE) {
                                        echo '<div class="alert alert-success" role="alert">Producto actualizado correctamente</div>';
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';
                                    }
                                }

                                $conn->close();
                                ?>

                                <!-- Formulario HTML con estilos de Bootstrap -->
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="p-3">
                                    <input type="hidden" name="id" value="<?php echo $producto_id; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="producto" class="form-label">Producto:</label>
                                        <input type="text" name="producto" value="<?php echo $producto; ?>" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Cantidad disponible:</label>
                                        <input type="text" name="stock" value="<?php echo $stock; ?>" class="form-control" required>
                                    </div>

                                    <button type="submit" name="guardar" class="btn btn-primary">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Agregar enlaces a los archivos JS de Bootstrap (jQuery y Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
