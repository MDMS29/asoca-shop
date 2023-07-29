<div class="contenedor">
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
            <button type="button" class="btn btn-primary" onclick="history.back()" alt="icon-plus" width="20"> <i class="bi bi-arrow-left"></i> Regresar</button>
        </div>
    </div>
</div>


<!-- MODAL AGREGAR - EDITAR TELEFONO -->
<div class="modal fade" id="verTelefonos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="60" height="60">
                    <h1 class="modal-title fs-5 text-center " id="tituloModal"><i class="bi bi-telephone-fill"></i> Ver Telefonos</h1>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiarCampos(3)">X</button>
                </div>
                <input type="text" name="editTele" id="editTele" hidden>
                <div class="modal-body">
                    <div class="container p-4" style="background-color: #d9d9d9;border-radius:10px;">
                        <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 150px;background-color:white;">
                            <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Telefono</th>
                                        <th>Tipo</th>
                                        <th>Prioridad</th>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="limpiarCampos(3)">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR - EDITAR CORREO -->
<div class="modal fade" id="verCorreos"tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header flex justify-content-between align-items-center">
                    <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="60" height="60">
                    <h1 class="modal-title fs-5 text-center " id="tituloModal"><i class="bi bi-envelope-at-fill"></i> Ver Correos</h1>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiarCampos(4)">X</button>
                </div>
                <input type="text" name="editCorreo" id="editCorreo" hidden>

                <div class="modal-body">
                    <div class="container p-4" style="background-color: #d9d9d9;border-radius:10px;">
                        <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 150px;background-color:white;">
                            <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Correo</th>
                                        <th>Prioridad</th>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="limpiarCampos(4)">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('js/clientes/clientes.js') ?>" type="text/javascript"></script>