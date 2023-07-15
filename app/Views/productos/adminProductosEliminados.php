<div class="contenedor">
    <!-- TABLA MOSTRAR PRODUCTOS -->
    <div id="content" class="p-4 p-md-5 h-100">
        <h2 class="text-center mb-4"><i class="bi bi-box-seam-fill fs-1"></i> Administrar Productos Eliminados</h2>
        <div class="table-responsive p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap ocultar">
                <b class="fs-6 text-black"> Ocultar Columnas:</b> <a class="toggle-vis btn" data-column="0">#</a> - <a class="toggle-vis btn" data-column="3">Dirección</a>
            </div>

            <div class="my-3">
                <a href="<?= base_url('adminProduc') ?>" class="btn btn-primary"> <i class="bi bi-box-seam-fill "></i> Productos</a>
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


<!-- FORMULARIO PARA AGREGAR - EDITAR PRODUCTO -->
<form autocomplete="off" id="formularioProductos" enctype="multipart/form-data">
    <div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <input type="text" name="id" id="id" hidden>
        <input type="text" name="tp" id="tp" hidden>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="body-M">
                <div class="modal-content">
                    <div class="modal-header flex align-items-center gap-3">
                        <div class="d-flex" style="width: 100%; justify-content: space-between; align-items: center;">
                            <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="Logo Empresa" class="logoEmpresa" width="60">
                            <h1 class="modal-title fs-5 d-flex align-items-center gap-2">
                                <span id="tituloModal"><i class="bi bi-eye-fill"></i> Ver</span>
                            </h1>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="nombre" class="col-form-label">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" oninput="this.value = this.value.replace(/[^a-zA-Zñáéíóú ]/,'')" disabled>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="descripcion" class="col-form-label">Descripción:</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion" style="height:150px" disabled></textarea>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="precio" class="col-form-label">Precio:</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="precio" class="form-control" id="precio" minlength="9" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')" disabled>
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <div class="">
                                        <label for="cantidad" class="col-form-label">Cantidad:</label>
                                        <input type="number" name="cantidad" class="form-control" id="cantidad" minlength="9" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')" disabled>
                                    </div>
                                    <input type="text" name="fecha" class="form-control" id="fecha" hidden>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="<?= base_url('js/productos/productosEliminados.js') ?>" type="text/javascript"></script>