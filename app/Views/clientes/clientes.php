<div class="contenedor">
    <link rel="stylesheet" href=" <?php echo base_url('css/usuarios/usuarios.css') ?>">

    <!-- TABLA MOSTRAR CLIENTES -->
    <div id="content" class="p-4 p-md-5 h-100">
        <h2 class="text-center mb-4"><i class="bi bi-person-lines-fill fs-1"></i> Administrar Clientes</h2>
        <div class="table-responsive p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap ocultar">
                <b class="fs-6 text-black"> Ocultar Columnas:</b> <a class="toggle-vis btn" data-column="0">#</a> - <a class="toggle-vis btn" data-column="3">Dirección</a>
            </div>


            <table class="table table-striped" id="tableClientes" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nombres</th>
                        <th scope="col" class="text-center">Apellidos</th>
                        <th scope="col" class="text-center">Dirección</th>
                        <th scope="col" class="text-center">Más Info</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <!-- TABLA DE USUARIOS -->
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuario" onclick="" alt="icon-plus" width="20"> <i class="bi bi-arrow-left"></i> Regresar</button>
        </div>
    </div>
</div>


<!-- MODAL AGREGAR - EDITAR TELEFONO -->
<div class="modal fade" id="verTelefonos" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="100" height="60">
                    <h1 class="modal-title fs-5 text-center " id="tituloModal"><i class="bi bi-telephone-fill"></i> Ver Telefonos</h1>
                    <button type="button" class="btn" aria-label="Close" onclick="limpiarCampos('telefonoAdd', 'prioridad', 'tipoTele', 3)">X</button>
                </div>
                <input type="text" name="editTele" id="editTele" hidden>
                <div class="modal-body">
                    <div class="container p-4" style="background-color: #d9d9d9;border-radius:10px;">
                        <div class="mb-2 d-flex gap-3 flex-wrap" style="width: 100%;">
                            <div class="flex-grow-1">
                                <label for="telefonoAdd" class="col-form-label">Telefono:</label>
                                <div>
                                    <input type="text" name="telefonoAdd" class="form-control" id="telefonoAdd" minlength="7" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                    <small id="msgTel" class="invalido"></small>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <label for="prioridad" class="col-form-label">Tipo Telefono:</label>
                                <select class="form-select form-control" name="tipoTele" id="tipoTele">
                                    <option selected value="">-- Seleccione --</option>
                                    <!-- < ?php foreach ($tipoTele as $tipe) { ?>
                                            <option value="< ?= $tipe['id'] ?>">< ?= $tipe['nombre'] ?></option>
                                        < ?php } ?> -->
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <label for="prioridad" class="col-form-label">Prioridad:</label>
                                <select class="form-select form-control" name="prioridad" id="prioridad">
                                    <option selected value="">-- Seleccione --</option>
                                    <option value="P">Principal</option>
                                    <option value="S">Secundaria</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 150px;background-color:white;">
                            <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Telefono</th>
                                        <th>Tipo</th>
                                        <th>Prioridad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyTel">
                                    <tr class="text-center">
                                        <td colspan="4">NO HAY TELEFONOS</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnRedireccion" onclick="limpiarCampos('telefonoAdd', 'prioridad', 'tipoTele', 3)">Cerrar</button>
                    <button type="button" class="btn btnAccionF" id="btnAddTel">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR - EDITAR CORREO -->
<div class="modal fade" id="verCorreos" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header flex justify-content-between align-items-center">
                    <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="100" height="60">
                    <h1 class="modal-title fs-5 text-center " id="tituloModal"><i class="bi bi-envelope-at-fill"></i> Ver Correos</h1>
                    <button type="button" class="btn" aria-label="Close" onclick="limpiarCampos('correoAdd', 'prioridadCorreo', '', 4)">X</button>
                </div>
                <input type="text" name="editCorreo" id="editCorreo" hidden>

                <div class="modal-body">

                    <div class="container p-4" style="background-color: #d9d9d9;border-radius:10px;">
                        <div class="mb-2 d-flex gap-3" style="width: 100%;">
                            <div class="d-flex gap-2" style="width: 100%;">
                                <label for="correoAdd" class="col-form-label">Correo:</label>
                                <div>
                                    <input type="email" name="correoAdd" class="form-control" id="correoAdd" oninput="this.value = this.value.replace(/[^a-zA-Z0-9.@ñ]/,'')">
                                    <small id="msgCorreo" class="invalido"></small>
                                </div>
                            </div>
                            <div class="d-flex gap-2" style="width: 100%;">
                                <label for="prioridad" class="col-form-label">Prioridad:</label>
                                <select class="form-select form-select" name="prioridadCorreo" id="prioridadCorreo">
                                    <option selected value="">-- Seleccione --</option>
                                    <option value="P">Principal</option>
                                    <option value="S">Secundaria</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 150px;background-color:white;">
                            <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Correo</th>
                                        <th>Prioridad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyCorre">
                                    <tr class="text-center">
                                        <td colspan="3">NO HAY CORREOS</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnRedireccion" onclick="limpiarCampos('correoAdd', 'prioridadCorreo', '', 4)">Cerrar</button>
                    <button type="button" class="btn btnAccionF" id="btnAddCorre">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/clientes.js') ?>" type="text/javascript"></script>