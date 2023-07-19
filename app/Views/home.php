<div class="contenedor">
    <div class="contenedor-productos mt-5">
        <!-- PRODUCTOS DINAMICOS -->
    </div>
</div>

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
                        <div class="card mb-3" style="max-width: 540px; overflow: hidden;">
                            <div class="row g-0">
                                <div class="col-md-4" style="max-width: 180px; overflow: hidden;">
                                    <img src="${foto}"alt="${element.nombre_img}" width="180" height="180">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"> ${element.nombre}</h5>
                                        <p class="card-text" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3; overflow: hidden;" >${element.descripcion}</p>
                                        <p class="card-text"><small class="text-body-secondary"> ${element.fecha_public}</small></p>
                                        <div class="w-100 d-flex gap-2">
                                            <a href="<?= base_url('verDetallesProducto/') ?>${element.id_producto} " class="flex-grow-1 btn btn-danger">Detalles</a>
                                            <button class="flex-grow-1 btn btn-primary">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    });
                    break;
            }

            $('.contenedor-productos').html(cadena)
        }
    })
</script>