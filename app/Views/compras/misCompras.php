<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <h2 class="text-center mb-4 fw-bold"><i class="bi bi-bag-check-fill fs-1"></i> Compras Realizadas
        </h2>
        <div class="table-responsive p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap ocultar">
                <b class="fs-6 text-black"> Ocultar Columnas:</b> <a class="toggle-vis btn" data-column="1">N° Productos</a> - <a class="toggle-vis btn" data-column="3">Hora</a>
            </div>


            <table class="table table-striped" id="tableCompras" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ID Compra</th>
                        <th scope="col" class="text-center">N° Productos</th>
                        <th scope="col" class="text-center">Fecha</th>
                        <th scope="col" class="text-center">Hora</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Subtotal</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <!-- TABLA DE USUARIOS -->
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-primary" onclick="history.back()" alt="icon-plus" width="20"> <i class="bi bi-arrow-left"></i> Regresar</button>
        </div>
    </div>
</div>

<!-- MODAL VER LOS DETALLES -->
<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal">Detalles de Compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around mb-3">
                        <div class="d-flex gap-3">
                            <label>Productos Totales:</label>
                            <input class="text-center" type="text" id="nProduc" disabled>
                        </div>
                        <div class="d-flex gap-3">
                            <label>Estado:</label>
                            <input class="text-center" type="text" id="estado" disabled>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around mb-3">
                        <div class="d-flex gap-3">
                            <label>Fecha Compra:</label>
                            <input class="text-center" type="text" id="fecha" disabled>
                        </div>
                        <div class="d-flex gap-3">
                            <label>Hora Compra:</label>
                            <input class="text-center" type="text" id="hora" disabled>
                        </div>
                    </div>
                    <h6 class="fw-bold">Productos Comprados:</h6>
                    <table class="table  table-responsive table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal(Produc)</th>
                                <th id="obser">Observación</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTel">
                            <tr class="text-center">
                                <td colspan="4">NO HAY PRODUCTOS</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="w-100 d-flex justify-content-end align-items-center">
                        <p class="text-center fw-bold" style="margin-bottom: 0;">Total a Pagar: &nbsp;$</p>
                        <input type="text" class="text-center fw-bold" id="totalCompra" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btnActualizar" type="button" class="btn btn-success" data-bs-dismiss="modal">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/compras/misCompras.js') ?>"></script>
<script>
    const estiloEstado = {
        <?php foreach ($estadosCompra as $estado) { ?>
            <?= '"' . $estado['nombre'] . '"' ?>: <?= $estado['nombre'] == 'Pendiente' ? '"text-warning",' : ($estado['nombre'] == 'Cancelado' ? '"text-danger",' : ($estado['nombre'] == 'Confirmado' ? '"text-primary",' : ($estado['nombre'] == 'Entregado' ? '"text-success"' : ''))) ?>
        <?php } ?>
    }
    const estadosCompra = {
        <?php foreach ($estadosCompra as $estado) { ?>
            <?= $estado['id'] ?>: <?= '"' . $estado['nombre'] . '",' ?>
        <?php } ?>
    }
</script>