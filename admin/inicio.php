<?php
include 'menu.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Costilla</title>
    <!-- Add CSS or external resources here if needed -->

    <!-- Agregar la biblioteca Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barra de navegación y sidebar aquí -->
        
        <!-- Contenido principal -->
        <div class="content-wrapper">
>

            <!-- Gráfica de barras semanal y gráfica circular mensual de 436px de ancho y alto -->
            <div class="container">
    <div class="row">
        <!-- Ganancia Semanal Section -->
        <div class="col-md-6">


            <div class="card">
                <div class="card-body">
                    <canvas id="graficaBarrasSemanal" style="width: 100%; height: 300px;"></canvas>
                </div>
            </div>
        </div>



        <!-- Monthly Bar Chart Section -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Ganancia Mensual</h2><br>
                    <div class="form-group">
                        <label for="yearSelect" class="font-weight-bold">Seleccionar Año:</label>
                        <select id="yearSelect" class="form-control">
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <!-- Add more years as needed -->
                        </select>
                    </div>
                    <canvas id="graficaBarrasMensual" style="width: 100%; height: 300px;"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
        </div>
    </div>

    <script>
        // Sample data for the weekly bar chart
        var dataBarrasSemanal = {
            labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
            datasets: [{
                label: 'Ganancia Semanal',
                data: [1000, 1500, 2000, 1500],
                backgroundColor: ['red', 'blue', 'green', 'orange']
            }]
        };

        // Sample data for the monthly bar chart
        var dataBarrasMensual = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Ganancia Mensual',
                data: [1500, 2000, 1800, 2200, 2500, 2300, 2400, 2600, 2100, 1900, 2200, 2400],
                backgroundColor: ['red', 'blue', 'green', 'orange', 'purple', 'cyan', 'magenta', 'yellow', 'lightblue', 'pink', 'lime', 'teal'],
            }]
        };

        // Get the canvas context for the weekly bar chart
        var ctxBarrasSemanal = document.getElementById('graficaBarrasSemanal').getContext('2d');

        // Get the canvas context for the monthly bar chart
        var ctxBarrasMensual = document.getElementById('graficaBarrasMensual').getContext('2d');

        // Create the weekly bar chart
        var graficaBarrasSemanal = new Chart(ctxBarrasSemanal, {
            type: 'bar',
            data: dataBarrasSemanal,
            options: {
                title: {
                    display: true,
                    text: 'Ganancia Semanal de Ejemplo'
                }
            }
        });

        // Create the monthly bar chart
        var graficaBarrasMensual = new Chart(ctxBarrasMensual, {
            type: 'bar',
            data: dataBarrasMensual,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Ganancia Mensual de Ejemplo'
                }
            }
        });

        // Function to update the monthly chart based on the selected year
        document.getElementById('yearSelect').addEventListener('change', function () {
            // Replace this with the logic to fetch data for the selected year and update the chart
            // For now, let's update the chart with random data
            var selectedYear = this.value;
            var newData = generateRandomData(selectedYear);
            graficaBarrasMensual.data.datasets[0].data = newData;
            graficaBarrasMensual.update();
        });

        // Generate random data for the chart (for demonstration purposes)
        function generateRandomData(year) {
            var data = [];
            for (var i = 0; i < 12; i++) {
                data.push(Math.floor(Math.random() * 3000) + 1000); // Random data between 1000 and 4000
            }
            return data;
        }
    </script>
</body>
</html>
