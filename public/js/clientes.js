var contadorUser = 0;
var contador = 0;
var contadorCorreo = 0;
var inputIden = 0;
let telefonos = []; //Telefonos del usuario.
let correos = []; //Correos del usuario.
var validTel = true;
var validCorreo = true;
var validIdent = true;

//Marcar botones ocultar columnas
var botones = $(".ocultar a");
botones.click(function () {
  if ($(this).attr("class").includes("active")) {
    $(this).removeClass("active");
  } else {
    $(this).addClass("active");
  }
});
//Mostrar Ocultar Columnas
$("a.toggle-vis").on("click", function (e) {
  e.preventDefault();
  // Get the column API object
  var column = tableClientes.column($(this).attr("data-column"));
  // Toggle the visibility
  column.visible(!column.visible());
});

// Tabla de usuarios
var tableClientes = $("#tableClientes").DataTable({
  ajax: {
    url: `${url}obtenerClientes`,
    method: "POST",
    data: {
      tipoUser: 3,
      estado: "A",
    },
    dataSrc: "",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row) {
        contadorUser = contadorUser + 1;
        return "<b>" + contadorUser + "</b>";
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        // Combinar campos
        return data.nombre_p + " " + data.nombre_s;
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        // Combinar campos
        return data.apellido_p + " " + data.apellido_s;
      },
    },
    {
      data: "direccion",
    },
    {
      data: null,
      render: function (data, type, row) {
        return (
          '<div class="d-flex gap-2 justify-content-center">' +
          '<button class="btn btn-outline-primary" onclick="buscarCorreoTel(' +
          data.id_usuario +
          ')" data-bs-toggle="modal" data-bs-target="#verTelefonos" title="Banear Usuario"><i class="bi bi-telephone"></i></button>' +
          '<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#verCorreos" data-bs-target="#staticBackdrop" onclick=$("#idUsuario").val(' +
          data.id_usuario +
          ') title="Restaurar Contraseña"><i class="bi bi-envelope-at"></i></button></div>'
        );
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return (
          '<div class="d-flex gap-2 justify-content-center">' +
          '<button class="btn btn-outline-danger" onclick="eliminarUsuario(' +
          data.id_usuario +
          ')" data-bs-toggle="modal" data-bs-target="#modalConfirmar" title="Banear Usuario"><i class="bi bi-x-circle"></i></button>' +
          '<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#cambiarContra" data-bs-target="#staticBackdrop" onclick=$("#idUsuario").val(' +
          data.id_usuario +
          ') title="Restaurar Contraseña"><i class="bi bi-shield-lock-fill"></i></button></div>'
        );
      },
    },
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  },
});
//Limpiar campos de telefonos y correos
function limpiarCampos(input1, input2, input3, accion) {
  if (accion == 3) {
    if (telefonos.length != 0) {
      principalT = telefonos.filter((tel) => tel.prioridad == "P");
      if (principalT.length == 0) {
        return mostrarMensaje("error", "¡Debe tener un telefono principal!");
      } else {
        $("#agregarTelefono").modal("hide");
        // $('#fotoModal').attr('hidden', '')
        $("#agregarUsuario").modal("show");
      }
    } else {
      $("#agregarTelefono").modal("hide");
      // $('#fotoModal').attr('hidden', '')
      $("#agregarUsuario").modal("show");
    }
  }
  if (accion == 4) {
    if (correos.length != 0) {
      principalC = correos.filter((correo) => correo.prioridad == "P");
      if (principalC.length == 0) {
        return mostrarMensaje("error", "¡Debe tener un correo principal!");
      } else {
        $("#agregarCorreo").modal("hide");
        $("#agregarUsuario").modal("show");
        // $('#fotoModal').attr('hidden')
      }
    } else {
      $("#agregarCorreo").modal("hide");
      $("#agregarUsuario").modal("show");
      // $('#fotoModal').attr('hidden')
    }
  }
  if (objCorreo.id != 0) {
    correos.push(objCorreo);
    guardarCorreo();
  }
  if (objTelefono.id != 0) {
    telefonos.push(objTelefono);
    guardarTelefono();
  }
  if (input1 == 0) {
    telefonos = [];
    correos = [];
  }
  objCorreo = {
    id: 0,
    correo: "",
    prioridad: "",
  };
  objTelefono = {
    id: 0,
    numero: "",
    tipo: "",
    prioridad: "",
  };
  $(`#${input1}`).val("");
  $(`#${input2}`).val("");
  $(`#${input3}`).val("");
  $("#msgConfirRes").text("");
  $("#msgConfir").text("");
  $("#msgTel").text("");
  $("#msgCorreo").text("");
  $("#FotoUsuario").text("");
  // $('#fotoModal').removeAttr('hidden')
  $("#foto").val("");
}

//Funcion para buscar el correo o el telefono
function buscarCorreoTel(url, valor, inputName, tipo) {
  $.ajax({
    type: "POST",
    url: "<?php echo base_url() ?>" + `${url}` + valor + "/" + 0 + "/" + 7, //url, valor, idUsuario, tipoUsuario
    dataType: "JSON",
    success: function (res) {
      if (res[0] == null) {
        $(`#${inputName}`).text("");
        validTel = true;
        validCorreo = true;
      } else if (res[0] != null) {
        $(`#${inputName}`).text(`* Este ${tipo} ya esta registrado *`);
        validTel = false;
        validCorreo = false;
      }
    },
  });
}

// Funcion para mostrar telefonos en la tabla.
function guardarTelefono() {
  principal = telefonos.filter((tel) => tel.prioridad == "P");
  $("#telefono").val(principal[0]?.numero);
  var cadena;
  if (telefonos.length == 0) {
    cadena += ` <tr class="text-center">
            <td colspan="4">NO HAY TELEFONOS</td>
            </tr>`;
    $("#bodyTel").html(cadena);
  } else {
    for (let i = 0; i < telefonos.length; i++) {
      cadena += ` <tr class="text-center" id='${telefonos[i].id}'>
                                <td>${telefonos[i].numero}</td>
                                <td id=${telefonos[i].tipo}>${
        telefonos[i].tipo == 3 ? "Celular" : "Fijo"
      }</td>
                                <td id=${telefonos[i].prioridad}>${
        telefonos[i].prioridad == "S" ? "Secundaria" : "Principal"
      }</td>  
                                <td>
                                    <button class="btn btnEditarTel" id="btnEditarTel${
                                      telefonos[i].id
                                    }" onclick="editarTelefono('${
        telefonos[i].id
      }')"><img src="<?= base_url('img/edit.svg') ?>" title="Editar Telefono">
                                    <button class="btn" onclick="eliminarTel('${
                                      telefonos[i].id
                                    }')"><img src="<?= base_url('img/delete.svg') ?>" title="Eliminar Telefono">
                                </td>
                            </tr>`;
    }
  }
  $("#bodyTel").html(cadena);
}

// Funcion para mostrar correos en la tabla.
function guardarCorreo() {
  principal = correos.filter((correo) => correo.prioridad == "P");
  $("#email").val(principal[0]?.correo);
  var cadena;
  if (correos.length == 0) {
    cadena += ` <tr class="text-center">
                            <td colspan="3">NO HAY CORREOS</td>
                        </tr>`;
    $("#bodyCorre").html(cadena);
  } else {
    for (let i = 0; i < correos.length; i++) {
      cadena += ` <tr class="text-center" id='${correos[i].id}'>
                                <td>${correos[i].correo}</td>
                                <td id=${correos[i].prioridad} >${
        correos[i].prioridad == "S" ? "Secundaria" : "Principal"
      }</td>
                                <td>
                                    <button class="btn" onclick="editarCorreo('${
                                      correos[i].id
                                    }')"><img src="<?= base_url('img/edit.svg') ?>" title="Editar Correo">
                                    <button class="btn" onclick="eliminarCorreo('${
                                      correos[i].id
                                    }')"><img src="<?= base_url('img/delete.svg') ?>" title="Eliminar Correo">
                                </td>
                            </tr>`;
    }
  }
  $("#bodyCorre").html(cadena);
}

//Cambiar estado de "Activo" a "Inactivo"
function eliminarUsuario(id) {
  Swal.fire({
    title: "¿Desea eliminar este Usuario?",
    // text: "¡Esta acción puede causar errores!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: `${url}camEstUsuario`,
        data: {
          id,
          estado: "I",
        },
      }).done(function (data) {
        contadorUser = 0;
        mostrarMensaje("success", data);
        tableClientes.ajax.reload(null, false);
      });
    }
  });
}
