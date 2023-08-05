<link rel="stylesheet" href="<?= base_url('css/compras/detallesCompra.css') ?>">
<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <h2>Detalles de Compra</h2>
        <div class="d-flex gap-5">
            <div id="contenedorListado">
                <input type="number" id="id" value="0" hidden>
                <!-- LISTADO DINAMICO -->
            </div>
            <div class="precioTotal">
                <h4 class="text-center p-3"><i class="bi bi-basket2-fill"></i> Total Productos</h4>
                <div id="info" class="d-flex justify-content-around flex-column h-100 p-4">
                    <!-- INFORMACION DINAMICA -->
                </div>
            </div>
        </div>
    </div>
    <!-- <input type="number" value="<?= session('id') ?>"> -->
</div>
<script>
    var url = '<?= base_url() ?>';
</script>
<script>
    function cargarTabla() {
        var cadena = ''
        var candenaTotal = ''
        var subtotal = 0
        var cantidad = 0
        var precioProduc = 0;
        if (carrito.length != 0) {
            carrito.forEach((element) => {
                var foto = `${url}imagenesProducto/${element.img}`;
                cadena += `
                <div class="contenedorProducto">
                    <div class="d-flex gap-3">
                    <img src="${foto}" alt="${element.nombre}" width="120"/>
                        <div>
                            <a class="text-capitalize " href="<?= base_url('verDetallesProducto/') ?>${element.id}">${element.nombre}</a>
                            <br>
                            <label>Precio: </label>
                            <p>${formatearCantidad(element.precio)} COP</p>
                            <p>Cantidad: ${element.cantidad}</p>
                        </div>
                    </div>
                    <div class="d-flex mt-1">
                    <button class="flex-grow-1 btn btn-outline-primary" style="border-radius:0;"><i class="bi bi-pencil-square"></i> Editar</button>
                    <button onclick="eliminarProducCar(${
                        element.id
                    })" class="flex-grow-1 btn btn-outline-danger" style="border-radius:0;"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                    </div>
                </div>`;
                precioProduc = Number(element.precio) * Number(element.cantidad);
                subtotal = precioProduc + subtotal;
                cantidad = Number(element.cantidad) + cantidad;
            });
        } else {
            cadena = '<p>No hay productos a comprar</p>'
        }
        $("#contenedorListado").html(cadena);

        candenaTotal = `
        <div>
                <label>Productos Totales: </label>
                <p>${cantidad}</p>
                <label>Total Compra: </label>
                <p>${formatearCantidad(subtotal)} COP</p>
                <input type="number" id="subtotal" value="${subtotal}" hidden>
                <label>Fecha Compra:</label>
                <p>${new Date().toLocaleString().split(',')[0]}</p>
                </div>
                <?php if (session('id') != 0) { ?>
                    <button id="btnEnviarCompra" class="btn btn-success" style="border-radius:0;">Confirmar Compra</button>
                    <?php } else {?>
                        <label class="text-center text-danger">¡Inicia Sesión para confirmar tu compra!</label>
                        <button class="btn btn-primary" data-bs-target="#modalIniciarSesion" data-bs-toggle="modal">
                            Ingresar
                        </button>
                 <?php } ?>
                `
        $("#info").html(candenaTotal);
    }
    cargarTabla();

    function eliminarProducCar(id) {
        carrito = carrito.filter((item) => item.id != id);
        recargaCarrito();
        cargarTabla();
    }
</script>
<script src="<?= base_url('js/compras/detallesCompra.js') ?>" type="text/javascript"></script>