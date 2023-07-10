<div class="contenedor">
    <div class="container mt-5">
        <?php foreach ($productos as $producto) { ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                            <p class="card-text"><?= $producto['descripcion'] ?></p>
                            <p class="card-text"><small class="text-body-secondary"><?= $producto['fecha_public'] ?></small></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>