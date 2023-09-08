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
                <div onclick="window.location.href = '<?= base_url('/categorias/'  . $categorias[$i]['nombre'])?>'">
                    <img src="<?= base_url('img/categorias/' . $categorias[$i]['nombre'] . '.png') ?>" alt="" class="icon" width="80">
                    <p class="text-capitalize"> - <?= $categorias[$i]['nombre'] ?> - </p>
                </div>
            <?php } ?>
        </div>
    </section>

    <div class="p-3" style="background-color: #69385C;" id="prodc-gust">
        <h2 class="fw-semibold w-100 text-center mb-4 text-white"> - Productos Que Te Pueden Gustar - </h2>
        <div class="contenedor-productos">
            <div class="swiper" id="swiper-produc-home">
                <div class="swiper-wrapper">
                    <!-- PRODUCTOS DINÁMICOS -->
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <div class="contenedor-suscripcion">
        <h2 class="w-100 text-center fw-semibold" style="color: #69385C;">¡Suscribete a nuestra tienda!</h2>
        <p class="text-center small" style="color: #69385C;">¡Sé el primero en recibir las últimas noticias sobre tendencias, promociones y mucho más!</p>
        <form class="row g-3 container" id="formulario-subs">
            <div class="col-12 d-flex gap-2 flex-wrap first-inputs">
                <div class="flex-grow-1">
                    <label for="primerNomSub" class="form-label">Primer Nombre</label>
                    <input type="text" name="primerNomSub" class="form-control" id="primerNomSub" placeholder="Ingresa tu Primer Nombre" required autocomplete="true">
                </div>
                <div class="flex-grow-1">
                    <label for="segundoNomSub" class="form-label">Segundo Nombre</label>
                    <input type="text" name="segundoNomSub" class="form-control" id="segundoNomSub" placeholder="Ingresa tu Segundo Nombre" autocomplete="true">
                </div>
            </div>
            <div class="col-12 d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="primerApeSub" class="form-label">Primer Apellido</label>
                    <input type="text" name="primerApeSub" class="form-control" id="primerApeSub" placeholder="Ingresa tu Primer Apellido" autocomplete="true">
                </div>
                <div class="flex-grow-1">
                    <label for="segundoApeSub" class="form-label">Segundo Apellido</label>
                    <input type="text" name="segundoApeSub" class="form-control" id="segundoApeSub" placeholder="Ingresa tu Segundo Apellido" required autocomplete="true">
                </div>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="tipoDocSub" class="form-label">Tipo Documento</label>
                    <select class="form-select" name="tipoDocSub" id="tipoDocSub">
                        <option value="">-- Seleccione --</option>
                        <option value="1">Cédula de Ciudadanía</option>
                        <option value="2">Cédula Extranjera</option>
                        <!-- < ?php foreach ($tipoDocs as $doc) { ?>
                                                    <option value="< ?= $doc['id'] ?>">< ?= $doc['nombre'] ?></option>
                                                < ?php } ?> -->
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label for="documentoSub" class="form-label">Documento</label>
                    <input type="text" name="documentoSub" class="form-control" id="documentoSub" placeholder="Ingresa tu N° Documento" required maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="telefonoSub" class="form-label">Teléfono</label>
                    <input type="text" name="telefonoSub" class="form-control" id="telefonoSub" placeholder="Ingresa tu N° Telefono" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">

                </div>
                <div class="flex-grow-1">
                    <label for="correoSub" class="form-label">Correo</label>
                    <input type="email" name="correoSub" placeholder="Ingresa tu Correo Electrónico" class="form-control" id="correoSub" required>
                </div>
            </div>
            <div class="col-12">
                <label for="usuario" class="form-label">Dirección</label>
                <div class="input-group has-validation">
                    <select class="input-group-text text-center" id="calkraSub">
                        <option value="Kra">Kra</option>
                        <option value="Calle">Calle</option>
                    </select>
                    <input type="text" class="form-control" id="numCalkraSub" placeholder="ej: 12A" required>
                    <span class="input-group-text" id="inputGroupPrepend">#</span>
                    <input type="text" class="form-control" id="numeroSub" placeholder="ej: 34B" required>
                    <span class="input-group-text" id="inputGroupPrepend">-</span>
                    <input type="text" class="form-control" id="numFinalSub" placeholder="ej: 56" required>
                </div>
            </div>
            <div class="">
                <div class="flex-grow-3">
                    <label for="departamentoSub" class="form-label">Departamento</label>
                    <select name="departamentoSub" class="form-control" id="departamentoSub">
                        <!-- SELECT DINÁMICO -->
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label for="municipioSub" class="form-label">Municipio</label>
                    <select name="municipioSub" class="form-control" id="municipioSub">
                        <option value="" selected>-- Seleccione --</option>
                        <!-- SELECT DINÁMICO  -->
                    </select>

                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <div class="flex-grow-1">
                    <label for="contrasenaRegisSub" class="form-label">Contraseña</label>
                    <input type="password" name="contrasenaRegisSub" class="form-control" id="contrasenaRegisSub" placeholder="Ingrese su Contraseña" required autocomplete="true">
                </div>
                <div class="flex-grow-1">
                    <label for="confirContrasenaSub" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="confirContrasenaSub" class="form-control" id="confirContrasenaSub" placeholder="Confirme su Contraseña" required autocomplete="true">
                </div>
            </div>
            <small class="invalido" id="msgContraSub"></small>
            <button class="btn btn-purple">SUSCRIBIRME</button>
        </form>
    </div>

    <footer style="background-color: #C1AE9F;">
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
    crearSwiper('swiper-produc-home', {
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
            1300: {
                slidesPerView: 4,
                spaceBetween: 50,
            }
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
                    cadena += `<div class="container text-center text-light">NO HAY PRODUCTOS EN ESTE MOMENTO</div>`
                    break;

                default:
                    res.forEach(element => {
                        var foto = `${url}imagenesProducto/${element.nombre_img}`;
                        cadena += `
                        <div onclick="window.location.href='<?= base_url('detalles-producto/') ?>${element.id_producto}'" class="card swiper-slide">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex justify-content-center w-100 py-3" >
                                    <img src="${foto}"alt="${element.nombre_img}" width="130" height="150">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title text-capitalize fw-bold" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1; overflow: hidden;"> ${element.nombre}</h5>
                                    <p class="card-text fw-semibold text-danger">${formatearCantidad(element.precio)} COP <span class="text-secondary">c/u</span></p>
                                    <small class="text-secondary text-capitalize">-${element.categoria}-</small>
                                </div>
                            </div>
                        </div>`
                    });
                    break;
            }

            $('#swiper-produc-home .swiper-wrapper').html(cadena)
        }
    })
    $('.first-inputs').on('click', () => $('#formulario-subs').addClass('visible'))

    function verifiContra(tipo, inputMsg, inputContra, inputConfir) {
        input = $(`#${inputMsg}`)
        contra = $(`#${inputContra}`).val()
        confirContra = $(`#${inputConfir}`).val()
        if (tipo == 2) {
            if (contra == '' && confirContra == '') {
                input.text('').removeClass().addClass('normal')
            } else if (contra == confirContra) {
                input.text('¡Contraseñas validas!').removeClass().addClass('valido')
            } else if (contra == '') {
                input.text('¡Ingresa una contraseña!').removeClass().addClass('normal')
            } else if (confirContra == '') {
                input.text('').removeClass().addClass('normal')
            } else if (contra != confirContra) {
                return input.text('¡Las contraseñas no coinciden!').removeClass().addClass('invalido')
            }
        } else {
            if (contra == '' && confirContra == '') {
                input.text('').removeClass().addClass('normal')
            } else if (contra == '' && confirContra) {
                input.text('¡Ingrese una contraseña!').removeClass().addClass('normal')
            } else if (confirContra == '') {
                input.text('').removeClass().addClass('normal')
            } else if (confirContra && contra == confirContra) {
                input.text('¡Contraseñas validas!').removeClass().addClass('valido')
            } else if (confirContra && contra != confirContra) {
                return input.text('¡Las contraseñas no coinciden!').removeClass().addClass('invalido')
            }
        }
    }
    $('#confirContrasenaSub').on('input', function(e) {
        verifiContra(2, 'msgContraSub', 'contrasenaRegisSub', 'confirContrasenaSub')
    })
    $('#contrasenaRegisSub').on('input', function(e) {
        verifiContra(1, 'msgContraSub', 'contrasenaRegisSub', 'confirContrasenaSub')
    })
    $('#departamentoSub').on('change', () => cambioDepa('departamentoSub', 'municipioSub'))
    $("#formulario-subs").on("submit", function(e) {
        e.preventDefault();
        nombreP = $("#primerNomSub").val();
        nombreS = $("#segundoNomSub").val();
        apellidoP = $("#primerApeSub").val();
        apellidoS = $("#segundoApeSub").val();
        correo = $("#correoSub").val();
        tipoDocumento = $("#tipoDocSub").val();
        nIdenti = $("#documentoSub").val();
        contra = $("#contrasenaRegisSub").val();


        calkra = $("#calkraSub").val();
        numCalkra = $("#numCalkraSub").val();
        numero = $("#numeroSub").val();
        numFinal = $("#numFinalSub").val();

        direccion = `${calkra} ${numCalkra} #${numero}-${numFinal}`

        departamento = $("#departamentoSub").val();
        municipio = $("#municipioSub").val();
        telefono = $("#telefonoSub").val();

        try {
            $.ajax({
                type: "POST",
                url: `${url}insertUsuario`,
                dataType: "json",
                data: {
                    tp: 1,
                    id: 0,
                    tipoUser: 4,
                    nombreP,
                    nombreS,
                    apellidoP,
                    apellidoS,
                    direccion,
                    tipoDoc: tipoDocumento,
                    departamento,
                    municipio,
                    nIdenti,
                    rol: 2,
                    contra,
                },
            }).done(function(res) {
                if (res != 2) {
                    $.ajax({
                        url: `${url}insertarTelefono`,
                        type: "POST",
                        data: {
                            tp: 1,
                            idUsuario: res,
                            idTele: 0,
                            numero: telefono,
                            prioridad: 'P',
                            tipoUsu: 4,
                            tipoTel: 15
                        },
                        dataType: "json",

                        success: function(r) {
                            $.ajax({
                                url: `${url}insertarCorreo`,
                                type: "POST",
                                data: {
                                    tp: 1,
                                    idCorreo: 0,
                                    idUsuario: res,
                                    correo: correo,
                                    prioridad: 'P',
                                },
                                dataType: "json",
                                success: function(data) {

                                    if (data == 1) {
                                        mostrarMensaje('success', '¡Te has suscrito a nuestra tienda!')
                                        $('#modalRegistroCliente').modal('hide')
                                    } else {
                                        mostrarMensaje("error", "¡Ha ocurrido un error!");
                                    }
                                }
                            })
                        },
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000)
                } else {
                    $("#contrasena").val("");
                    $("#invalid-feedback").text("¡Usuario o Contraseña incorrectos!");
                    setTimeout(() => {
                        $("#invalid-feedback").text("");
                    }, 3000);
                }
            });
        } catch (error) {
            console.log(error);
        }
    });
</script>