<link rel="stylesheet" href="<?= base_url('css/productos/producto.css') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<input type="number" id="idProduc" value="<?= $producto[0]['id_producto'] ?>" hidden>
<input type="text" id="nomProduc" value="<?= $producto[0]['nombre'] ?>" hidden>
<input type="number" id="precioProduc" value="<?= $producto[0]['precio'] ?>" hidden>
<input type="text" id="imgProduc" value="<?= $producto[0]['nombre_img'] ?>" hidden>
<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <div class="mb-3">
            <div class="contenedor-producto">
                <div class="swiper">
                    <div class="swiper-wrapper" id="swiper-wrapper">
                        <!-- FOTOS DINÁMICAS -->
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="d-flex flex-column justify-content-between contenedor-info">
                    <div>
                        <h3 class="text-capitalize fw-semibold"><?= $producto[0]['nombre'] ?></h3>
                        <small id="smCate" class="text-secondary"> - <?= $producto[0]['nomCate'] ?> - </small>
                    </div>
                    <p class="descripcion"><?= $producto[0]['descripcion'] ?></p>
                    <p>Calificación: <span id="calificacion" class="fs-5 text-warning"></span></p>
                    <div class="d-flex justify-content-around cont-precio-cant">
                        <div>
                            <p>Precio: </p>
                            <p class="text-center fw-bold text-danger" id="precio">
                                <!-- PRECIO FORMATEADO -->
                            </p>
                        </div>
                        <div>
                            <p for="cantidad">Cantidad:</p>
                            <input type="number" name="cantidad" class="form-control text-center" id="cantidad" value="0">
                        </div>
                    </div>
                    <div class="w-100">
                        <button id="btnAddCar" type="submit" class="btn btn-primary w-100">Agregar al carrito</button>
                    </div>
                    <div class="d-flex justify-content-between info-adicional">
                        <p class=""><small class="text-body-secondary">Fecha Publicado: <?= $producto[0]['fecha_public'] ?></small></p>
                        <p class=""><small class="text-body-secondary">Creador: <?= $producto[0]['nomCreador'] ?></small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedor-similares mb-3">
            <h2 class="text-center w-100 fw-semibold">Productos Similares</h2>
            <div class="swiper-similares">
                <div class="swiper-wrapper" id="swiper-similares">
                    <!-- PRODUCTOS DINÁMICOS -->
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
        <div class="contenedor-comentarios mb-3">
            <h3 class="text-center w-100 fw-semibold">Comentarios</h3>
            <div class="mt-2 mb-3">
                <?php if (session('id') != 0) { ?>
                    <form>
                        <div class="d-flex gap-2">
                            <p>Valoración: </p>
                            <div class="rating">
                                <i class="bi bi-star-fill star"></i>
                                <i class="bi bi-star-fill star"></i>
                                <i class="bi bi-star-fill star"></i>
                                <i class="bi bi-star-fill star"></i>
                                <i class="bi bi-star-fill star"></i>
                            </div>
                            <small class="invalido" id="invalidValor"></small>
                        </div>
                        <input type="number" name="valorCom" id="valorCom" value="0" hidden>
                        <input type="number" name="idComen" id="idComen" value="0" hidden>
                        <input type="number" name="tp" id="tp" value="1" hidden>
                        <textarea placeholder="Ingrese su comentario..." name="insertComent" id="insertComent" cols="30" rows="2" class="form-control"></textarea>
                        <small class="invalido d-block" id="invalidComen"></small>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-danger mt-2" id="btnCancelar" hidden>Cancelar</button>
                            <button class="btn btn-success mt-2" id="btnEnvComen">Publicar</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <p>Inicia sesión y coméntanos que tal este producto... ヾ(≧▽≦*)o</p>
                <?php }  ?>
            </div>
            <ul class="listado-comentarios">
                <!-- LISTADO DINÁMICO -->
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    var url = '<?= base_url() ?>';
    var id_usuario = <?= session('id') != 0 ? session('id') : 0 ?>
</script>
<script src="<?= base_url('js/productos/productoDetalles.js') ?>" type="text/javascript"></script>