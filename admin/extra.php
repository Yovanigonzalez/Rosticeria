<?php include 'menu.php';?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Extra</title>

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
                                    <h3 class="card-title">Agregar 'Extra'</h3>
                                </div>
                                <div class="card-body">
                                <div class="card-body">
                                    <form method="post" action="procesar.php">
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
                                                <option value="1">1</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="0.5">0.5</option>
                                                <option value="1.0">1.0</option>
                                                <option value="1.5">1.5</option>
                                                <option value="2.0">2.0</option>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <select class="form-control" id="descripcion" name="descripcion">
                                                <option value="" disabled selected>Selecciona la descripción</option>
                                                <option value="Molleja">Molleja</option>
                                                <option value="Ensalada Rusa">Ensalada Rusa</option>
                                                <option value="Sopa de codo">Sopa de codo</option>
                                                <option value="Patas de pollo">Patas de pollo</option>
                                                <option value="½ Orden de Alitas Habanero">½ Orden de Alitas Habanero</option>
                                                <option value="1 Orden de Alitas Habanero">1 Orden de Alitas Habanero</option>
                                                <option value="1 ½ Orden de Alitas Habanero">1 ½ Orden de Alitas Habanero</option>
                                                <option value="2 Orden de Alitas Habanero">2 Orden de Alitas Habanero</option>
                                                <option value="½ Orden de Alitas BBQ">½ Orden de Alitas BBQ</option>
                                                <option value="1 Orden de Alitas BBQ">1 Orden de Alitas BBQ</option>
                                                <option value="1 ½ Orden de Alitas BBQ">1 ½ Orden de Alitas BBQ</option>
                                                <option value="2 Orden de Alitas BBQ">2 Orden de Alitas BBQ</option>
                                                <option value="½ Orden de Boneles Búfalo">½ Orden de Boneles Búfalo</option>
                                                <option value="1 Orden de Boneles Búfalo">1 Orden de Boneles Búfalo</option>
                                                <option value="1 ½ Orden de Boneles Búfalo">1 ½ Orden de Boneles Búfalo</option>
                                                <option value="2 Orden de Boneles Búfalo">2 Orden de Boneles Búfalo</option>
                                                <option value="½ Orden Boneles Limón">½ Orden Boneles Limón</option>
                                                <option value="1 Orden Boneles Limón">1 Orden Boneles Limón</option>
                                                <option value="1 ½ Orden Boneles Limón">1 ½ Orden Boneles Limón</option>
                                                <option value="2 Orden Boneles Limón">2 Orden Boneles Limón</option>
                                                <option value="Palomitas de pollo">Palomitas de pollo</option>
                                                <option value="Frijoles">Frijoles</option>
                                                <option value="Arroz">Arroz</option>
                                                <option value="Salsa">Salsa</option>
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
                                                <option value="Molleja">Molleja</option>
                                                <option value="Ensalada Rusa">Ensalada Rusa</option>
                                                <option value="Sopa de codo">Sopa de codo</option>
                                                <option value="Patas de pollo">Patas de pollo</option>
                                                <option value="Alitas Habanero">Alitas Habanero</option>
                                                <option value="Alitas BBQ">Alitas BBQ</option>
                                                <option value="Boneles Bufalo">Boneles Bufalo</option>
                                                <option value="Boneles Limon">Boneles Limon</option>
                                                <option value="Palomitas de pollo">Palomitas de pollo</option>
                                                <option value="Frijoles">Frijoles</option>
                                                <option value="Arroz">Arroz</option>
                                                <option value="Salsa">Salsa</option>
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
    // Define un objeto que mapea la descripción al precio correspondiente
    var precioMapping = {
        "Molleja": 35,
        "Ensalada Rusa": 25,
        "Sopa de codo": 25,
        "Patas de pollo": 25,
        "½ Orden de Alitas Habanero": 60,
        "1 Orden de Alitas Habanero": 110,
        "1 ½ Orden de Alitas Habanero": 170,
        "2 Orden de Alitas Habanero": 220,
        "½ Orden de Alitas BBQ": 60,
        "1 Orden de Alitas BBQ": 110,
        "1 ½ Orden de Alitas BBQ": 170,
        "2 Orden de Alitas BBQ": 220,
        "½ Orden de Boneles Búfalo": 35,
        "1 Orden de Boneles Búfalo": 70,
        "1 ½ Orden de Boneles Búfalo": 105,
        "2 Orden de Boneles Búfalo": 140,
        "½ Orden Boneles Limón": 35,
        "1 Orden Boneles Limón": 70,
        "1 ½ Orden Boneles Limón": 105,
        "2 Orden Boneles Limón": 140,
        "Palomitas de pollo": 70,
        "Frijoles": 15,
        "Arroz": 5,
        "Salsa": 5
    };

    $('#descripcion').on('change', function() {
        var descripcion = $(this).val();
        var precio = precioMapping[descripcion];

        if (precio !== undefined) {
            $('#precio').val("" + precio.toFixed(2));
        } else {
            $('#precio').val('');
        }
    });
});
</script>



</body>
</html>
