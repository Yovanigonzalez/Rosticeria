<?php
include 'menu.php';

// Establecer la conexión a la base de datos (reemplaza los valores con los de tu configuración)
include 'sql/conexion.php';


// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Paginación
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página actual
$records_per_page = 5; // Número de resultados por página
$offset = ($page - 1) * $records_per_page; // Cálculo del desplazamiento

// Definir una consulta SQL para obtener los datos con paginación
$sql = "SELECT id, cantidad, descripcion, precio, categoria FROM producto LIMIT $offset, $records_per_page";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con Bootstrap y Búsqueda</title>
    <!-- Agrega los enlaces a los archivos de estilo de Bootstrap y JavaScript de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                                    <h3 class="card-title">Acciones</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Campo de búsqueda -->
                                    <?php
                                            // Verificar si se debe mostrar un mensaje de éxito o error
                                            if (isset($_GET['success']) && $_GET['success'] === 'true') {
                                                echo '<div class="alert alert-success" role="alert">Realizado con éxito.</div>';
                                            } elseif (isset($_GET['success']) && $_GET['success'] === 'false') {
                                                echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . $_GET['error_message'] . '</div>';
                                            }
                                        ?>

                                    <div class="form-group">
                                        <label for="busqueda">Buscar:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="busqueda" placeholder="Ingrese el término de búsqueda">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="btnBuscar" type="button">Buscar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tabla para mostrar los registros existentes con motor de búsqueda -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Precio</th>
                                                <th>Categoría</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["descripcion"] . "</td>";
                                                    echo "<td>" . $row["precio"] . "</td>";
                                                    echo "<td>" . $row["categoria"] . "</td>";
                                                    echo "<td>";
                                                    echo '<a href="editar.php?id=' . $row["id"] . '" class="btn btn-warning">Editar</a>';
                                                    echo ' ';
                                                    // Agregar una confirmación antes de eliminar
                                                    echo '<button class="btn btn-danger" onclick="confirmarEliminar(' . $row["id"] . ')">Eliminar</button>';
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <!-- Paginación -->
                                    <ul class="pagination justify-content-center">
                                        <?php
                                        // Consulta para contar el número total de registros
                                        $total_records = $conn->query("SELECT COUNT(*) FROM producto")->fetch_row()[0];
                                        
                                        // Calcula el número total de páginas
                                        $total_pages = ceil($total_records / $records_per_page);

                                        // Muestra los enlaces de paginación
                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <!-- Script de JavaScript para el motor de búsqueda y confirmación de eliminación -->
    <script>
        $(document).ready(function(){
            $("#btnBuscar").on("click", function() {
                var value = $("#busqueda").val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        // Función para mostrar confirmación antes de eliminar
        function confirmarEliminar(id) {
            if (confirm("¿Está seguro de eliminar este producto?")) {
                window.location.href = "eliminar.php?id=" + id;
            }
        }
    </script>
</body>
</html>
