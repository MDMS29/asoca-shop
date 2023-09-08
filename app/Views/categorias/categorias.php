<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <section class="d-flex justify-content-between">
            <h2 class="text-capitalize fw-semibold">Categoria de - <?= $categoria ?> - </h2>
            <button class="btn btn-primary" onclick=""><- Volver</button>
        </section>
        <div class="grid-responsive">
            <!-- PRODUCTOS DINAMICOS -->
        </div>
    </div>
</div>
<script>
    $.ajax({
        url: `${url}obtenerProductosCate`,
        type: 'POST',
        dataType: 'json',
        data: {
            id: 0,
            categoria: '<?= $categoria ?>',
            estado: 'A'
        },
        success: function(res) {
            var cadena = '';
            switch (res.length) {
                case 0:
                    cadena += `<div class="container text-center">NO HAY PRODUCTOS EN ESTA CATEGORÍA</div>`
                    break;

                default:
                    console.log(res)
                    res.forEach(element => {
                        var foto = `${url}imagenesProducto/${element.nombre_img}`;
                        cadena += `
                        <div onclick="window.location.href='<?= base_url('detalles-producto/') ?>${element.id_producto}'" class="card mb-3" style="cursor:pointer;border-radius:15px;">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center w-100 py-3" >
                                    <img src="${foto}"alt="${element.nombre_img}" width="130" height="150">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title text-capitalize fw-bold" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1; overflow: hidden;"> ${element.nombre}</h5>
                                    <p class="card-text fw-semibold text-danger">${formatearCantidad(element.precio)} COP <span class="text-secondary">c/u</span></p>
                                    <small class="text-secondary text-capitalize">- ${element.categoria} -</small>
                                </div>
                            </div>
                        </div>`
                    });
                    break;
            }

            $('.grid-responsive').html(cadena)
        }
    })
</script>