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

    <script src="<?= base_url('bootstrap-5/js/bootstrap.bundle.min.js') ?>"></script>


</head>

<body class="d-flex">

    <header class="fixed-top d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <button id="btnMenu" class="btn fs-3"><i class="bi bi-list"></i></button>
            <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo tienda" width="50">
            <h5>Asoca Shop</h5>
        </div>

        <div class="dropdown">
            <div>
                <i class="bi bi-bell-fill"></i>
            </div>
            <div>
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill text-secondary" style="background-color: black;border-radius:100%; padding:3px 8px"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-person-fill-gear"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> Cerrar Sesion </a></li>
                </ul>
            </div>
        </div>
    </header>

    <aside>
        <ul class="text-center">
            <!-- <li>
                <a href="" style="width: 100% !important;">
                    <i class="bi bi-database-fill-gear fs-4"></i> <span>Base de Datos</span>
                </a>
            </li> -->
            <li>
                <a href="" style="width: 100% !important;">
                    <i class="bi bi-database-fill-gear fs-4"></i> <span>Productos</span>
                </a>
            </li>
            <li>
                <a href="" style="width: 100% !important;">
                    <i class="bi bi-people-fill fs-4"></i> <span>Usuarios</span>
                </a>
            </li>
            <li><a href="">Compras</a></li>
        </ul>
    </aside>
</body>

<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script src="<?= base_url('js/main.js') ?>"></script>