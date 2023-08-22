<head>
    <meta charset="UTF-8">
    <title>Asoca</title>
    <meta name="description" content="¡La tienda donde encontrarás tus productos ideales!">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="<?= base_url('img/logo-asoca-s.png') ?>">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('img/logo-asoca-s.png') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap-5/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('dataTable/dataTables.bootstrap5.min.css') ?>" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;700&display=swap" rel="stylesheet">

    <script src="<?= base_url('bootstrap-5/js/bootstrap.bundle.min.js') ?>"></script>


</head>

<body class="d-flex relative">
    <header class="fixed-top d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url() ?>" class="d-flex align-items-center gap-3 text-dark p-2">
                <img src="<?= base_url('img/logo.png') ?>" alt="logo tienda" width="120">
                <!-- <h5 class="fw-semibold m-0">Asoca</h5> -->
            </a>
            <?= session('id') != 0 ? '<button id="btnMenu" class="btn fs-3"><i class="bi bi-list"></i></button>' : '' ?>

        </div>

        <div class="d-flex gap-2">
            <div class="d-flex align-items-center gap-3">
                <button class="btn text-primary" id="btnCarrito" style="transition: hover .2s ease-in ; border-radius:35%;">
                    <i class="bi bi-cart4 fs-5"></i>
                    <span id="numProducs">0</span>
                </button>
                <?php if (session('id') != 0) { ?>
                    <!-- <a href="" id="notifi" style="transition: hover .2s ease-in ;"><i class="bi bi-bell-fill fs-5"></i></a> -->
                <?php } ?>
            </div>
            <?php if (session('id') != 0) { ?>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill text-secondary" style="background-color: black;border-radius:100%; padding:3px 8px"></i>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('perfil') . '/' . session('id') ?>"> <i class="bi bi-person-fill-gear"></i> Perfil</a>
                        </li>
                        <li>
                            <button class="dropdown-item" onclick="salir()"><i class="bi bi-box-arrow-right"></i> Cerrar
                                Sesión </button>
                        </li>
                    </ul>
                </div>
            <?php } else { ?>
                <button class="btn btn-outline-primary" data-bs-target="#modalIniciarSesion" data-bs-toggle="modal">
                    Iniciar Sesión | Registrarse
                </button>

            <?php } ?>

        </div>
    </header>

    <?php if (session('id') != 0) { ?>
        <aside id="asidePrin">
            <ul class="text-center">
                <?php foreach (session('modulos') as $modulo) { ?>
                    <li>
                        <a href="<?= base_url($modulo['url']) ?>" title="<?= $modulo['modulo'] ?>" style="width: 100% !important;">
                            <i class="<?= $modulo['icon'] ?> fs-4"></i> <span>
                                <?= $modulo['modulo'] ?>
                            </span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </aside>
    <?php } ?>

    <aside id="asideCar">
        <!-- <ul>
            <li>
                <h3><i class="bi bi-cart4 fs-4"></i> Productos</h3>
            </li>
        </ul> -->
        <ul id="listaProductos">
            <!-- LISTA DINÁMICA -->
        </ul>
        <a href="<?= base_url('detalles-compra')  ?>" class="btn btn-danger fw-semibold btnDetalle">Más Detalles</a>
    </aside>
</body>

<!-- MODAL INICIAR SESION -->
<form id="formularioLogin">
    <div class="modal fade" id="modalIniciarSesion" aria-hidden="true" aria-labelledby="modalIniciarSesion" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card mb-3" style="border:none;">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Inicia Sesion</h5>
                                    <p class="text-center small">Ingresa tu usuario y contraseña para ingresar</p>
                                    <div class="w-100 text-center"><span id="invalid-feedback"></span></div>
                                </div>
                                <form class="row g-3">
                                    <div class="col-12">
                                        <label for="usuario" class="form-label">Usuario</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">#</span>
                                            <input type="text" name="usuario" class="form-control" id="usuario" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="contrasena" class="form-label">Contraseña</label>
                                        <input type="password" name="contrasena" class="form-control" id="contrasena" required>
                                    </div>

                                    <div class="col-12 my-3">
                                        <input class="btn btn-primary w-100" type="submit" value="Ingresar">
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">¿No tienes una cuenta? <button type="button" data-bs-toggle="modal" data-bs-target="#modalRegistroCliente" data-bs-target="#staticBackdrop" class="btn text-primary">
                                                Crear cuenta</button></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL REGISTRO DE CLIENTE -->
<form id="formularioRegistro">
    <div class="modal fade" id="modalRegistroCliente" aria-hidden="true" aria-labelledby="modalRegistroCliente" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card mb-3" style="border:none;">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Crea tu Cuenta</h5>
                                    <p class="text-center small">Ingresa tus detalles personales para crear una cuenta
                                    </p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-12 d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">

                                            <label for="primerNom" class="form-label">Primer Nombre</label>
                                            <input type="text" name="primerNom" class="form-control" id="primerNom" placeholder="Ingrese su Primer Nombre" required autocomplete="true">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="segundoNom" class="form-label">Segundo Nombre</label>
                                            <input type="text" name="segundoNom" class="form-control" id="segundoNom" placeholder="Ingrese su Segundo Nombre" autocomplete="true">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">
                                            <label for="primerApe" class="form-label">Primer Apellido</label>
                                            <input type="text" name="name" class="form-control" id="primerApe" placeholder="Ingrese su Primer Apellido" autocomplete="true">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="segundoApe" class="form-label">Segundo Apellido</label>
                                            <input type="text" name="name" class="form-control" id="segundoApe" placeholder="Ingrese su Segundo Apellido" required autocomplete="true">
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
                                            <input type="text" name="documento" class="form-control" id="documento" placeholder="Ingrese su N° Documento" required maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese su N° Telefono" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">

                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" name="correo" placeholder="Ingrese su Correo Electrónico" class="form-control" id="correo" required>
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

                                    <!-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value=""
                                                id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">Estoy de acuerdo y acepto los <a
                                                    href="#">terminos y condiciones</a></label>
                                        </div>
                                    </div> -->
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary w-100" type="submit">Crear Cuenta</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">¿Ya tienes cuenta? <button type="button" data-bs-toggle="modal" data-bs-target="#modalIniciarSesion " data-bs-target="#staticBackdrop" class="btn text-primary">
                                                Ingresa</button></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script src="<?= base_url('js/swalfire.js') ?>"></script>
<script src="<?= base_url('dataTable/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('dataTable/dataTables.bootstrap5.min.js') ?>"></script>
<script>
    var url = '<?= base_url() ?>';

    <?php if (session('id') != 0) { ?>

    <?php } else { ?>

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
                    input.text('¡Ingrese una contraseña!').removeClass().addClass('normal')
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
        $('#confirContrasena').on('input', function(e) {
            verifiContra(2, 'msgContra', 'contrasenaRegis', 'confirContrasena')
        })
        $('#contrasenaRegis').on('input', function(e) {
            verifiContra(1, 'msgContra', 'contrasenaRegis', 'confirContrasena')
        })


        $("#formularioLogin").on("submit", function(e) {
            e.preventDefault();
            usuario = $("#usuario").val();
            contrasena = $("#contrasena").val();
            try {
                $.ajax({
                    type: "POST",
                    url: `${url}login`,
                    dataType: "json",
                    data: {
                        usuario,
                        contrasena,
                    },
                }).done(function(res) {
                    if (res == 1) {
                        window.location.reload();
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


        $("#formularioRegistro").on("submit", function(e) {
            e.preventDefault();
            nombreP = $("#primerNom").val();
            nombreS = $("#segundoNom").val();
            apellidoP = $("#primerApe").val();
            apellidoS = $("#segundoApe").val();
            correo = $("#correo").val();
            tipoDocumento = $("#tipoDocumento").val();
            nIdenti = $("#documento").val();
            contra = $("#contrasenaRegis").val();


            calkra = $("#calkra").val();
            numCalkra = $("#numCalkra").val();
            numero = $("#numero").val();
            numFinal = $("#numFinal").val();

            direccion = `${calkra} ${numCalkra} #${numero}-${numFinal}`

            departamento = $("#departamento").val();
            municipio = $("#municipio").val();
            telefono = $("#telefono").val();

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
                                            mostrarMensaje('success', '¡Usuario creado con éxito, ya puedes ingresar!')
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
    <?php } ?>
</script>
<script src="<?= base_url('js/main.js') ?>" type="text/javascript"></script>