<?php include 'menu.php' ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "p"; // Nombre de la base de datos

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los productos de la tabla 'productos'
$sqlProductos = "SELECT id, cantidad, descripcion, precio, categoria FROM productos";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Logo -->
    <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <style>
        /* Agrega un espacio de 1.5 unidades (por ejemplo, 1.5rem) entre los elementos de la lista */
        .producto-item {
            margin-bottom: 1.0rem;
        }
    </style>

    <title>Punto de Venta</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Columna del Punto de Venta -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Punto de Venta</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Código del punto de venta -->
                                    <section>
                                        <h2>Productos</h2>
                                        <!-- Campo de búsqueda para productos de la tabla 'productos' -->
                                        <input type="text" id="searchProductos" class="form-control" onkeyup="searchProductos()" placeholder="Buscar productos...">
                                        <!-- Lista de productos de la tabla 'productos' (inicialmente oculta) -->
                                        <br>
                                        <ul id="productosList" style="display: none;">
                                            <?php
                                            if ($resultProductos->num_rows > 0) {
                                                while ($rowProductos = $resultProductos->fetch_assoc()) {
                                                    echo '<li class="producto-item">' . $rowProductos['descripcion'] . ' <button class="btn btn-sm btn-primary" onclick="agregarAlCarrito(' . $rowProductos['id'] . ', \'' . $rowProductos['descripcion'] . '\', ' . $rowProductos['precio'] . ', \'' . $rowProductos['cantidad'] . '\', \'' . $rowProductos['categoria'] . '\')">Agregar</button></li>';
                                                }
                                            } else {
                                                echo "No se encontraron productos en la tabla 'productos'.";
                                            }
                                            ?>
                                        </ul>
                                    </section>


                                    <br>
                                    <section>
                                        <h2>Carrito de Compra</h2>
                                        <!-- Mostrar productos agregados al carrito -->
                                        <ul id="carrito">
                                            <!-- Los elementos del carrito se agregarán aquí dinámicamente -->
                                        </ul>
                                        <p>Total: $<span id="total">0</span></p>

                                        <!-- Campo para seleccionar el método de pago -->
                                        <!-- Campo para seleccionar el método de pago -->
                                        <div class="form-group">
                                            <label for="metodoPago">Método de Pago:</label>
                                            <select class="form-control" id="metodoPago" onchange="calcularCambio()">
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Tarjeta">Tarjeta de Débito/Crédito</option>
                                            </select>
                                        </div>

                                        <!-- Campo para ingresar el dinero recibido (solo se muestra si se elige 'Efectivo') -->
                                        <div class="form-group" id="dineroRecibidoField">
                                            <label for="dineroRecibido">Dinero Recibido:</label>
                                            <input type="number" class="form-control" id="dineroRecibido" placeholder="Ingrese el monto recibido" oninput="calcularCambio()">
                                        </div>


                                        <!-- Campo para mostrar el cambio -->
                                        <p>Cambio: $<span id="cambio">0</span></p>


                                        <!-- Botón para realizar el pago e imprimir el ticket -->
                                        <button class="btn btn-primary" onclick="realizarPago(); ventas();">Pagar e Imprimir Ticket y Registrar Venta</button>
                                        <br>
                                        <br>
                                        <!-- Botón para realizar el pago e imprimir el ticket -->
                                        <button class="btn btn-primary" onclick="registrarVenta()">Solo registrar venta</button>

                                    </section>
                                    <!-- Fin del código del punto de venta -->
                                </div>
                            </div>
                        </div>
                        <!-- Columna del Ticket de Compra -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ticket de Compra</h3>
                                </div>

                                <div class="card-body">
                                    <!-- Contenido del ticket de compra -->
                                    <pre id="ticketContent"></pre>

                                    <!-- Button to perform the payment and print the ticket -->
                                    <button class="btn btn-primary" onclick="imprimirTicket()">Imprimir Ticket</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Agrega el enlace a jQuery y a Bootstrap.js si no lo has hecho ya -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Agrega este script al final de tu página HTML, antes de cerrar el body -->
<script>
    // Función para obtener la descripción de la venta a partir de los elementos del carrito
    function obtenerDescripcionVenta() {
        var carritoItems = document.getElementById('carrito').getElementsByTagName('li');
        var descripcionVenta = "";

        // Recorrer los elementos del carrito y agregar sus descripciones a la descripción de la venta
        for (var i = 0; i < carritoItems.length; i++) {
            var itemText = carritoItems[i].textContent;
            var descripcionProducto = itemText.split(' - Precio: ')[0];
            descripcionVenta += descripcionProducto + ', ';
        }

        // Eliminar la coma y el espacio extra al final
        if (descripcionVenta.length > 2) {
            descripcionVenta = descripcionVenta.slice(0, -2);
        }

        return descripcionVenta;
    }

    // Función para obtener el total de la venta a partir de los elementos del carrito
    function obtenerTotalVenta() {
        var total = parseFloat(document.getElementById('total').textContent);
        return total;
    }

    // Función para registrar la venta mediante una solicitud AJAX
    function ventas() {
    // Obtener información relevante
    var descripcion = obtenerDescripcionVenta();
    var total = obtenerTotalVenta();
    var fechaHora = obtenerFechaHoraActual();

    // Realizar una solicitud AJAX para guardar los datos de ventas en la base de datos
    $.ajax({
        url: 'v.php', // Asegúrate de que esta sea la ruta correcta a tu script PHP
        method: 'POST',
        data: {
            descripcion: descripcion,
            total: total,
            fechaHora: fechaHora
        },
        success: function(response) {
            // Los datos de ventas se han registrado con éxito
            alert('Datos de ventas registrados con éxito: ' + response); // Puedes mostrar un mensaje de éxito o redirigir a otra página
        },
        error: function(xhr, status, error) {
            // Hubo un error al registrar los datos de ventas
            alert('Error al registrar los datos de ventas: ' + error); // Mostrar el mensaje de error
        }
    });
}

</script>


    <script>
    function registrarVenta() {
        // Obtener información relevante
        var descripcion = obtenerDescripcionVenta(); // Debes implementar esta función
        var total = parseFloat(document.getElementById('total').textContent);
        var fechaHora = obtenerFechaHoraActual(); // Debes implementar esta función

        // Realizar una solicitud AJAX para registrar la venta
        $.ajax({
            url: 'guardar_venta.php',
            method: 'POST',
            data: {
                descripcion: descripcion,
                total: total,
                fechaHora: fechaHora
            },
            success: function(response) {
                // La venta se ha registrado con éxito
                alert(response); // Puedes mostrar un mensaje de éxito o redirigir a otra página
            },
            error: function(error) {
                // Hubo un error al registrar la venta
                alert('Error al registrar la venta: ' + error);
            }
        });
    }

    function obtenerDescripcionVenta() {
        var carritoItems = document.getElementById('carrito').getElementsByTagName('li');
        var descripcionVenta = "";

        // Recorrer los elementos del carrito y agregar sus descripciones a la descripción de la venta
        for (var i = 0; i < carritoItems.length; i++) {
            var itemText = carritoItems[i].textContent;
            var descripcionProducto = itemText.split(' - Precio: ')[0];
            descripcionVenta += descripcionProducto + ', ';
        }

        // Eliminar la coma y el espacio extra al final
        if (descripcionVenta.length > 2) {
            descripcionVenta = descripcionVenta.slice(0, -2);
        }

        return descripcionVenta;
    }


    // Función para obtener la fecha y hora actual (debes implementarla)
    function obtenerFechaHoraActual() {
        var fechaHora = new Date();
        return fechaHora.toISOString(); // Devuelve la fecha y hora en formato ISO
    }
    </script>


    <script>

      function searchProductos() {
            var input = document.getElementById("searchProductos");
            var ul = document.getElementById("productosList");
            var lis = ul.getElementsByTagName("li");

            // Oculta la lista si el campo de búsqueda está vacío
            if (input.value.trim() === "") {
                ul.style.display = "none";
                return;
            }

            // Obtiene el texto ingresado en el campo de búsqueda
            var searchTerm = input.value.trim().toLowerCase();

            // Recorre los elementos de la lista y muestra/oculta según la búsqueda
            for (var i = 0; i < lis.length; i++) {
                var li = lis[i];
                var productoText = li.textContent || li.innerText;

                // Compara el texto del producto con el término de búsqueda
                if (productoText.toLowerCase().indexOf(searchTerm) > -1) {
                    li.style.display = "block"; // Muestra el elemento si coincide
                } else {
                    li.style.display = "none"; // Oculta el elemento si no coincide
                }
            }

            // Muestra la lista (aunque estén ocultos algunos elementos)
            ul.style.display = "block";
        }


        function agregarAlCarrito(id, descripcion, precio, cantidad, categoria) {
        // Realiza la actualización del stock en la base de datos
        actualizarStockEnBaseDeDatos(categoria, cantidad)
            .then(() => {
                // El stock se ha actualizado correctamente en la base de datos.

                // Crea un nuevo elemento de lista para el carrito
                var carrito = document.getElementById('carrito');
                var nuevoItem = document.createElement('li');
                nuevoItem.textContent = descripcion + ' - Precio: $' + precio;

                // Calcula el total y actualiza la cantidad
                var totalElement = document.getElementById('total');
                var total = parseFloat(totalElement.textContent) + precio;
                totalElement.textContent = total.toFixed(2);

                // Agrega el elemento al carrito
                carrito.appendChild(nuevoItem);

                // Limpia el campo de búsqueda
                document.getElementById('searchProductos').value = '';

                // Oculta la lista de resultados
                var ul = document.getElementById('productosList');
                ul.style.display = 'none';
            })
            .catch((error) => {
                // Hubo un error al actualizar el stock en la base de datos.
                // Puedes manejar el error aquí.
                console.error('Error al actualizar el stock en la base de datos: ' + error.message);
            });
    }

        function actualizarStockEnBaseDeDatos(categoria, cantidad) {
            return new Promise((resolve, reject) => {
                // Realiza una llamada AJAX o una solicitud HTTP a tu servidor
                // para actualizar el stock en la base de datos.

                // Por ejemplo, puedes usar jQuery para realizar una solicitud POST.
                $.ajax({
                    url: 'actualizar_stock.php', // URL de tu script PHP para actualizar el stock
                    method: 'POST',
                    data: {
                        categoria: categoria,
                        cantidad: cantidad
                    },
                    success: function (response) {
                        // El stock se ha actualizado correctamente en la base de datos.
                        resolve(response);
                    },
                    error: function (error) {
                        // Hubo un error al actualizar el stock en la base de datos.
                        reject(error);
                    }
                });
            });
        }




        function calcularCambio() {
            // Obtener el valor del total y el método de pago seleccionado
            var total = parseFloat(document.getElementById('total').textContent);
            var metodoPago = document.getElementById('metodoPago').value;

            // Obtener el campo de "Dinero Recibido"
            var dineroRecibidoField = document.getElementById('dineroRecibidoField');
            var dineroRecibidoInput = document.getElementById('dineroRecibido');

            // Habilitar o deshabilitar el campo según el método de pago
            if (metodoPago === 'Tarjeta') {
                dineroRecibidoField.style.display = 'none'; // Ocultar el campo
                dineroRecibidoInput.value = ''; // Limpiar el valor
            } else {
                dineroRecibidoField.style.display = 'block'; // Mostrar el campo
            }

            // Calcular el cambio
            if (metodoPago !== 'Tarjeta') {
                var dineroRecibido = parseFloat(dineroRecibidoInput.value) || 0;
                var cambio = dineroRecibido - total;
                document.getElementById('cambio').textContent = cambio.toFixed(2);
            }
        }

        function realizarPago() {
            // Obtener información relevante
            var carritoItems = document.getElementById('carrito').getElementsByTagName('li');
            var metodoPago = document.getElementById('metodoPago').value;
            var dineroRecibido = parseFloat(document.getElementById('dineroRecibido').value) || 0;
            var total = parseFloat(document.getElementById('total').textContent);

            // Obtener la fecha y hora actual
            var fechaHoraActual = new Date();
            var fecha = fechaHoraActual.toLocaleDateString();
            var hora = fechaHoraActual.toLocaleTimeString();

            // Construir el contenido del ticket
            var ticketContent = '<div class="text-center">';
            ticketContent += '<img id="imagenTicket" src="../tic/log.svg" alt="Imagen del ticket" style="display: block; margin: 0 auto; width: 100px; height: auto; margin-top: 10px;">';

            // Agregar la dirección y el número de teléfono con estilo para limitar el ancho
            ticketContent += '<p><strong>Número de Teléfono:</strong> 238 195 4481</p>';

            // Agregar la tabla de elementos del carrito al ticket
            ticketContent += '<table class="table table-bordered">';
            ticketContent += '<thead><tr><th>Descripción</th><th>Precio</th></tr></thead>';
            ticketContent += '<tbody>';

            // Agregar los elementos del carrito al ticket con descripción y precio en filas separadas
            for (var i = 0; i < carritoItems.length; i++) {
                var itemText = carritoItems[i].textContent;
                var descripcion = itemText.split(' - Precio: ')[0];
                var precio = itemText.split(' - Precio: ')[1];
                ticketContent += '<tr><td>' + descripcion + '</td><td>' + precio + '</td></tr>';
            }

            ticketContent += '</tbody>';
            ticketContent += '</table>';
            
            // Agregar información adicional al ticket dentro de la tabla
            ticketContent += '<table class="table table-bordered">';
            ticketContent += '<tbody>';
            ticketContent += '<tr><td><strong>Método de Pago:</strong></td><td>' + metodoPago + '</td></tr>';

            // Condición para ocultar "Dinero Recibido" y "Cambio" si se selecciona "Tarjeta"
            if (metodoPago !== 'Tarjeta') {
                ticketContent += '<tr><td><strong>Dinero Recibido:</strong></td><td>$' + dineroRecibido.toFixed(2) + '</td></tr>';
                ticketContent += '<tr><td><strong>Cambio:</strong></td><td>$' + (dineroRecibido - total).toFixed(2) + '</td></tr>';
            }
            
            ticketContent += '<tr><td><strong>Total:</strong></td><td>$' + total.toFixed(2) + '</td></tr>';
            ticketContent += '</tbody>';
            ticketContent += '</table>';

            // Mensaje de agradecimiento
            ticketContent += '<p align="center">¡Gracias por tu preferencia!</p>';

            // Cerrar el div principal
            ticketContent += '</div>';

            // Mostrar el contenido en el ticket
            document.getElementById('ticketContent').innerHTML = ticketContent;
        }

        

        function imprimirTicket() {
            // Obtener el contenido del ticket
            var ticketContent = document.getElementById('ticketContent').innerHTML;

            // Crear una ventana emergente para imprimir el contenido del ticket
            var popupWin = window.open('', '_blank', 'width=600,height=600');
            popupWin.document.open();
            popupWin.document.write('<html><head><title>Ticket de Compra</title></head><body>' + ticketContent + '</body></html>');
            popupWin.document.close();

            // Imprimir el contenido del ticket
            popupWin.print();
            popupWin.close();
        }


        // Cerrar la conexión a la base de datos
        <?php $conn->close(); ?>
    </script>
</body>
</html>
