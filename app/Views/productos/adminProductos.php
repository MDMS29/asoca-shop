<div class="contenedor">
    <!-- TABLA MOSTRAR PRODUCTOS -->
    <div id="content" class="p-4 p-md-5 h-100">
        <h2 class="text-center mb-4"><i class="bi bi-box-seam-fill fs-1"></i> Administrar Productos</h2>
        <div class="table-responsive p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap ocultar">
                <b class="fs-6 text-black"> Ocultar Columnas:</b> <a class="toggle-vis btn" data-column="0">#</a> - <a class="toggle-vis btn" data-column="3">Dirección</a>
            </div>

            <div class="my-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarUsuario" onclick="seleccionarUsuario(0,1)"><i class="bi bi-plus-lg"></i> Agregar</button>
                <a href="<?=base_url('')?>" class="btn btn-danger"> <i class="bi bi-trash3-fill"></i> Eliminados</a>
            </div>

            <table class="table table-striped" id="tableProductos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Descripción</th>
                        <th scope="col" class="text-center">Cantidad</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Fecha Publicado</th>
                        <th scope="col" class="text-center">Valoración</th>
                        <th scope="col" class="text-center">Creador</th>
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

<script src="<?= base_url('js/productos/productos.js') ?>" type="text/javascript"></script>