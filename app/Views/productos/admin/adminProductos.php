<div class="contenedor">
    <!-- TABLA MOSTRAR PRODUCTOS -->
    <div id="content" class="p-4 p-md-5 h-100">
        <h2 class="text-center mb-4 fw-bold"><i class="bi bi-box-seam-fill fs-1"></i> Administrar Productos</h2>
        <div class="table-responsive p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap ocultar">
                <b class="fs-6 text-black"> Ocultar Columnas:</b> <a class="toggle-vis btn" data-column="0">#</a>  - <a class="toggle-vis btn" data-column="2">Categoría</a> - <a class="toggle-vis btn" data-column="3">Descripción</a> - <a class="toggle-vis btn" data-column="7">Valoración</a>
            </div>

            <div class="my-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarProducto" onclick="seleccionarProducto(0,1)"><i class="bi bi-plus-lg"></i> Agregar</button>
                <a href="<?= base_url('admin-productos-eliminados') ?>" class="btn btn-danger"> <i class="bi bi-trash3-fill"></i> Eliminados</a>
            </div>

            <table class="table table-striped" id="tableProductos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Categoría</th>
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
                                <i class="bi bi-plus-lg"></i>
                                <span id="tituloModal" class="fw-bold"><!-- TEXTO DINAMICO--></span>
                            </h1>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3 flex-grow-1" style="width: 100%">
                                    <label for="nombre" class="col-form-label">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" oninput="this.value = this.value.replace(/[^a-zA-Zñáéíóú ]/,'')">
                                    <input type="text" name="nombreEdit" class="form-control" id="nombreEdit" hidden>
                                    <small class="invalido" id="msgNombre"></small>
                                </div>
                                <div class="mb-3 flex-grow-1" style="width: 100%">
                                    <label for="nombre" class="col-form-label">Categoría:</label>
                                    <select name="categoria" class="form-select text-capitalize" id="categoria">
                                        <option value="">-- Seleccione --</option>
                                        <?php foreach($categorias as $cate){?>
                                            <option class="text-capitalize" value="<?= $cate['id']?>"><?= $cate['nombre']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="descripcion" class="col-form-label">Descripción:</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion" style="height:150px"></textarea>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="precio" class="col-form-label">Precio:</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="precio" class="form-control" id="precio" minlength="9" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <div class="">
                                        <label for="cantidad" class="col-form-label">Cantidad:</label>
                                        <input type="number" name="cantidad" class="form-control" id="cantidad" minlength="9" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                    </div>
                                    <input type="text" name="fecha" class="form-control" id="fecha" hidden>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#fotosProducto"><i class="bi bi-images"></i> Editar Imagenes</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" id="btnGuardar"><!-- TEXTO DIANMICO --></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="fotosProducto" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header flex align-items-center gap-3">
                    <div class="d-flex" style="width: 100%; justify-content: space-between; align-items: center;">
                        <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="Logo Empresa" class="logoEmpresa" width="60">
                        <h1 class="modal-title fw-bold fs-5 d-flex align-items-center gap-2">
                            <i class="bi bi-images"></i>
                            <span id="tituloModal">Fotos Producto</span>
                        </h1>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#agregarProducto" aria-label="Close">X</button>
                    </div>
                </div>
                <div class="modal-body"><div class="my-3" id="prev-img">
                        <div class="d-flex column-gap-3" style="width: 100%"><input type="file" id="fileInput"><img id="previewImage" src="#" alt="Vista previa de la imagen" width="100"></div>
                    </div>
                    <div class="my-3" id="prev-img">
                        <div class="d-flex column-gap-3" style="width: 100%"><input type="file" id="fileInput1"><img id="previewImage1" src="#" alt="Vista previa de la imagen" width="100"></div>
                    </div>
                    <div class="my-3" id="prev-img">
                        <div class="d-flex column-gap-3" style="width: 100%"><input type="file" id="fileInput2"><img id="previewImage2" src="#" alt="Vista previa de la imagen" width="100"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarProducto">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/productos/productos.js') ?>" type="text/javascript"></script>