<link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
<main class="contenedor">
    <section class="hero mb-5">
        <!-- IMÁGENES PROMOCIONALES -->
        <div class="swiper" id="swiper-hero">
            <div class="swiper-wrapper">
                <div class="swiper-slide">Slide 1</div>
                <div class="swiper-slide">Slide 2</div>
                <div class="swiper-slide">Slide 3</div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="categorias-home mt-4 mb-5">
        <!-- CATEGORÍA DE PRODUCTOS -->
        <h2 class="fw-semibold w-100 text-center mb-4"> - Categorías - </h2>
        <div class="container-md contenedor-categorias">
            <?php for ($i = 0; $i < sizeof($categorias); $i++) { ?>
                <div id="<?= 'item-' . $i ?>">
                    <img src="<?= base_url('img/categorias/' . $categorias[$i]['nombre'] . '.png') ?>" alt="" class="icon" width="80">
                    <p> - <?= $categorias[$i]['nombre'] ?> - </p>
                </div>
            <?php } ?>
        </div>
    </section>

    <div class="p-3" style="background-color: #69385C;">
        <h2 class="fw-semibold w-100 text-center mb-4 text-white"> - Productos Que Te Pueden Gustar - </h2>
        <div class="contenedor-productos">
            <!-- PRODUCTOS DINÁMICOS -->
        </div>
    </div>
</main>

<script>
    crearSwiper('swiper-hero', {
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    })

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
                        <article onclick="window.location.href='<?= base_url('detalles-producto/') ?>${element.id_producto}'" class="card mb-3 producto">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center w-100 py-3" >
                                    <img src="${foto}"alt="${element.nombre_img}" width="130" height="150">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title text-capitalize fw-bold" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1; overflow: hidden;"> ${element.nombre}</h5>
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