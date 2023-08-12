var contadorUser = 0;
let telefonos = []; //Telefonos del usuario.
let correos = []; //Correos del usuario.

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
      tipoUser: 4,
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
      data: "departamento",
    },
    {
      data: "municipio",
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<div class="d-flex gap-2 justify-content-center">
            <button class="btn btn-outline-primary" onclick="buscarCorreoTel(${data.id_usuario}, 'obtenerTelefonosUser', 1)" data-bs-toggle="modal" data-bs-target="#verTelefonos" title="Ver Telefonos"><i class="bi bi-telephone"></i></button>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#verCorreos" data-bs-target="#staticBackdrop" onclick="buscarCorreoTel(${data.id_usuario}, 'obtenerEmailUser', 2)" title="Ver Correos"><i class="bi bi-envelope-at"></i></button>
          </div>`;
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<div class="d-flex gap-2 justify-content-center">
          <button class="btn btn-outline-danger" onclick="banearCliente(${data.id_usuario}, '${data.nombre_p} ${data.apellido_p}')" title="Banear Usuario"><i class="bi bi-x-circle"></i></button>
          <button class="btn btn-outline-warning" onclick="restaurarContrasena(${data.id_usuario}, '${data.nombre_p} ${data.apellido_p}')" title="Restaurar Contraseña"><i class="bi bi-person-lock"></i></button></div>`;
      },
    },
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  },
});
//Limpiar campos de telefonos y correos
function limpiarCampos(accion) {
  if (accion == 3) {
    telefonos = [];
  }
  if (accion == 4) {
    correos = [];
  }
}
//Funcion para buscar el correo o el telefono
function buscarCorreoTel(id, ruta, tipo) {
  $.ajax({
    type: "POST",
    url: `${url}${ruta}/${id}`, //url, valor, idUsuario, tipoUsuario
    dataType: "JSON",
    success: function (res) {
      switch (tipo) {
        case 1:
          telefonos.push(...res[0]);
          guardarTelefono();
          break;

        default:
          correos.push(...res[0]);
          guardarCorreo();
          break;
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
                            </tr>`;
    }
  }
  $("#bodyCorre").html(cadena);
}
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});
//Cambiar estado de "Activo" a "Inactivo"
function banearCliente(id, nombre) {
  Swal.fire({
    title: `¿Desea banear el usuario "${nombre}?"`,
    text: "¡Está acción puede generar errores!",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí",
  }).then((respon) => {
    if (respon.isConfirmed) {
      Swal.fire({
        title: `¡Ingrese el numero de días!`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        input: "number",
        preConfirm: (time) => {
          var fechaActual = new Date();
          fechaActual.setDate(fechaActual.getDate() + Number(time));
          var fechaISO = fechaActual.toISOString().split("T")[0];
          $.ajax({
            url: `${url}camEstUsuario`,
            type: "POST",
            dataType: "json",
            data: {
              id,
              estado: "B",
              tiempo: fechaISO,
            },
            success: function (res) {
              if (res == 1) {
                contadorUser = 0;
                tableClientes.ajax.reload(null, false);
                Toast.fire({
                  icon: `success`,
                  title: `¡Se ha baneado el usuario "${nombre}" por ${time} días!`,
                });
                return res;
              }
            },
          });
        },
        showCancelButton: true,
      }).then((respon) => {
        if (respon.value == "1") {
          if (respon.isConfirmed) {
            return 1;
          }
        }
      });
    }
  });
}
//
function restaurarContrasena(idUsuario, nombre) {
  Swal.fire({
    title: `¿Desea restaurar la contraseña de ${nombre}?"`,
    text: "¡Está acción puede generar errores!",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Restaurar",
  }).then((respon) => {
    if (respon.value) {
      $.ajax({
        url: `${url}camContraUser`,
        data: {
          idUsuario,
          contra: "",
          contraConfir: "",
        },
        type: "POST",
        dataType: "json",
      }).done(function (data) {
        tableClientes.ajax.reload(null, false); //Recargar tabla
        contadorUser = 0;
        if (data == 2) {
          return mostrarMensaje("error", "¡Ha ocurrido un error!");
        } else {
          return Toast.fire({
            icon: `success`,
            title: "¡Contraseña restaurada!",
          });
        }
      });
    }
  });
}
