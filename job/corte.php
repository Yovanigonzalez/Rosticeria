<?php include 'menu.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">

                        <!-- Columna del Ticket de Compra -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ticket de Compra</h3>
                                </div>

                                <div class="card-body">
                                    <section>
                                        <h2>Corte de Caja</h2>
                                        <?php
                                            // Conexión a la base de datos
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $database = "p";

                                            $conn = new mysqli($servername, $username, $password, $database);

                                            // Verificar la conexión
                                            if ($conn->connect_error) {
                                                die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
                                            }

                                            // Consulta SQL para obtener el total de ventas en todas las fechas
                                            $sql = "SELECT SUM(total) AS total_ventas FROM ventas";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // Obtenemos el total de ventas
                                                $row = $result->fetch_assoc();
                                                $totalVentas = $row["total_ventas"];

                                                // Aquí puedes calcular la ganancia (por ejemplo, restando los costos si los tienes)
                                                $ganancia = $totalVentas;

                                                // Mostrar el corte de caja y la ganancia
                                                echo "<p>Total de ventas: $totalVentas</p>";
                                                echo "<p>Ganancia: $ganancia</p>";
                                            } else {
                                                echo "No se encontraron ventas.";
                                            }

                                            // Cerrar la conexión
                                            $conn->close();
                                        ?>
<button class="btn btn-sm btn-primary" onclick="imprimirGanancia()">Imprimir Ganancia</button>
                                    </section>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
    function imprimirGanancia() {
        var ganancia = "<?php echo $ganancia; ?>";
        // Crear una ventana emergente con solo el valor de la ganancia
        var printWindow = window.open('', '', 'width=300,height=200');
        printWindow.document.write('<html><head><title>Ganancia</title></head><body>');
        printWindow.document.write('<p>Ganancia: ' + ganancia + '</p>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }
</script>




</body>
