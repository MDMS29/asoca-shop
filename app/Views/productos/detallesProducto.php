<link rel="stylesheet" href="<?= base_url('css/productos/producto.css') ?>">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <div class="mb-3">
            <div class="contenedor-producto">

                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://w.forfun.com/fetch/f6/f6b5d2a50a42e6d0ee10c119c55b002a.jpeg" class="d-block" alt="...">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://w.forfun.com/fetch/2a/2a3c5a2a105989bebda3dba422c4bb4a.jpeg" class="d-block" alt="...">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://w.forfun.com/fetch/e7/e737b1a8b2a18297e1aafb1d6f301912.jpeg?h=900&r=0.5" class="d-block " alt="...">
                        </div>
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                <div>
                    <h4 class=""><?= $producto[0]['nombre'] ?></h4>
                    <p class="descripcion"><?= $producto[0]['descripcion'] ?></p>
                    <div class="d-flex justify-content-around">
                        <div>
                            <p>Precio: </p>
                            <p class="text-center">$ <?= $producto[0]['precio'] ?></p>
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
                    <p class=""><?= $producto[0]['valoracion'] ?></p>
                    <div class="d-flex justify-content-between">
                        <p class=""><small class="text-body-secondary">Fecha Publicado: <?= $producto[0]['fecha_public'] ?></small></p>
                        <p class=""><small class="text-body-secondary">Creador: <?= $producto[0]['nomCreador'] ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const swiper = new Swiper('.swiper', {
        autoplay: {
            delay: 2500,
            disableOnInteraction: false
        },
        direction: 'horizontal',
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>