<link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/aos.css') ?>">
<main class="contenedor">
    <div class="contenedor-productos mt-5">
        <!-- PRODUCTOS DINAMICOS -->
    </div>

    <!-- CATEGORIAS -->
    <section class="d-flex justify-content-center align-items-center flex-column">
        <h1>Categorias</h1>
        <div class="container d-flex justify-content-center flex-column w-100">
            <div class="card mb-3" style="max-width: 540px;" id="card-categoria" data-aos="fade-right">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src=<?php echo base_url("img/logo-asoca-s.png") ?> class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Moda</h3>
                            <hr>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis iure possimus animi temporibus aspernatur, facere magnam blanditiis praesentium libero aliquam voluptate expedita officia labore culpa obcaecati quisquam? Ab, libero labore. .</p>
                            <button class="btn btn-primary">Ver mas
                                <i data-lucide-name="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 540px;" id="card-categoria" data-aos="fade-left">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src=<?php echo base_url("img/logo-asoca-s.png") ?> class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Belleza</h3>
                            <hr>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis iure possimus animi temporibus aspernatur, facere magnam blanditiis praesentium libero aliquam voluptate expedita officia labore culpa obcaecati quisquam? Ab, libero labore. .</p>
                            <button class="btn btn-primary">Ver mas
                                <i data-lucide-name="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 540px;" id="card-categoria" data-aos="fade-right">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src=<?php echo base_url("img/logo-asoca-s.png") ?> class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Accesorios</h3>
                            <hr>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis iure possimus animi temporibus aspernatur, facere magnam blanditiis praesentium libero aliquam voluptate expedita officia labore culpa obcaecati quisquam? Ab, libero labore. .</p>
                            <button class="btn btn-primary">Ver mas
                                <i data-lucide-name="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 540px;" id="card-categoria" data-aos="fade-left">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src=<?php echo base_url("img/logo-asoca-s.png") ?> class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Gourmet</h3>
                            <hr>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis iure possimus animi temporibus aspernatur, facere magnam blanditiis praesentium libero aliquam voluptate expedita officia labore culpa obcaecati quisquam? Ab, libero labore. .</p>
                            <button class="btn btn-primary">Ver mas
                                <i data-lucide-name="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="max-width: 540px;" id="card-categoria" data-aos="fade-right">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src=<?php echo base_url("img/logo-asoca-s.png") ?> class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Hogar </h3>
                            <hr>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis iure possimus animi temporibus aspernatur, facere magnam blanditiis praesentium libero aliquam voluptate expedita officia labore culpa obcaecati quisquam? Ab, libero labore. .</p>
                            <button class="btn btn-primary">Ver mas
                                <i data-lucide-name="chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

<script src="<?= base_url("js/aos.js") ?>"></script>
<script>
    AOS.init();
</script>
<script>
    $.ajax({
        url: `${url}obtenerProductos`,
        type: 'POST',
        dataType: 'json',
        data: {
            estado: 'A'
        },
        success: function(res) {
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
                                    <small class="text-secondary">-${element.categoria}-</small>
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