let carrito = [];
let total = 0;


function agregarAlCarrito(producto, precio, capacidad, uso) {
if (precio !== undefined) {
    carrito.push({ producto, precio, capacidad, uso });
    total += precio;
} else {
    carrito.push({ producto });
}

// Limpia el campo de búsqueda de productos extra
document.getElementById("searchExtra").value = '';

// Limpia y oculta la lista de resultados de productos extra
var extraList = document.getElementById("extraList");
extraList.style.display = 'none';

// Limpia el campo de búsqueda de productos de tendencias
document.getElementById("searchTendencias").value = '';

// Limpia y oculta la lista de resultados de productos de tendencias
var tendenciasList = document.getElementById("tendenciasList");
tendenciasList.style.display = 'none';

// Actualiza el carrito y el total
actualizarCarritoYTotal();
}



// Función para realizar solo el registro del total en la base de datos
function registrarVenta() {
// Obtiene el valor total de la venta y el método de pago seleccionado
const totalVenta = total;
const metodoPago = document.getElementById('metodoPago').value; // Obtiene el método de pago desde el campo de selección

// Obtiene las cantidades de productos específicos
const cantidadFeromonas = parseInt(document.getElementById('feromonasInput').value) || 0;
const cantidadGramosExtra = parseInt(document.getElementById('gramosExtraInput').value) || 0;
const cantidadFijador = parseInt(document.getElementById('fijadorInput').value) || 0;

// Realiza una llamada AJAX para enviar el total y el método de pago al servidor y guardarlos en la base de datos.
$.ajax({
    type: 'POST',
    url: 'guardar_total_venta.php', // Reemplaza con la URL de tu script PHP para guardar en la base de datos
    data: {
        total: totalVenta,
        metodo_pago: metodoPago,
        cantidad_feromonas: cantidadFeromonas,
        cantidad_gramos_extra: cantidadGramosExtra,
        cantidad_fijador: cantidadFijador
    },
    success: function (response) {
        if (response === 'success') {
            // Limpia el carrito y el contenido del ticket después de registrar la venta
            carrito = [];
            total = 0;
            actualizarCarritoYTotal();

            alert('Venta registrada exitosamente.');
        } else {
            alert('Error al guardar en la base de datos. Por favor, inténtelo de nuevo.');
        }
    },
    error: function () {
        alert('Error de conexión con el servidor. Por favor, inténtelo de nuevo más tarde.');
    }
});
}





// Función para actualizar el carrito y el total
function actualizarCarritoYTotal() {
const carritoList = document.getElementById('carrito');
const totalElement = document.getElementById('total');
carritoList.innerHTML = '';

carrito.forEach(item => {
    const li = document.createElement('li');
    if (item.precio !== undefined) {
        if (item.producto === 'Feromonas' || item.producto === 'Gramos Extra' || item.producto === 'Fijador') {
            li.textContent = `${item.producto} - Precio: $${item.precio} - Cantidad: ${item.cantidad}`;
        } else {
            li.textContent = `${item.producto} - Capacidad: ${item.capacidad} ml - Uso: ${item.uso} - Precio: $${item.precio}`;
        }
    } else {
        li.textContent = `${item.producto}`;
    }
    carritoList.appendChild(li);
});

totalElement.textContent = total;
}


function calcularCambio() {
    const metodoPago = document.getElementById('metodoPago').value;
    const cambioElement = document.getElementById('cambio');

    if (metodoPago === 'Efectivo') {
        const dineroRecibido = parseFloat(document.getElementById('dineroRecibido').value);
        if (isNaN(dineroRecibido)) {
            alert('Por favor, ingrese un monto válido.');
            return;
        }

        const cambio = dineroRecibido - total;
        cambioElement.textContent = cambio.toFixed(2);
    } else {
        // Si se selecciona "Tarjeta de Débito/Crédito", el campo de dinero recibido se oculta y el cambio se establece en 0.
        document.getElementById('dineroRecibidoField').style.display = 'none';
        cambioElement.textContent = '0.00';
    }
}



// Función para realizar el pago
function realizarPago() {
const ticketContent = document.getElementById('ticketContent');
ticketContent.textContent = 'Perfumeria Perfum \n';
let subtotal = 0;

carrito.forEach(item => {
    if (item.precio !== undefined) {
        if (item.producto === 'Feromonas' || item.producto === 'Gramos Extra' || item.producto === 'Fijador') {
            ticketContent.textContent += `${item.producto}\n`;
            ticketContent.textContent += `Cantidad: ${item.cantidad || 1}\n`; // Mostrar la cantidad ingresada o 1 si no se especifica.
            ticketContent.textContent += `Precio: $${item.precio}\n`;
        } else {
            ticketContent.textContent += `Envase: ${item.producto}\n`;
            ticketContent.textContent += `Capacidad: ${item.capacidad} ml\n`;
            ticketContent.textContent += `Tipo: ${item.uso}\n`;
            ticketContent.textContent += `Precio: $${item.precio}\n`;
        }
        subtotal += item.precio * (item.cantidad || 1); // Multiplicar por la cantidad (si es especificada), o 1 si no lo es.
    } else {
        ticketContent.textContent += `Tendencia: ${item.producto}\n\n`;
    }
});




// Agregar información de método de pago, dinero recibido y cambio
const metodoPago = document.getElementById('metodoPago').value;
const dineroRecibido = parseFloat(document.getElementById('dineroRecibido').value);
const cambio = parseFloat(document.getElementById('cambio').textContent);

ticketContent.textContent += `\nMétodo de Pago: ${metodoPago}\n`;

if (metodoPago === 'Efectivo') {
    ticketContent.textContent += `Dinero Recibido: $${dineroRecibido.toFixed(2)}\n`;
    ticketContent.textContent += `Cambio: $${cambio.toFixed(2)}\n\n`;
} else if (metodoPago === 'Tarjeta') {
    ticketContent.textContent += `Dinero Recibido: Pago por tarjeta\n`;
    ticketContent.textContent += `Cambio: Pago por tarjeta\n\n`;
}

total = subtotal;
ticketContent.textContent += `Total: $${total.toFixed(2)}\n\n¡Gracias por su compra!`;

const ticketSection = document.getElementById('ticket');
ticketSection.style.display = 'block';
window.print();
}

// Función para buscar productos extra
function searchExtra() {
    const input = document.getElementById('searchExtra').value.toLowerCase();
    const extraList = document.getElementById('extraList');

    // Mostrar u ocultar la lista de productos extra según la búsqueda
    if (input === '') {
        extraList.style.display = 'none';
    } else {
        extraList.style.display = 'block';
    }

    // Filtrar y mostrar los elementos coincidentes
    const items = extraList.getElementsByTagName('li');
    for (let i = 0; i < items.length; i++) {
        const itemName = items[i].textContent.toLowerCase();
        if (itemName.includes(input)) {
            items[i].style.display = 'block';
        } else {
            items[i].style.display = 'none';
        }
    }
}


// Función para buscar productos de tendencias
function searchTendencias() {
const input = document.getElementById('searchTendencias').value.toLowerCase();
const tendenciasList = document.getElementById('tendenciasList');

// Mostrar u ocultar la lista de productos de tendencias según la búsqueda
if (input === '') {
    tendenciasList.style.display = 'none';
} else {
    tendenciasList.style.display = 'block';
}

// Filtrar y mostrar los elementos coincidentes
const items = tendenciasList.getElementsByTagName('li');
for (let i = 0; i < items.length; i++) {
    const itemName = items[i].textContent.toLowerCase();
    if (itemName.includes(input)) {
        items[i].style.display = 'block';
    } else {
        items[i].style.display = 'none';
    }
}
}


// Función para agregar feromonas al carrito
function agregarFeromonas(precioFeromonas) {
const cantidadFeromonas = parseInt(document.getElementById('feromonasInput').value);
if (isNaN(cantidadFeromonas) || cantidadFeromonas <= 0) {
    alert('Por favor, ingrese una cantidad válida de feromonas.');
    return;
}

// Agregar las feromonas al carrito solo con el nombre "Feromonas" y el precio de la base de datos
const subtotalFeromonas = precioFeromonas * cantidadFeromonas;
carrito.push({ producto: 'Feromonas', precio: precioFeromonas, cantidad: cantidadFeromonas });
total += subtotalFeromonas;
actualizarCarritoYTotal();

// Limpiar el campo de entrada de cantidad de feromonas
document.getElementById('feromonasInput').value = '';
}



// Función para agregar gramos extras al carrito
function agregarGramosExtra(precioGramosExtras) {
const cantidadGramosExtra = parseInt(document.getElementById('gramosExtraInput').value);
if (isNaN(cantidadGramosExtra) || cantidadGramosExtra <= 0) {
    alert('Por favor, ingrese una cantidad válida de gramos extras.');
    return;
}

// Agregar los gramos extras al carrito solo con el nombre "Gramos Extra" y el precio de la base de datos
const subtotalGramosExtra = precioGramosExtras * cantidadGramosExtra;
carrito.push({ producto: 'Gramos Extra', precio: precioGramosExtras, cantidad: cantidadGramosExtra });
total += subtotalGramosExtra;
actualizarCarritoYTotal();

// Limpia el campo de entrada de gramos extra
document.getElementById('gramosExtraInput').value = '';

// Limpia la lista de resultados de búsqueda de gramos extra
var gramosExtraList = document.getElementById('gramosExtraList');
gramosExtraList.innerHTML = '';
}



// Función para agregar el fijador al carrito
function agregarFijador(precioFijador) {
const cantidadFijador = parseInt(document.getElementById('fijadorInput').value);
if (isNaN(cantidadFijador) || cantidadFijador <= 0) {
    alert('Por favor, ingrese una cantidad válida de fijador.');
    return;
}

// Agregar el fijador al carrito solo con el nombre "Fijador" y el precio de la base de datos
const subtotalFijador = precioFijador * cantidadFijador;
carrito.push({ producto: 'Fijador', precio: precioFijador, cantidad: cantidadFijador });
total += subtotalFijador;
actualizarCarritoYTotal();

// Limpia el campo de entrada de fijador
document.getElementById('fijadorInput').value = '';

// Limpia la lista de resultados de búsqueda de fijador (si existe)
var fijadorList = document.getElementById('fijadorList');
if (fijadorList) {
    fijadorList.innerHTML = '';
}
}



function imprimirTicket() {
const ticketContent = document.getElementById('ticketContent').textContent;

// Abrir una ventana emergente e imprimir el contenido directamente
const printWindow = window.open('', '', 'width=570,height=600'); // Ancho de 5.7 cm, altura de 6 cm (ajusta según sea necesario)
printWindow.document.open();
printWindow.document.write('<html><head><title>Ticket de Compra</title></head><body>');

// Estilos CSS para el contenido, ajusta según sea necesario
printWindow.document.write('<style>');
printWindow.document.write(`
    body { margin: 0; padding: 0; }
    pre { font-size: 12px; } // Ajusta el tamaño de fuente
`);
printWindow.document.write('</style>');

printWindow.document.write('<pre>' + ticketContent + '</pre>');
printWindow.document.write('</body></html>');
printWindow.document.close();

// Imprimir la ventana emergente y cerrarla después de la impresión
printWindow.print();
printWindow.close();
}
