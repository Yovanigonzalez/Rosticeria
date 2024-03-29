<?php include 'menu.php'; ?>

<?php

include '../sql/conexion.php'; 

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM entradas";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/exito.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Inventario</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Columna del Ticket de Compra -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Inventario</h3>
                                </div>
                                <div class="card-body">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad disponible</th>
                <th>Editar</th>
            </tr>
        </thead>
<tbody>
    <?php
    // Mostrar los datos de la tabla 'entradas'
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["producto"] . "</td>";
            echo "<td>" . $row["stock"] . "</td>";
            echo "<td><a href='editar.php?id=" . $row["id"] . "' class='btn btn-primary'>Editar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay datos en la tabla 'entradas'</td></tr>";
    }
    ?>
</tbody>
    </table>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
