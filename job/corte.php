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
                                            include '../sql/conexion.php';

                                            // Verificar la conexión
                                            if ($conn->connect_error) {
                                                die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
                                            }

                                            // Consulta SQL para obtener el total de ventas en todas las fechas
                                            // Obtener la fecha actual (puedes cambiarla a la fecha que desees)
                                            $fechaElegida = date("Y-m-d");

                                            // Consulta SQL para obtener el total de ventas en una fecha específica
                                            $sql = "SELECT SUM(total) AS total_ventas FROM ventas WHERE DATE(fecha_hora) = '$fechaElegida'";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // Obtenemos el total de ventas
                                                $row = $result->fetch_assoc();
                                                $totalVentas = $row["total_ventas"];
                                                
                                                // Obtener gastos desde el formulario
                                                $gastos = isset($_POST['gastos']) ? floatval($_POST['gastos']) : 0;

                                                // Calcular ganancia después de restar gastos
                                                $ganancia = $totalVentas - $gastos;

                                                // Mostrar el corte de caja, la ganancia y "Dia a dia"
                                                echo "<p>Total de ventas: $totalVentas</p>";
                                                echo "<p>Ganancia: <span id='ganancia'>$ganancia</span></p>";
                                            } else {
                                                echo "No se encontraron ventas.";
                                            }

                                            // Cerrar la conexión
                                            $conn->close();
                                        ?>
                                        <form id="gastosForm">
                                            <label for="gastos">Gastos:</label>
                                            <input type="text" id="gastos" name="gastos" placeholder="Ingrese los gastos" class="form-control">
                                        </form>
                                        <br>
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
        // Obtener elementos del DOM
        var gastosInput = document.getElementById('gastos');
        var gananciaElement = document.getElementById('ganancia');
        var diaADiaElement = document.getElementById('diaADia');

        // Escuchar cambios en el campo de gastos y actualizar la ganancia en tiempo real
        gastosInput.addEventListener('input', function () {
            var gastos = parseFloat(gastosInput.value) || 0;
            var ganancia = <?php echo $totalVentas; ?> - gastos;
            
            // Actualizar la ganancia y "Dia a dia" en tiempo real
            gananciaElement.textContent = ganancia;
            diaADiaElement.textContent = ganancia;
        });

        function imprimirGanancia() {
            var gananciaDiaADia = gananciaElement.textContent;
            var fechaHora = new Date().toLocaleString(); // Obtener la fecha y hora actual
            var gastos = parseFloat(gastosInput.value) || 0;

            // Crear una ventana emergente con la información de ganancia y gastos
            var printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.write('<html><head><title>Ganancia</title></head><body>');
            printWindow.document.write('<p>Fecha y Hora: ' + fechaHora + '</p>');
            printWindow.document.write('<p>Gastos: ' + gastos + '</p>');
            printWindow.document.write('<p>Ganancia: ' + gananciaDiaADia + '</p>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
    </script>

</body>
