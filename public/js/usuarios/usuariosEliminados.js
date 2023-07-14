var contadorUser = 0;
var contador = 0;
var contadorCorreo = 0;
var inputIden = 0;
let telefonos = []; //Telefonos del usuario.
let correos = []; //Correos del usuario.
var validTel = true;
var validCorreo = true;
var validIdent = true;
var objCorreo = {
  id: 0,
  correo: "",
  prioridad: "",
};
var objTelefono = {
  id: 0,
  numero: "",
  tipo: "",
  prioridad: "",
};

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
  var column = tableUsuarios.column($(this).attr("data-column"));
  // Toggle the visibility
  column.visible(!column.visible());
});

// Tabla de usuarios
var tableUsuarios = $("#tableUsuarios").DataTable({
  ajax: {
    url: `${url}obtenerUsuarios`,
    method: "POST",
    data: {
      tipoUser: 2,
      estado: "I",
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
      data: "doc_res",
    },
    {
      data: "n_documento",
    },
    {
      data: "nombre_rol",
    },
    {
      data: null,
      render: function (data, type, row) {
        return (
          '<div class="d-flex gap-2 justify-content-center">' +
          '<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuario" onclick=seleccionarUsuario(' +
          data.id_usuario +
          ') title="Actualizar Contraseña"><i class="bi bi-eye"></i></button>' +
          '<button class="btn btn-outline-danger" onclick="restaurarUsuario(' +
          data.id_usuario +
          ')" title="Restaurar Usuario"><i class="bi bi-arrow-clockwise"></i></i></button></div>'
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
    $("#agregarTelefono").modal("hide");
    $("#agregarUsuario").modal("show");
  }
  if (accion == 4) {
    $("#agregarCorreo").modal("hide");
    $("#agregarUsuario").modal("show");
  }
}
//Insertar y editar Usuario
function seleccionarUsuario(id) {
  //Actualizar datos
  $.ajax({
    type: "POST",
    url: `${url}buscarUsuario/` + id + "/" + 0,
    dataType: "json",
  }).done(function (res) {
    limpiarCampos();
    $("#nombreP").val(res[0]["nombre_p"]);
    $("#nombreS").val(res[0]["nombre_s"]);
    $("#apellidoP").val(res[0]["apellido_p"]);
    $("#apellidoS").val(res[0]["apellido_s"]);
    $("#tipoDoc").val(res[0]["tipo_documento"]);
    $("#nIdenti").val(res[0]["n_documento"]);
    $("#rol").val(res[0]["id_rol"]);
    //   $("#FotoUsuario").text("Cambiar foto de Usuario:");
    $.ajax({
      type: "POST",
      url: `${url}obtenerTelefonosUser/${id}`,
      dataType: "json",
      success: function (data) {
        telefonos = data[0];
        guardarTelefono();
      },
    });
    $.ajax({
      type: "POST",
      url: `${url}obtenerEmailUser/${id}`,
      dataType: "json",
      success: function (data) {
        correos = data[0];
        guardarCorreo();
      },
    });
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
        telefonos[i].tipo == 4 ? "Celular" : "Fijo"
      }</td>
                                <td id=${telefonos[i].prioridad}>${
        telefonos[i].prioridad == "S" ? "Secundaria" : "Principal"
      }</td>  
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
      cadena += ` <tr class="text-center" id='c${correos[i].id}'>
                      <td>${correos[i].correo}</td>
                      <td id=${correos[i].prioridad} >${
        correos[i].prioridad == "S" ? "Secundaria" : "Principal"
      }</td>
                  </tr>`;
    }
  }
  $("#bodyCorre").html(cadena);
}
//Cambiar estado de "Inactivo" a "Activo"
function restaurarUsuario(id) {
  Swal.fire({
    title: "¿Desea restaurar este Usuario?",
    // text: "¡Esta acción puede causar errores!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Restaurar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: `${url}camEstUsuario`,
        data: {
          id,
          estado: "A",
        },
      }).done(function (data) {
        contadorUser = 0;
        mostrarMensaje("success", data);
        tableUsuarios.ajax.reload(null, false);
      });
    }
  });
}
