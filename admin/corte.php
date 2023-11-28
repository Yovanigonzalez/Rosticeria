<?php include 'menu.php'; ?>

<html>
<head>
    <title>Corte de caja</title>
</head>
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
                                            // Incluye el archivo con el código PHP
                                            include 'corte_de_caja.php';
                                        ?>
                                        <p>Total de ventas: <?php echo $totalVentas; ?></p>
                                        <p>Ganancia: <?php echo $ganancia; ?></p>
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
            var printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.write('<html><head><title>Ganancia</title></head><body>');
            printWindow.document.write('<p>Ganancia: ' + ganancia + '</p>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
    </script>
</body>
</html>
