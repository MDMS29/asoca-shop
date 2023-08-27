<div class="contenedor">
    <div id="content" class="p-4 p-md-5 h-100">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?= base_url('img/logo-asoca-s.png') ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?= $usuario['nombre_p'] . ' ' . $usuario['apellido_p'] ?></h5>
                            <p class="text-muted mb-1"><?= $usuario['nombre_rol'] ?></p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary" data-bs-target="#modalActualizarPerfil" data-bs-toggle="modal" onclick="seleccionarUsuario(<?= $usuario['id_usuario'] ?>)">Actualizar Perfil</button>
                                <!-- <button type="button" class="btn btn-outline-primary ms-1">Cambiar Contraseña</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">https://mdbootstrap.com</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nombre Completo</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $usuario['nomCompleto'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Correo Electrónico</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $usuario['correo'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Teléfono</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $usuario['numero'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Dirección</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $usuario['direccion'] . '  (' . $usuario['municipio'] . '/' . $usuario['departamento'] . ')' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL REGISTRO DE CLIENTE -->
<form id="formularioActualizar">
    <div class="modal fade" id="modalActualizarPerfil" aria-hidden="true" aria-labelledby="modalRegistroCliente" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card mb-3" style="border:none;">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Actualiza tu Cuenta</h5>
                                    <p class="text-center small">Edita tus detalles personales</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-12 d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">

                                            <label for="primerNom" class="form-label">Primer Nombre</label>
                                            <input type="text" name="primerNom" class="form-control" id="primerNom" placeholder="Ingrese su Primer Nombre" required autocomplete="true">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="segundoNom" class="form-label">Segundo Nombre</label>
                                            <input type="text" name="segundoNom" class="form-control" id="segundoNom" placeholder="Ingrese su Segundo Nombre" autocomplete="true">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">
                                            <label for="primerApe" class="form-label">Primer Apellido</label>
                                            <input type="text" name="name" class="form-control" id="primerApe" placeholder="Ingrese su Primer Apellido" autocomplete="true">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="segundoApe" class="form-label">Segundo Apellido</label>
                                            <input type="text" name="name" class="form-control" id="segundoApe" placeholder="Ingrese su Segundo Apellido" required autocomplete="true">
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">
                                            <label for="tipoDocumento" class="form-label">Tipo Documento</label>
                                            <select class="form-select" name="tipoDocumento" id="tipoDocumento">
                                                <option value="">-- Seleccione --</option>
                                                <option value="1">Cédula de Ciudadanía</option>
                                                <option value="2">Cédula Extranjera</option>
                                                <!-- < ?php foreach ($tipoDocs as $doc) { ?>
                                                    <option value="< ?= $doc['id'] ?>">< ?= $doc['nombre'] ?></option>
                                                < ?php } ?> -->
                                            </select>
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="documento" class="form-label">Documento</label>
                                            <input type="text" name="documento" class="form-control" id="documento" placeholder="Ingrese su N° Documento" required maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <div class="flex-grow-1">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese su N° Telefono" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/,'')">
                                            <input type="number" id="idTel" value="0" hidden>
                                            <input type="number" id="idCorreo" value="0" hidden>
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" name="correo" placeholder="Ingrese su Correo Electrónico" class="form-control" id="correo" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="calkra" class="form-label">Dirección</label>
                                        <div class="input-group has-validation">
                                            <select class="input-group-text text-center" id="calkra">
                                                <option value="Kra">Kra</option>
                                                <option value="Calle">Calle</option>
                                            </select>
                                            <input type="text" class="form-control" id="numCalkra" placeholder="ej: 12A" required>
                                            <span class="input-group-text" id="inputGroupPrepend">#</span>
                                            <input type="text" class="form-control" id="numero" placeholder="ej: 34B" required>
                                            <span class="input-group-text" id="inputGroupPrepend">-</span>
                                            <input type="text" class="form-control" id="numFinal" placeholder="ej: 56" required>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="flex-grow-3">
                                            <label for="departamento" class="form-label">Departamento</label>
                                            <select name="departamento" class="form-control" id="departamento">
                                                <!-- SELECT DINÁMICO -->
                                            </select>
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="municipio" class="form-label">Municipio</label>
                                            <select name="municipio" class="form-control" id="municipio">
                                                <option value="" selected>-- Seleccione --</option>
                                                <!-- SELECT DINÁMICO  -->
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary w-100" type="submit">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function seleccionarUsuario(id) {
        $.ajax({
            url: `${url}buscarUsuario/${id}/0`,
            type: 'POST',
            dataType: 'json',
            data: {},
            success: function(res) {
                $("#primerNom").val(res[0].nombre_p);
                $("#segundoNom").val(res[0].nombre_s);
                $("#primerApe").val(res[0].apellido_p);
                $("#segundoApe").val(res[0].apellido_s);
                $("#correo").val(res[0].correo);
                $("#tipoDocumento").val(res[0].tipo_documento);
                $("#documento").val(res[0].n_documento);
                $("#idTel").val(res[0].id_telefono == null ? 0 : res[0].id_telefono);
                $("#idCorreo").val(res[0].id_correo == null ? 0 : res[0].id_correo);

                const calkra = res[0].direccion.split(' ')[0]
                const num1 = res[0].direccion.split('#')[1].split('-')
                const num2 = res[0].direccion.split('Calle' || 'Kra')[1].split('#')[0]


                $("#calkra").val(calkra);
                $("#numCalkra").val(num2);
                $("#numero").val(num1[0]);
                $("#numFinal").val(num1[1]);

                $("#departamento").val(res[0].departamento);

                const municipio = municipios.filter(item => item.departamento == res[0].departamento)

                var cadena = ''
                cadena = ` <option value="">-- Seleccione --</option>`
                for (let i = 0; i < municipio.length; i++) {
                    cadena += ` <option value="${municipio[i].municipio}">${municipio[i].municipio}</option>`
                }

                $('#municipio').html(cadena)
                $("#municipio").val(res[0].municipio);

                $("#telefono").val(res[0].numero);
            }
        })
    }

    $("#formularioActualizar").on("submit", function(e) {
        e.preventDefault();
        nombreP = $("#primerNom").val();
        nombreS = $("#segundoNom").val();
        apellidoP = $("#primerApe").val();
        apellidoS = $("#segundoApe").val();
        correo = $("#correo").val();
        tipoDocumento = $("#tipoDocumento").val();
        nIdenti = $("#documento").val();
        contra = $("#contrasenaRegis").val();


        calkra = $("#calkra").val();
        numCalkra = $("#numCalkra").val();
        numero = $("#numero").val();
        numFinal = $("#numFinal").val();

        direccion = `${calkra} ${numCalkra} #${numero}-${numFinal}`

        departamento = $("#departamento").val();
        municipio = $("#municipio").val();
        telefono = $("#telefono").val();
        idTel = $("#idTel").val();
        idCorreo = $("#idCorreo").val();


        try {
            $.ajax({
                type: "POST",
                url: `${url}insertUsuario`,
                dataType: "json",
                data: {
                    tp: 2,
                    id: <?= session('id') ?>,
                    tipoUser: 4,
                    nombreP,
                    nombreS,
                    apellidoP,
                    apellidoS,
                    direccion,
                    tipoDoc: tipoDocumento,
                    departamento,
                    municipio,
                    nIdenti,
                    rol: 2,
                    contra,
                },
            }).done(function(res) {
                if (res != 2) {
                    $.ajax({
                        url: `${url}insertarTelefono`,
                        type: "POST",
                        data: {
                            tp: 2,
                            idUsuario: res,
                            idTele: idTel,
                            numero: telefono,
                            prioridad: 'P',
                            tipoUsu: 4,
                            tipoTel: 15
                        },
                        dataType: "json",

                        success: function(r) {
                            $.ajax({
                                url: `${url}insertarCorreo`,
                                type: "POST",
                                data: {
                                    tp: 2,
                                    idCorreo: idCorreo,
                                    idUsuario: res,
                                    correo: correo,
                                    prioridad: 'P',
                                },
                                dataType: "json",
                                success: function(data) {
                                    if (data == 1) {
                                        mostrarMensaje('success', '¡Se ha actualizado su perfil!')
                                        $('#modalRegistroCliente').modal('hide')
                                    } else {
                                        mostrarMensaje("error", "¡Ha ocurrido un error!");
                                    }
                                }
                            })
                        },
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000)
                } else {
                    $("#contrasena").val("");
                    $("#invalid-feedback").text("¡Usuario o Contraseña incorrectos!");
                    setTimeout(() => {
                        $("#invalid-feedback").text("");
                    }, 3000);
                }
            });
        } catch (error) {
            console.log(error);
        }
    });

    $('#departamento').on('change', function() {
        const departamento = $('#departamento').val()
        const municipio = municipios.filter(item => item.departamento == departamento)

        var cadena = ''
        cadena = ` <option value="">-- Seleccione --</option>`
        for (let i = 0; i < municipio.length; i++) {
            cadena += ` <option value="${municipio[i].municipio}">${municipio[i].municipio}</option>`
        }

        $('#municipio').html(cadena)
    })
</script>