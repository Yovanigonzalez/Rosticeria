<?php include 'menu.php'; ?>


<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pollo";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la tabla 'entradas'
$sql = "SELECT * FROM entradas";
$result = $conn->query($sql);

?>

<title>Inventario</title>
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
