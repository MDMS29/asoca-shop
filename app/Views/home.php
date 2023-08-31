<link rel="stylesheet" href="<?= base_url('css/home.css') ?>">
<main class="contenedor">
    <section class="hero mb-5" id="inicio">
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

    <section class="categorias-home mt-4 mb-5" id="categorias">
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

    <div class="p-3" style="background-color: #69385C;" id="prodc-gust">
        <h2 class="fw-semibold w-100 text-center mb-4 text-white"> - Productos Que Te Pueden Gustar - </h2>
        <div class="contenedor-productos">
            <!-- PRODUCTOS DINÁMICOS -->
        </div>
    </div>

    <div class="contenedor-suscripcion">
        <h2 class="w-100 text-center fw-semibold" style="color: #69385C;">¡Suscribete a nuestra tienda!</h2>
        <form class="row g-3 container" id="formulario-subs">
            <div class="col-12 d-flex gap-2 flex-wrap first-inputs">
                <div class="flex-grow-1">
                    <label for="primerNom" class="form-label">Primer Nombre</label>
                    <input type="text" name="primerNom" class="form-control" id="primerNom" placeholder="Ingrese tu Primer Nombre" required autocomplete="true">
                </div>
                <div class="flex-grow-1">
                    <label for="segundoNom" class="form-label">Segundo Nombre</label>
                    <input type="text" name="segundoNom" class="form-control" id="segundoNom" placeholder="Ingrese tu Segundo Nombre" autocomplete="true">
                </div>
            </div>
            <div class="col-12 d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="primerApe" class="form-label">Primer Apellido</label>
                    <input type="text" name="name" class="form-control" id="primerApe" placeholder="Ingrese tu Primer Apellido" autocomplete="true">
                </div>
                <div class="flex-grow-1">
                    <label for="segundoApe" class="form-label">Segundo Apellido</label>
                    <input type="text" name="name" class="form-control" id="segundoApe" placeholder="Ingrese tu Segundo Apellido" required autocomplete="true">
                </div>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="tipoDocumento" class="form-label">Tipo Documento</label>
                    <select class="form-select" name="tipoDocumento" id="tipoDocumento">
                        <option value="">-- Seleccione --</option>
                        <option value="1">Cédula de Ciudadanía</option>
                        <option value="2">Cédula Extranjera</option>
                        <!-- < ?php foreach ($tipoDocs as $doc) { ?>
                                                    <option value="< ?= $doc['id'] ?>">< ?= $doc['nombre'] ?></option>
                                                < ?php } ?> -->
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label for="documento" class="form-label">Documento</label>
                    <input type="text" name="documento" class="form-control" id="documento" placeholder="Ingrese tu N° Documento" required maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese tu N° Telefono" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">

                </div>
                <div class="flex-grow-1">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" name="correo" placeholder="Ingrese tu Correo Electrónico" class="form-control" id="correo" required>
                </div>
            </div>
            <div class="col-12">
                <label for="usuario" class="form-label">Dirección</label>
                <div class="input-group has-validation">
                    <select class="input-group-text text-center" id="calkra">
                        <option value="Kra">Kra</option>
                        <option value="Calle">Calle</option>
                    </select>
                    <input type="text" class="form-control" id="numCalkra" placeholder="ej: 12A" required>
                    <span class="input-group-text" id="inputGroupPrepend">#</span>
                    <input type="text" class="form-control" id="numero" placeholder="ej: 34B" required>
                    <span class="input-group-text" id="inputGroupPrepend">-</span>
                    <input type="text" class="form-control" id="numFinal" placeholder="ej: 56" required>
                </div>
            </div>
            <div class="">
                <div class="flex-grow-3">
                    <label for="departamento" class="form-label">Departamento</label>
                    <select name="departamento" class="form-control" id="departamento">
                        <!-- SELECT DINÁMICO -->
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label for="municipio" class="form-label">Municipio</label>
                    <select name="municipio" class="form-control" id="municipio">
                        <option value="" selected>-- Seleccione --</option>
                        <!-- SELECT DINÁMICO  -->
                    </select>

                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="contrasenaRegis" class="form-label">Contraseña</label>
                    <input type="password" name="contrasenaRegis" class="form-control" id="contrasenaRegis" placeholder="Ingrese su Contraseña" required>
                </div>
                <div class="flex-grow-1">
                    <label for="confirContrasena" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="confirContrasena" class="form-control" id="confirContrasena" placeholder="Confirme su Contraseña" required>
                </div>
            </div>
            <small class="invalido" id="msgContra"></small>

        </form>
    </div>

    <footer style="background-color: #C1AE9F;">
        <div class="d-flex justify-content-between p-5 flex-wrap">
            <div class="flex-grow-1 d-flex justify-content-center">
                <div style="width:200px">
                    <h1 class="fw-semibold text-center m-0">ASOCA</h1>
                    <p class="text-center" style="border-top: 1px solid #69385C;">Todo por tu bienestar</p>
                </div>
            </div>
            <div class="flex-grow-1 flex-wrap d-flex gap-5 justify-content-center">
                <div class="d-flex flex-column fw-semibold">
                    <p class="m-0 fs-4" style="color: #69385C;">Conoce más</p>
                    <a class="text-dark" href="#inicio">Inicio</a>
                    <a class="text-dark" href="#categorias">Categorías</a>
                    <a class="text-dark" href="#prodc-gust">Productos de tu gusto</a>
                </div>
                <div class="d-flex flex-column fw-semibold">
                    <p class="m-0 fs-4" style="color: #69385C;">Info Contacto</p>
                    <p class="m-0">Teléfono - 3014734903</p>
                    <!-- <p class="m-0">Correo Electrónico - servicioasoca@gmail.com</p> -->
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

    $('.first-inputs').on('click', $('#formulario-subs').addClass('visible'))
</script>