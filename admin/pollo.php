<?php include 'menu.php'; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Promociones</title>

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

                                <?php
    // Verificar si se debe mostrar un mensaje de éxito o error
    if (isset($_GET['success']) && $_GET['success'] === 'true') {
        echo '<div class="alert alert-success" role="alert">Los datos se han guardado correctamente.</div>';
    } elseif (isset($_GET['success']) && $_GET['success'] === 'false') {
        echo '<div class="alert alert-danger" role="alert">Error al guardar los datos: ' . $_GET['error_message'] . '</div>';
    }
    ?>
                                <div class="card-body">
                                    <form method="post" action="guardar_promocion.php">
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
                                                <option value="5.5">5.5</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <select class="form-control" id="descripcion" name="descripcion">
                                            <option value="" disabled selected>Selecciona la descripcion</option>
                                                <option value="1/2 Pollo Asado">1/2 Pollo Asado</option>
                                                <option value="1 Pollo Asado">1 Pollo Asado</option>
                                                <option value="1 ½ Pollo Asado">1 ½ Pollo Asado</option>
                                                <option value="2 Pollo Asado">2 Pollo Asado</option>
                                                <option value="2 ½  Pollo Asado">2 1/2 Pollo Asado</option>
                                                <option value="3 Pollo Asado">3 Pollo Asado</option>
                                                <option value="3 ½ Pollo Asado">3 ½ Pollo Asado</option>
                                                <option value="4 Pollo Asado">4 Pollo Asado</option>
                                                <option value="4 ½  Pollo Asado">4 1/2 Pollo Asado</option>
                                                <option value="5 Pollo Asado">5 Pollo Asado</option>
                                                <option value="5 ½  Pollo Asado">5 1/2 Pollo Asado</option>
                                                
                                                <!-- Opciones para Pollo Adobado -->
                                                <option value="1/2 Pollo Adobado">1/2 Pollo Adobado</option>
                                                <option value="1 Pollo Adobado">1 Pollo Adobado</option>
                                                <option value="1 ½ Pollo Adobado">1 ½ Pollo Adobado</option>
                                                <option value="2 Pollo Adobado">2 Pollo Adobado</option>
                                                <option value="2 ½  Pollo Adobado">2 1/2 Pollo Adobado</option>
                                                <option value="3 Pollo Adobado">3 Pollo Adobado</option>
                                                <option value="3 ½ Pollo Adobado">3 ½ Pollo Adobado</option>
                                                <option value="4 Pollo Adobado">4 Pollo Adobado</option>
                                                <option value="4 ½ Pollo Adobado">4 1/2 Pollo Adobado</option>
                                                <option value="5 Pollo Adobado">5 Pollo Adobado</option>
                                                <option value="5 ½ Pollo Adobado">5 1/2 Pollo Adobado</option>

                                                <!-- Opciones para Pollo Encacahuatado -->
                                                <option value="1/2 Pollo Encacahuatado">1/2 Pollo Encacahuatado</option>
                                                <option value="1 Pollo Encacahuatado">1 Pollo Encacahuatado</option>
                                                <option value="1 ½ Pollo Encacahuatado">1 ½ Pollo Encacahuatado</option>
                                                <option value="2 Pollo Encacahuatado">2 Pollo Encacahuatado</option>
                                                <option value="2 ½ Pollo Encacahuatado">2 1/2 Pollo Encacahuatado</option>
                                                <option value="3 Pollo Encacahuatado">3 Pollo Encacahuatado</option>
                                                <option value="3 ½ Pollo Encacahuatado">3 ½ Pollo Encacahuatado</option>
                                                <option value="4 Pollo Encacahuatado">4 Pollo Encacahuatado</option>
                                                <option value="4 ½ Pollo Encacahuatado">4 1/2 Pollo Encacahuatado</option>
                                                <option value="5 Pollo Encacahuatado">5 Pollo Encacahuatado</option>
                                                <option value="5 ½ Pollo Encacahuatado">5 1/2 Pollo Encacahuatado</option>

                                                <!-- Opciones para Pollo Enchipotlado -->
                                                <option value="1/2 Pollo Enchipotlado">1/2 Pollo Enchipotlado</option>
                                                <option value="1 Pollo Enchipotlado">1 Pollo Enchipotlado</option>
                                                <option value="1 ½ Pollo Enchipotlado">1 ½ Pollo Enchipotlado</option>
                                                <option value="2 Pollo Enchipotlado">2 Pollo Enchipotlado</option>
                                                <option value="2 ½ Pollo Enchipotlado">2 1/2 Pollo Enchipotlado</option>
                                                <option value="3 Pollo Enchipotlado">3 Pollo Enchipotlado</option>
                                                <option value="3 ½ Pollo Enchipotlado">3 ½ Pollo Enchipotlado</option>
                                                <option value="4 Pollo Enchipotlado">4 Pollo Enchipotlado</option>
                                                <option value="4 ½ Pollo Enchipotlado">4 1/2 Pollo Enchipotlado</option>
                                                <option value="5 Pollo Enchipotlado">5 Pollo Enchipotlado</option>
                                                <option value="5 ½ Pollo Enchipotlado">5 1/2 Pollo Enchipotlado</option>

                                                <!-- Opciones para Pollo Habanero -->
                                                <option value="1/2 Pollo Habanero">1/2 Pollo Habanero</option>
                                                <option value="1 Pollo Habanero">1 Pollo Habanero</option>
                                                <option value="1 ½ Pollo Habanero">1 ½ Pollo Habanero</option>
                                                <option value="2 Pollo Habanero">2 Pollo Habanero</option>
                                                <option value="2 ½ Pollo Habanero">2 1/2 Pollo Habanero</option>
                                                <option value="3 Pollo Habanero">3 Pollo Habanero</option>
                                                <option value="3 ½ Pollo Habanero">3 ½ Pollo Habanero</option>
                                                <option value="4 Pollo Habanero">4 Pollo Habanero</option>
                                                <option value="4 ½ Pollo Habanero">4 1/2 Pollo Habanero</option>
                                                <option value="5 Pollo Habanero">5 Pollo Habanero</option>
                                                <option value="5 ½ Pollo Habanero">5 1/2 Pollo Habanero</option>
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
    $('#cantidad').on('change', function() {
        var cantidad = parseFloat($(this).val());
        console.log("Cantidad seleccionada:", cantidad); // Agrega esta línea
        var precio = 0;

        // Realizar cálculo del precio basado en la cantidad (ajusta las tarifas según tus necesidades)
        if (cantidad === 0.5) {
            precio = 55;
        } else if (cantidad === 1.0) {
            precio = 100;
        } else if (cantidad === 1.5) {
            precio = 155;
        } else if (cantidad === 2.0) {
            precio = 195;
        } else if (cantidad === 2.5) {
            precio = 250;
        } else if (cantidad === 3.0) {
            precio = 295;
        } else if (cantidad === 3.5) {
            precio = 350;
        } else if (cantidad === 4.0) {
            precio = 395;
        } else if (cantidad === 4.5) {
            precio = 445;
        } else if (cantidad === 5.0) {
            precio = 490;
        } else if (cantidad === 5.5) {
            precio = 545;
        }

        // Actualizar el campo de precio con el formato adecuado
        $('#precio').val(precio.toFixed(2));
    });
});


</script>

</body>
</html>
