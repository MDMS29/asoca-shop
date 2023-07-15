<div class="contenedor">
    <div class="contenedor-productos mt-5">
        <?php foreach ($productos as $producto) { ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                            <p class="card-text" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3; overflow: hidden;" ><?= $producto['descripcion'] ?></p>
                            <p class="card-text"><small class="text-body-secondary"><?= $producto['fecha_public'] ?></small></p>
                            <div class="w-100 d-flex gap-2">
                                <a href="<?=base_url('verDetallesProducto/') . $producto['id_producto'] ?> " class="flex-grow-1 btn btn-danger">Detalles</a>
                                <button class="flex-grow-1 btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>