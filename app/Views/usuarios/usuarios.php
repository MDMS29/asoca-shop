<div class="contenedor">
    <!-- TABLA MOSTRAR USUARIOS -->
    <div id="content" class="p-4 p-md-5 h-100">
        <h2 class="text-center mb-4 fw-bold"><i class="bi bi-people-fill fs-1"></i> Usuarios del Sistema</h2>
        <div class="table-responsive p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap ocultar">
                <b class="fs-6 text-black"> Ocultar Columnas:</b> <a class="toggle-vis btn" data-column="0">#</a> - <a class="toggle-vis btn" data-column="3">Tipo Documento</a> - <a class="toggle-vis btn" data-column="4">Identificación</a> - <a class="toggle-vis btn" data-column="5">Rol</a>
            </div>

            <div class="my-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarUsuario" onclick="seleccionarUsuario(0,1)"><i class="bi bi-plus-lg"></i> Agregar</button>
                <a href="<?= base_url('usuarios-eliminados') ?>" class="btn btn-danger"> <i class="bi bi-trash3-fill"></i> Eliminados</a>
            </div>

            <table class="table table-striped" id="tableUsuarios" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nombres</th>
                        <th scope="col" class="text-center">Apellidos</th>
                        <th scope="col" class="text-center">Tipo Documento</th>
                        <th scope="col" class="text-center">Identificación</th>
                        <th scope="col" class="text-center">Rol</th>
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

<!-- FORMULARIO PARA AGREGAR - EDITAR USUARIO -->
<form autocomplete="off" id="formularioUsuarios" enctype="multipart/form-data">
    <div class="modal fade" id="agregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <input type="text" name="id" id="id" hidden>
        <input type="text" name="tp" id="tp" hidden>
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="body-M">
                <div class="modal-content">
                    <div class="modal-header flex align-items-center gap-3">
                        <div class="d-flex" style="width: 100%; justify-content: space-between; align-items: center;">
                            <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="Logo Empresa" class="logoEmpresa" width="60">
                            <h1 class="modal-title fw-bold fs-5 d-flex align-items-center gap-2">
                                <i class="bi bi-plus-lg"></i>
                                <span id="tituloModal"><!-- TEXTO DINAMICO--></span>
                            </h1>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="nombre_p" class="col-form-label">Primer Nombre:</label>
                                    <input type="text" name="nombre_p" class="form-control" id="nombreP" oninput="this.value = this.value.replace(/[^a-zA-Zñáéíóú ]/,'')">
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <label for="nombre_s" class="col-form-label">Segundo Nombre:</label>
                                    <input type="text" name="nombre_s" class="form-control" id="nombreS" oninput="this.value = this.value.replace(/[^a-zA-Zñáéíóú ]/,'')">
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <div class="mb-3">
                                        <label for="tipoDoc" class="col-form-label">Tipo Identificación:</label>
                                        <select class="form-select form-select" name="tipoDoc" id="tipoDoc">
                                            <option value="" selected>-- Seleccione --</option>
                                            <?php foreach ($tipoDocs as $tipoDoc) { ?>
                                                <option value="<?= $tipoDoc['id'] ?>" selected><?= $tipoDoc['nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="apellido_p" class="col-form-label">Primer Apellido:</label>
                                    <input type="text" name="apellido_p" class="form-control" id="apellidoP" oninput="this.value = this.value.replace(/[^a-zA-Zñáéíóú ]/,'')">
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <label for="apellido_s" class="col-form-label">Segundo Apellido:</label>
                                    <input type="text" name="apellido_s" class="form-control" id="apellidoS" oninput="this.value = this.value.replace(/[^a-zA-Zñáéíóú ]/,'')">
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <div class="">
                                        <label for="nIdenti" class="col-form-label">N° Identificación:</label>
                                        <input type="number" name="nIdenti" class="form-control" id="nIdenti" minlength="9" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                        <small id="msgDoc" class="invalido"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%">
                                    <label for="telefono" class="col-form-label">Telefono:</label>
                                    <div class="d-flex">
                                        <input type="text" name="telefono" class="form-control" id="telefonoPrin" disabled>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#agregarTelefono" data-bs-target="#staticBackdrop" class="btn" style="border:none;background-color:gray;color:white;" title="Agregar Telefono">+</button>
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <div class="d-flex">
                                        <input type="email" name="email" class="form-control" id="email" disabled>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#agregarCorreo" data-bs-target="#staticBackdrop" class="btn" style="border:none;background-color:gray;color:white;" title="Agregar Correo">+</button>
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 100%">
                                    <div class="mb-3">
                                        <label for="rol" class="col-form-label">Tipo de Rol:</label>
                                        <select class="form-select form-select" name="rol" id="rol">
                                            <option selected value="">-- Seleccione --</option>
                                            <?php foreach ($roles as $r) { ?>
                                                <option value="<?= $r['id_rol'] ?>" <?= $r['nombre'] == 'Cliente' ? 'hidden' : '' ?>><?= $r['nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex column-gap-3" style="width: 100%">
                                <div class="mb-3" style="width: 100%" id="divContras">
                                    <label id="labelNom" for="nombres" class="col-form-label"> Contraseña:
                                    </label>
                                    <input type="password" name="contra" class="form-control" id="contra" autocomplete minlength="5">
                                    <small class="normal">¡La contraseña debe contar con un minimo de 6 caracteres!</small>

                                    <div class="form-check" style="margin-top: 10px;">
                                        <input class="form-check-input" type="checkbox" value="" id="ver" onchange="verContrasena()">
                                        <label class="form-check-label" for="ver">
                                            Ver Contraseña
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3" style="width: 100%" id="divContras2">
                                    <div>
                                        <label for="nombres" class="col-form-label">Confirmar Contraseña:</label>
                                        <input type="password" name="confirContra" class="form-control" autocomplete id="confirContra" minlength="5">
                                    </div>
                                    <small id="msgConfir" class="normal"></small>
                                </div>
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

<!-- MODAL AGREGAR - EDITAR TELEFONO -->
<div class="modal fade" id="agregarTelefono" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="60" height="60">
                    <h1 class="modal-title fs-5 text-center fw-bold" id="tituloModal"><i class="bi bi-telephone-plus-fill"></i> Agregar Telefono</h1>
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
                                    <?php foreach ($tipoTele as $tipe) { ?>
                                        <option value="<?= $tipe['id'] ?>"><?= $tipe['nombre'] ?></option>
                                    <?php } ?>
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
                    <button type="button" class="btn btn-primary" onclick="limpiarCampos('telefonoAdd', 'prioridad', 'tipoTele', 3)">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btnAddTel">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR - EDITAR CORREO -->
<div class="modal fade" id="agregarCorreo" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="body-M">
            <div class="modal-content">
                <div class="modal-header flex justify-content-between align-items-center">
                    <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="60" height="60">
                    <h1 class="modal-title fs-5 text-center " id="tituloModal"><i class="bi bi-envelope-plus-fill"></i> Agregar Correo</h1>
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
                    <button type="button" class="btn btn-primary" onclick="limpiarCampos('correoAdd', 'prioridadCorreo', '', 4)">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btnAddCorre">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR CONTRASEÑA -->
<form autocomplete="off" id="formularioContraseñas">
    <div class="modal fade" id="cambiarContra" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="body-M">
                <div class="modal-content">
                    <div class="modal-header flex justify-content-between align-items-center">
                        <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="logo-empresa" width="60" height="60">
                        <h1 class="modal-title fs-5 text-center " id="tituloModal">
                            <i class="bi bi-shield-lock-fill"></i> Actualizar Contraseña
                        </h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiarCampos('contraRes', 'confirContraRes', 'idUsuario')">X</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="idUsuario" id="idUsuario">
                        <div class="container p-4"">
                                <div class=" d-flex column-gap-3" style="width: 100%">
                            <div class="mb-3" style="width: 100%" id="divContras">
                                <label id="labelNom" for="nombres" class="col-form-label"> Contraseña:
                                </label>
                                <div class="flex">
                                    <input type="password" name="contraRes" class="form-control" id="contraRes" autocomplete minlength="5">
                                    <small class="normal">¡La contraseña debe contar con un minimo de 6
                                        caracteres!</small>
                                </div>
                                <div class="form-check" style="margin-top: 10px;">
                                    <input class="form-check-input" type="checkbox" value="" id="verModal" onchange="verContrasenaModal()">
                                    <label class="form-check-label" for="verModal">
                                        Ver Contraseña
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3" style="width: 100%" id="divContras2">
                                <div>
                                    <label for="nombres" class="col-form-label">Confirmar Contraseña:</label>
                                    <input type="password" name="confirContraRes" class="form-control" id="confirContraRes" autocomplete minlength="5">
                                </div>
                                <small id="msgConfirRes" class="normal"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close" onclick="limpiarCampos('contraRes', 'confirContraRes')">Cerrar</button>
                    <input type="submit" class="btn btn-success" value="Actualizar" id="btnActuContra"></input>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="<?= base_url('js/usuarios/usuarios.js') ?>" type="text/javascript"></script>