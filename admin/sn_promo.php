<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pollo sin Promociones</title>

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
                                    <h3 class="card-title">Agregar Pollo 'Promocion'</h3>
                                </div>
                                <div class="card-body">
                                <div class="card-body">
                                    <form method="post" action="guardar_sn.php">
                                        <!-- Mensaje de éxito -->
                                        <?php
                                            // Verificar si se debe mostrar un mensaje de éxito o error
                                            if (isset($_GET['success']) && $_GET['success'] === 'true') {
                                                echo '<div class="alert alert-success" role="alert">Los datos se han guardado correctamente.</div>';
                                            } elseif (isset($_GET['success']) && $_GET['success'] === 'false') {
                                                echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . $_GET['error_message'] . '</div>';
                                            }
                                        ?>
                                        <!-- Mensaje de error -->
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <select class="form-control" id="cantidad" name="cantidad">
                                                <option value="" disabled selected>Selecciona la cantidad</option>
                                                <option value="0.5">0.5</option>
                                                <option value="1.0">1</option>
                                                <option value="1.5">1.5</option>
                                                <option value="2.0">2</option>
                                                <option value="2.5">2.5</option>
                                                <option value="3.0">3</option>
                                                <option value="3.5">3.5</option>
                                                <option value="4.0">4</option>
                                                <option value="4.5">4.5</option>
                                                <option value="5.0">5</option>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <select class="form-control" id="descripcion" name="descripcion">
                                            <option value="" disabled selected>Selecciona la descripcion</option>
                                                <!-- Opciones para Pollo Empanizado -->
                                                <option value="1/2 Pollo Empanizado">1/2 Pollo Empanizado</option>
                                                <option value="1 Pollo Empanizado">1 Pollo Empanizado</option>
                                                <option value="1 ½ Pollo Empanizado">1 ½ Pollo Empanizado</option>
                                                <option value="2 Pollo Empanizado">2 Pollo Empanizado</option>
                                                <option value="2 ½ Pollo Empanizado">2 ½ Pollo Empanizado</option>
                                                <option value="3 Pollo Empanizado">3 Pollo Empanizado</option>
                                                <option value="3 ½ Pollo Empanizado">3 ½ Pollo Empanizado</option>
                                                <option value="4 Pollo Empanizado">4 Pollo Empanizado</option>
                                                <option value="4 ½ Pollo Empanizado">4 ½ Pollo Empanizado</option>
                                                <option value="5 Pollo Empanizado">5 Pollo Empanizado</option>

                                                <!-- Opciones para Pollo Rostizado -->
                                                <option value="1/2 Pollo Rostizado">1/2 Pollo Rostizado</option>
                                                <option value="1 Pollo Rostizado">1 Pollo Rostizado</option>
                                                <option value="1 ½ Pollo Rostizado">1 ½ Pollo Rostizado</option>
                                                <option value="2 Pollo Rostizado">2 Pollo Rostizado</option>
                                                <option value="2 ½ Pollo Rostizado">2 ½ Pollo Rostizado</option>
                                                <option value="3 Pollo Rostizado">3 Pollo Rostizado</option>
                                                <option value="3 ½ Pollo Rostizado">3 ½ Pollo Rostizado</option>
                                                <option value="4 Pollo Rostizado">4 Pollo Rostizado</option>
                                                <option value="4 ½ Pollo Rostizado">4 ½ Pollo Rostizado</option>
                                                <option value="5 Pollo Rostizado">5 Pollo Rostizado</option>

                                                <!-- Opciones para Pollo Escabeche -->
                                                <option value="1/2 Pollo Escabeche">1/2 Pollo Escabeche</option>
                                                <option value="1 Pollo Escabeche">1 Pollo Escabeche</option>
                                                <option value="1 ½ Pollo Escabeche">1 ½ Pollo Escabeche</option>
                                                <option value="2 Pollo Escabeche">2 Pollo Escabeche</option>
                                                <option value="2 ½ Pollo Escabeche">2 ½ Pollo Escabeche</option>
                                                <option value="3 Pollo Escabeche">3 Pollo Escabeche</option>
                                                <option value="3 ½ Pollo Escabeche">3 ½ Pollo Escabeche</option>
                                                <option value="4 Pollo Escabeche">4 Pollo Escabeche</option>
                                                <option value="4 ½ Pollo Escabeche">4 ½ Pollo Escabeche</option>
                                                <option value="5 Pollo Escabeche">5 Pollo Escabeche</option>

                                                <!-- Opciones para Pollo BBQ -->
                                                <option value="1/2 Pollo BBQ">1/2 Pollo BBQ</option>
                                                <option value="1 Pollo BBQ">1 Pollo BBQ</option>
                                                <option value="1 ½ Pollo BBQ">1 ½ Pollo BBQ</option>
                                                <option value="2 Pollo BBQ">2 Pollo BBQ</option>
                                                <option value="2 ½ Pollo BBQ">2 ½ Pollo BBQ</option>
                                                <option value="3 Pollo BBQ">3 Pollo BBQ</option>
                                                <option value="3 ½ Pollo BBQ">3 ½ Pollo BBQ</option>
                                                <option value="4 Pollo BBQ">4 Pollo BBQ</option>
                                                <option value="4 ½ Pollo BBQ">4 ½ Pollo BBQ</option>
                                                <option value="5 Pollo BBQ">5 Pollo BBQ</option>
                                            </select>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="text" class="form-control" id="precio" name="precio" readonly>
                                            <option value="" disabled selected>Campo automatico</option>
                                        </div>

                                        <div class="form-group">
                                            <label for="categoria">Categoría</label>
                                            <select class="form-control" id="categoria" name="categoria">
                                            <option value="" disabled selected>Selecciona la Categoría</option>
                                                <option value="Pollo">Pollo</option>
                                            </select>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


    <script>
$(document).ready(function() {
    // Define a mapping of descripcion values to prices
    var precioMapping = {
        "1/2 Pollo Empanizado": 80,
        "1 Pollo Empanizado": 160,
        "1 ½ Pollo Empanizado": 240,
        "2 Pollo Empanizado": 320,
        "2 ½ Pollo Empanizado": 400,
        "3 Pollo Empanizado": 480,
        "3 ½ Pollo Empanizado": 560,
        "4 Pollo Empanizado": 640,
        "4 ½ Pollo Empanizado": 695,
        "5 Pollo Empanizado": 800,
        "1/2 Pollo Rostizado": 60,
        "1 Pollo Rostizado": 155,
        "1 ½ Pollo Rostizado": 215,
        "2 Pollo Rostizado": 310,
        "2 ½ Pollo Rostizado": 370,
        "3 Pollo Rostizado": 465,
        "3 ½ Pollo Rostizado": 525,
        "4 Pollo Rostizado": 620,
        "4 ½ Pollo Rostizado": 680,
        "5 Pollo Rostizado": 775,
        "1/2 Pollo Escabeche": 60,
        "1 Pollo Escabeche": 155,
        "1 ½ Pollo Escabeche": 215,
        "2 Pollo Escabeche": 310,
        "2 ½ Pollo Escabeche": 370,
        "3 Pollo Escabeche": 465,
        "3 ½ Pollo Escabeche": 525,
        "4 Pollo Escabeche": 620,
        "4 ½ Pollo Escabeche": 680,
        "5 Pollo Escabeche": 775,
        "1/2 Pollo BBQ": 60,
        "1 Pollo BBQ": 120,
        "1 ½ Pollo BBQ": 180,
        "2 Pollo BBQ": 240,
        "2 ½ Pollo BBQ": 300,
        "3 Pollo BBQ": 360,
        "3 ½ Pollo BBQ": 420,
        "4 Pollo BBQ": 480,
        "4 ½ Pollo BBQ": 540,
        "5 Pollo BBQ": 600
    };

    $('#descripcion').on('change', function() {
        var descripcion = $(this).val();
        var precio = precioMapping[descripcion];

        if (precio !== undefined) {
            $('#precio').val(precio.toFixed(2));
        } else {
            $('#precio').val('');
        }
    });
});
</script>


</body>
</html>
