<head>
    <meta charset="UTF-8">
    <title>Asoca Shop</title>
    <meta name="description" content="¡La tienda donde encontrarás tu prenda ideal!">
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

<body class="d-flex">
    <header class="fixed-top d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url() ?>" class="d-flex align-items-center gap-3 text-dark">
                <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo tienda" width="50">
                <h5 class="fw-semibold m-0">Asoca</h5>
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
                    <a href="" id="notifi" style="transition: hover .2s ease-in ;"><i class="bi bi-bell-fill fs-5"></i></a>
                <?php } ?>
            </div>
            <?php if (session('id') != 0) { ?>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill text-secondary" style="background-color: black;border-radius:100%; padding:3px 8px"></i>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#"> <i class="bi bi-person-fill-gear"></i> Perfil</a>
                        </li>
                        <li>
                            <button class="dropdown-item" onclick="salir()"><i class="bi bi-box-arrow-right"></i> Cerrar
                                Sesion </button>
                        </li>
                    </ul>
                </div>
            <?php } else { ?>
                <button class="btn btn-primary" data-bs-target="#modalIniciarSesion" data-bs-toggle="modal">
                    Iniciar Sesion
                </button>

                <button class="btn" data-bs-toggle="modal" data-bs-target="#modalRegistroCliente" data-bs-target="#staticBackdrop">
                    Registrarse
                </button>
            <?php } ?>

        </div>
    </header>

    <?php if (session('id') != 0) { ?>
        <aside>
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
        <ul id="listaProductos">
            <li>
                <h3>Productos</h3>
            </li>
        </ul>
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
                                        <input type="password" name="contrasena" class="form-control" id="contrasena" required autocomplete>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card mb-3" style="border:none;">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Crear tu Cuenta</h5>
                                    <p class="text-center small">Ingresa tus detalles personales para crear una cuenta
                                    </p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Primer Nombre</label>
                                        <input type="text" name="name" class="form-control" id="primerNom" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Segundo Nombre</label>
                                        <input type="text" name="name" class="form-control" id="segundoNom" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Primer Apellido</label>
                                        <input type="text" name="name" class="form-control" id="primerApe" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Segundo Apellido</label>
                                        <input type="text" name="name" class="form-control" id="segundoApe" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="usuario" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="usuario" class="form-control" id="email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Contraseña</label>
                                        <input type="password" name="password" class="form-control" id="contrasenaRegis" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Confirmar Contraseña</label>
                                        <input type="password" name="password" class="form-control" id="confirContrasena" required>
                                    </div>

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
<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/swalfire.js') ?>"></script>
<script src="<?= base_url('dataTable/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('dataTable/dataTables.bootstrap5.min.js') ?>"></script>
<script>
    var url = '<?= base_url() ?>';

    <?php if (session('id') != 0) { ?>

    <?php } else { ?>
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
    <?php } ?>
</script>