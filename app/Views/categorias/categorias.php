<div class="contenedor">
    <div id="content" class="p-4 p-md-5">
        <section class="d-flex justify-content-between">
            <h2 class="text-capitalize fw-semibold">Productos - <?= $categoria ?> - </h2>
            <button class="btn btn-primary" onclick="history.back()"><i class="bi bi-arrow-left"></i> Volver</button>
        </section>
        <div id="contenedor-productos-categoria">
            <!-- PRODUCTOS DINAMICOS -->

        </div>
        <div class="contenedor-paginacion">
            <button class="paginacion-categorias btn btn-outline-dark" id="1">1</button>
        </div>
    </div>
    <footer style="background-color: #C1AE9F;position:relative;bottom:-200; width:100%;">
        <span></span>
        <span></span>
        <span></span>
        <div class="d-flex justify-content-between p-5 flex-wrap">
            <div class="flex-grow-1 d-flex justify-content-center">
                <div style="width:200px">
                    <h1 class="fw-semibold text-center m-0">ASOCA</h1>
                    <p class="text-center" style="border-top: 1px solid #69385C;">Todo por tu bienestar</p>
                </div>
            </div>
            <div class="flex-grow-1 flex-wrap d-flex gap-5 justify-content-center">
                <div class="d-flex flex-column fw-semibold align-items-center">
                    <p class="m-0 fs-4" style="color: #69385C;">Conoce más</p>
                    <a class="text-dark" href="#inicio">Inicio</a>
                    <a class="text-dark" href="#categorias">Categorías</a>
                    <a class="text-dark" href="#prodc-gust">Productos de tu gusto</a>
                </div>
                <div class="d-flex flex-column fw-semibold align-items-center">
                    <p class="m-0 fs-4" style="color: #69385C;">Info Contacto</p>
                    <p class="m-0">Teléfono - 3014734903</p>
                    <p class="m-0">Correo - servicioasoca@gmail.com</p>
                    <p class="m-0">Dirección - Soledad/Atlántico</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center gap-5 p-3 border-top border-black">
            <div>
                &copy; ASOCA - Todos los derechos reservados
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript">
    var cadenas = []
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

            if (res[0]?.categoria == '<?= $categoria ?>') {
                let i = 4
                do {
                    cadena += '<div class="grid-responsive mt-4" >'
                    for (i; i < res.length; i++) {
                        var foto = `${url}imagenesProducto/${res[i].nombre_img}`;
                        cadena += `
                            <div onclick="window.location.href='<?= base_url('detalles-producto/') ?>${res[i].id_producto}'" class="card mb-3" style="cursor:pointer;border-radius:15px;">
                                <div class="row g-0">
                                    <div class="col-md-4 d-flex justify-content-center w-100 py-3" >
                                    <img src="${foto}"alt="${res[i].nombre_img}" width="130" height="150">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-capitalize fw-bold" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1; overflow: hidden;"> ${res[i].nombre}</h5>
                                        <p class="card-text fw-semibold text-danger">${formatearCantidad(res[i].precio)} COP <span class="text-secondary">c/u</span></p>
                                        <small class="text-secondary text-capitalize">- ${res[i].categoria} -</small>
                                    </div>
                                </div>
                            </div>`
                    }
                    cadena += '</div>'
                    if (i == 4) {
                        cadenas.push(cadena)
                    }

                } while (res.length < i);
                console.log(cadenas)
            } else {
                cadena += `<div class="container text-center mt-5" style="grid-column: 1/7;">
                                <p>NO HAY PRODUCTOS EN ESTA CATEGORÍA DE <span class="text-uppercase"><?= $categoria ?></span></p>
                                <a href="<?= base_url() ?>" class="btn btn-dark">Descubre más aquí</a>
                            </div>`

            }

            $('#contenedor-productos-categoria').html(cadena)
            // $('.grid-responsive').html(cadena)
        }
    })
</script>