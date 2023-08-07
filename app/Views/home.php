<link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
<main class="contenedor">
    <div class="contenedor-productos mt-5">
        <!-- PRODUCTOS DINAMICOS -->
    </div>
</main>

<script>
    $.ajax({
        url: `${url}obtenerProductos`,
        type: 'POST',
        dataType: 'json',
        data: {
            estado: 'A'
        },
        success: function (res) {
            var cadena = '';
            switch (res.length) {
                case 0:
                    cadena += `<div class="container text-center">NO HAY PRODUCTOS EN ESTE MOMENTO</div>`
                    break;

                default:
                    res.forEach(element => {
                        var foto = `${url}imagenesProducto/${element.nombre_img}`;
                        cadena += `
                        <article onclick="window.location.href='<?= base_url('verDetallesProducto/') ?>${element.id_producto}'" class="card mb-3 producto">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center w-100 py-3" >
                                    <img src="${foto}"alt="${element.nombre_img}" width="130" height="150">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title text-capitalize" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1; overflow: hidden;"> ${element.nombre}</h5>
                                    <p class="card-text fw-semibold text-danger">${formatearCantidad(element.precio)} COP <span class="text-secondary">c/u</span></p>
                                    
                                </div>
                            </div>
                        </article>`
                    });
                    break;
            }

            $('.contenedor-productos').html(cadena)
        }
    })
</script>