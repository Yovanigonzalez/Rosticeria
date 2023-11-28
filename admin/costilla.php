<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Costilla</title>


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
                                    <h3 class="card-title">Agregar 'Costilla'</h3>
                                </div>
                                <div class="card-body">
                                <div class="card-body">
                                    <form method="post" action="guardar_c.php">
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
                                                <option value="0.25">0.25</option>
                                                <option value="0.50">0.50</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>




                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <select class="form-control" id="descripcion" name="descripcion">
                                                <option value="" disabled selected>Selecciona la descripción</option>
                                                <option value="¼ de Costilla de Puerco">¼ de Costilla de Puerco</option>
                                                <option value="½ de Costilla de Puerco">½ de Costilla de Puerco</option>
                                                <option value="1 kg de Costilla de Puerco">1 kg de Costilla de Puerco</option>
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
                                                <option value="" disabled selected>Selecciona categoría</option>
                                                <option value="Costilla">Costilla de Puerco</option>
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

  <!-- Enlace a jQuery y Bootstrap (asegúrate de que las rutas sean correctas) -->
  <script src="ruta/a/jquery.min.js"></script>
    <script src="ruta/a/bootstrap.min.js"></script>

    <script>
$(document).ready(function() {
    // Define un objeto que mapea la descripción al precio correspondiente
    var precioMapping = {
        "¼ de Costilla de Puerco": 60,
        "½ de Costilla de Puerco": 120,
        "1 kg de Costilla de Puerco": 230,
        // Agrega otras descripciones y precios aquí
    };

    $('#descripcion').on('change', function() {
        var descripcion = $(this).val();
        var precio = precioMapping[descripcion];

        if (precio !== undefined) {
            $('#precio').val("$" + precio.toFixed(2));
        } else {
            $('#precio').val('');
        }
    });
});
</script>


</body>
</html>
