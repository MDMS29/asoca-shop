<link rel="stylesheet" href="<?= base_url('css/productos/producto.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<input type="number" id="idProduc" value="<?= $producto[0]['id_producto'] ?>" hidden>
<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <div class="mb-3">
            <div class="contenedor-producto">
                <div class="swiper">
                    <div class="swiper-wrapper" id="swiper-wrapper">
                        <!-- FOTOS DINAMICAS -->
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h3 class=""><?= $producto[0]['nombre'] ?></h3>
                    <p class="descripcion"><?= $producto[0]['descripcion'] ?></p>
                    <p class="">Calificación: <?= $producto[0]['valoracion'] ?></p>
                    <div class="d-flex justify-content-around">
                        <div>
                            <p>Precio: </p>
                            <p class="text-center fw-bold">$ <?= $producto[0]['precio'] ?></p>
                        </div>
                        <div>
                            <p for="cantidad">Cantidad:</p>
                            <select name="cantidad" id="cantidad">
                                <option value="" selected>-- Seleccione --</option>
                                <?php for ($i = 1; $i <= $producto[0]['cantidad_actual']; $i++) { ?>
                                    <option value="<?= $i ?>" selected><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-100">
                        <button class="btn btn-primary w-100">Agregar al carrito</button>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class=""><small class="text-body-secondary">Fecha Publicado: <?= $producto[0]['fecha_public'] ?></small></p>
                        <p class=""><small class="text-body-secondary">Creador: <?= $producto[0]['nomCreador'] ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="<?= base_url('js/productos/productoDetalles.js') ?>" type="text/javascript"></script>