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
//Ver contraseñas
function verContrasena() {
  var password1, password2, check;
  password1 = document.getElementById("contra");
  password2 = document.getElementById("confirContra");
  check = document.getElementById("ver");
  if (check.checked == true) {
    // Si la checkbox de mostrar contraseña está activada
    password1.type = "text";
    password2.type = "text";
  } // Si no está activada
  else {
    password1.type = "password";
    password2.type = "password";
  }
}
//Ver contraseñas
function verContrasenaModal() {
  var check, passwordModal1, passwordModal2;
  passwordModal1 = document.getElementById("contraRes");
  passwordModal2 = document.getElementById("confirContraRes");
  check = document.getElementById("verModal");
  if (check.checked == true) {
    // Si la checkbox de mostrar contraseña está activada
    passwordModal1.type = "text";
    passwordModal2.type = "text";
  } // Si no está activada
  else {
    passwordModal1.type = "password";
    passwordModal2.type = "password";
  }
}
// Tabla de usuarios
var tableUsuarios = $("#tableUsuarios").DataTable({
  ajax: {
    url: `${url}obtenerUsuarios`,
    method: "POST",
    data: {
      tipoUser: 2,
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
          '<div class="d-flex gap-2 justify-content-center"><button class="btn btn-outline-primary" onclick="seleccionarUsuario(' +
          data.id_usuario +
          ' , 2 )" data-bs-target="#agregarUsuario" data-bs-toggle="modal" title="Editar Usuario"><i class="bi bi-pencil-square"></i></button>' +
          '<button class="btn btn-outline-danger" onclick="eliminarUsuario(' +
          data.id_usuario +
          ')" data-bs-toggle="modal" data-bs-target="#modalConfirmar" title="Eliminar Usuario"><i class="bi bi-trash3-fill"></i></button>' +
          '<button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#cambiarContra" data-bs-target="#staticBackdrop" onclick=$("#idUsuario").val(' +
          data.id_usuario +
          ') title="Actualizar Contraseña"><i class="bi bi-shield-lock-fill"></i></button></div>'
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
//Verificacion de contraseñas
function verifiContra(tipo, inputMsg, inputContra, inputConfir) {
  input = $(`#${inputMsg}`);
  contra = $(`#${inputContra}`).val();
  confirContra = $(`#${inputConfir}`).val();
  if (tipo == 2) {
    if (contra == "" && confirContra == "") {
      input.text("").removeClass().addClass("normal");
    } else if (contra == confirContra) {
      input.text("¡Contraseñas valida!").removeClass().addClass("valido");
    } else if (contra == "") {
      input.text("¡Ingrese una contraseña!").removeClass().addClass("normal");
    } else if (confirContra == "") {
      input.text("").removeClass().addClass("normal");
    } else if (contra != confirContra) {
      return input
        .text("¡Las contraseñas no coinciden!")
        .removeClass()
        .addClass("invalido");
    }
  } else {
    if (contra == "" && confirContra == "") {
      input.text("").removeClass().addClass("normal");
    } else if (contra == "" && confirContra) {
      input.text("¡Ingrese una contraseña!").removeClass().addClass("normal");
    } else if (confirContra == "") {
      input.text("").removeClass().addClass("normal");
    } else if (confirContra && contra == confirContra) {
      input.text("¡Contraseñas valida!").removeClass().addClass("valido");
    } else if (confirContra && contra != confirContra) {
      return input
        .text("¡Las contraseñas no coinciden!")
        .removeClass()
        .addClass("invalido");
    }
  }
}
$("#confirContra").on("input", function (e) {
  verifiContra(2, "msgConfir", "contra", "confirContra");
});
$("#contra").on("input", function (e) {
  verifiContra(1, "msgConfir", "contra", "confirContra");
});
$("#confirContraRes").on("input", function (e) {
  verifiContra(2, "msgConfirRes", "contraRes", "confirContraRes");
});
$("#contraRes").on("input", function (e) {
  verifiContra(1, "msgConfirRes", "contraRes", "confirContraRes");
});
//Insertar y editar Usuario
function seleccionarUsuario(id, tp) {
  if (tp == 2) {
    //Actualizar datos
    $.ajax({
      type: "POST",
      url: `${url}buscarUsuario/` + id + "/" + 0,
      dataType: "json",
    }).done(function (res) {
      limpiarCampos();
      $("#tituloModal").text("Editar");
      $("h1 i.bi-plus-lg")
        .removeClass("bi-plus-lg")
        .addClass("bi-pencil-square");
      $("#tp").val(2);
      $("#id").val(res[0]["id_usuario"]);
      $("#nombreP").val(res[0]["nombre_p"]);
      $("#nombreS").val(res[0]["nombre_s"]);
      $("#apellidoP").val(res[0]["apellido_p"]);
      $("#apellidoS").val(res[0]["apellido_s"]);
      $("#tipoDoc").val(1);
      $("#nIdenti").val(res[0]["n_documento"]);
      $("#rol").val(res[0]["id_rol"]);
      $("#contra").val("");
      $("#divContras").attr("hidden", "");
      $("#divContras2").attr("hidden", "");
      $("#confirContra").val("");
      $("#btnGuardar").text("Actualizar");
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
  } else {
    //Insertar datos
    telefonos = [];
    correos = [];
    limpiarCampos(0);
    guardarCorreo();
    guardarTelefono();
    $("#tituloModal").text("Agregar");
    $("h1 i.bi-pencil-square")
      .removeClass("bi-pencil-square")
      .addClass("bi-plus-lg");
    $("#tp").val(1);
    $("#id").val(0);
    $("#nombreP").val("");
    $("#nombreS").val("");
    $("#apellidoP").val("");
    $("#apellidoS").val("");
    $("#tipoDoc").val(1);
    $("#nIdenti").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#rol").val("");
    $("#contra").val("");
    $("#confirContra").val("");
    $("#divContras").removeAttr("hidden");
    $("#divContras2").removeAttr("hidden");
    $("#labelNom").text("Contraseña:");
    $("#btnGuardar").text("Agregar");
    $("#msgDoc").text("");
    $("#imgModal").attr("src", "");
  }
}
//Funcion para cambiar contraseña
$("#formularioContraseñas").on("submit", function (e) {
  e.preventDefault();
  $("#btnGuardar").attr("disabled", "");
  idUsuario = $("#idUsuario").val();
  contra = $("#contraRes").val();
  contraConfir = $("#confirContraRes").val();

  if ([contra, contraConfir].includes("") || contra != contraConfir) {
    return mostrarMensaje("error", "¡Hay campos vacios o invalidos!");
  } else {
    $.ajax({
      url: "",
      data: {
        idUsuario,
        contra,
        contraConfir,
      },
      type: "POST",
      dataType: "json",
    }).done(function (data) {
      $("#cambiarContra").modal("hide");
      tableUsuarios.ajax.reload(null, false); //Recargar tabla
      contadorUser = 0;
      limpiarCampos("msgConfirRes");
      if (data == 2) {
        return mostrarMensaje("error", "¡Ha ocurrido un error!");
      } else {
        return mostrarMensaje("success", "¡Se ha actualizado su contraseña!");
      }
    });
  }
});
//Funcion para buscar usuario segun su identificacion
function buscarUsuarioIdent(id, inputIden) {
  $.ajax({
    type: "POST",
    url: `${url}buscarUsuario/${id}/${inputIden}`,
    dataType: "JSON",
    success: function (res) {
      if (res[0] == null) {
        $("#msgDoc").text("");
        validIdent = true;
      } else if (res[0] != null) {
        $("#msgDoc").text("* Numero de identificación invalido *");
        validIdent = false;
      }
    },
  });
}
//Identificar si el numero de identificacion no este registrado
$("#nIdenti").on("input", function (e) {
  inputIden = $("#nIdenti").val();
  tp = $("#tp").val();
  id = $("#id").val();
  if (tp == 1 && id == 0) {
    buscarUsuarioIdent(0, inputIden);
  } else if (tp == 2 && id != 0) {
    $.ajax({
      type: "POST",
      url: `${url}buscarUsuario/${id}/${inputIden}`,
      dataType: "JSON",
      success: function (res) {
        if (res[0]["n_identificacion"] == inputIden) {
          $("#msgDoc").text("");
          validIdent = true;
        } else {
          buscarUsuarioIdent(0, inputIden);
        }
      },
    });
  }
});
//Envio de formulario
$("#formularioUsuarios").on("submit", function (e) {
  e.preventDefault();
  tp = $("#tp").val();
  $("#btnActuContra").attr("disabled", "");
  id = $("#id").val();
  nombreP = $("#nombreP").val();
  nombreS = $("#nombreS").val();
  apellidoP = $("#apellidoP").val();
  apellidoS = $("#apellidoS").val();
  tipoDoc = $("#tipoDoc").val();
  nIdenti = $("#nIdenti").val();
  telefono = $("#telefono").val();
  correo = $("#correo").val();
  rol = $("#rol").val();
  contra = $("#contra").val();
  confirContra = $("#confirContra").val();

  //Control de campos vacios
  if (
    [nombreP, apellidoP, apellidoS, tipoDoc, nIdenti, rol].includes("") ||
    contra != confirContra ||
    validIdent == false ||
    validCorreo == false
  ) {
    return mostrarMensaje("error", "¡Hay campos vacios o invalidos!");
  }
  // else if ([telefono, correo].includes("")) {
  //   return mostrarMensaje(
  //     "error",
  //     "¡Debe tener un telefono o correo principal!"
  //   );
  // }
  else {
    var formData = new FormData();
    formData.append("id", id);
    formData.append("tp", tp);
    formData.append("tipoUser", 2);
    formData.append("nombreP", nombreP);
    formData.append("nombreS", nombreS);
    formData.append("apellidoP", apellidoP);
    formData.append("apellidoS", apellidoS);
    formData.append("tipoDoc", tipoDoc);
    formData.append("nIdenti", nIdenti);
    formData.append("rol", rol);
    formData.append("contra", contra);
    // formData.append("foto", $("#foto")[0].files[0]);
    var idUserT = "";
    $.ajax({
      url: `${url}insertUsuario `,
      type: "POST",
      data: formData,
      dataType: "json",
      contentType: false, // Importante: desactiva el tipo de contenido predeterminado
      processData: false, // Importante: no proceses los datos
    }).done(function (data) {
      telefonos.forEach((tel) => {
        //Insertar Telefonos
        formData.append("tp", tp);
        formData.append("idUsuario", data);
        formData.append("idTele", tel.id);
        formData.append("numero", tel.numero);
        formData.append("prioridad", tel.prioridad);
        formData.append("tipoUsu", 7);
        formData.append("tipoTel", tel.tipo);
        $.ajax({
          url: "",
          type: "POST",
          data: formData,
          dataType: "json",
          contentType: false, // Importante: desactiva el tipo de contenido predeterminado
          processData: false, // Importante: no proceses los datos
          success: function (res) {
            if (res != 1) {
              mostrarMensaje("error", "¡Ha ocurrido un error!");
            }
          },
        });
      });
      correos.forEach((correo) => {
        //Insertar Correos
        formData.append("tp", tp);
        formData.append("idUsuario", data);
        formData.append("idCorreo", correo.id);
        formData.append("correo", correo.correo);
        formData.append("prioridad", correo.prioridad);
        formData.append("tipoUsu", 7);
        $.ajax({
          url: "",
          type: "POST",
          data: formData,
          dataType: "json",
          contentType: false, // Importante: desactiva el tipo de contenido predeterminado
          processData: false, // Importante: no proceses los datos
          success: function (res) {
            if (res != 1) {
              mostrarMensaje("error", "¡Ha ocurrido un error!");
              setTimeout(
                () => (window.location.href = "<?= base_url('usuarios') ?>"),
                2000
              );
            }
          },
        });
      });
      if (tp == 2) {
        mostrarMensaje("success", "¡Se ha Actualizado el Usuario!");
        validTel = true;
        validCorreo = true;
      } else {
        validTel = true;
        validCorreo = true;
        mostrarMensaje("success", "¡Se ha Registrado el Usuario!");
      }
      limpiarCampos();
      $("#agregarUsuario").modal("hide");
      tableUsuarios.ajax.reload(null, false); //Recargar tabla
      contadorUser = 0;
      $("#btnGuardar").removeAttr("disabled");
      $("#btnActuContra").removeAttr("disabled");
      $("#editTele").val("");
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
    });
  }
});
// Agregar Telefono a la tabla
$("#btnAddTel").on("click", function (e) {
  const numero = $("#telefonoAdd").val();
  const tipo = $("#tipoTele").val();
  const prioridad = $("#prioridad").val();
  const editTel = $("#editTele").val();

  const regex = /^\d{10,10}$/;
  if (!regex.test(parseInt(numero))) {
    return mostrarMensaje("error", "¡Telefono invalido!");
  }

  if ([numero, prioridad].includes("") || validTel == false) {
    return mostrarMensaje("error", "¡Hay campos vacios o invalidos!");
  }
  contador += 1;
  let info = {
    id:
      [editTel].includes("") || editTel == 0 ? `${(contador += 1)}e` : editTel,
    tipo,
    numero,
    prioridad,
  };
  let filtro = telefonos.filter((tel) => tel.prioridad == "P");
  let filtroTel = telefonos.filter((tel) => tel.numero == info.numero);

  if (filtroTel.length > 0) {
    filtro = [];
    $("#btnEditarTel").removeAttr("disabled");
    return mostrarMensaje("error", "¡Ya se agrego este numero de telefono!");
  }
  if (info.prioridad == "S") {
    telefonos.push(info);
    $("#telefonoAdd").val("");
    $("#tipoTele").val("");
    $("#prioridad").val("");
    $("#editTele").val(0);
    objTelefono = {
      id: 0,
      numero: "",
      tipo: "",
      prioridad: "",
    };
    return guardarTelefono();
  } else if (filtro.length > 0) {
    filtro = [];
    return mostrarMensaje("error", "¡Ya hay un telefono prioritario!");
  } else {
    $("#btnEditarTel").removeAttr("disabled");
    telefonos.push(info);
    $("#telefonoAdd").val("");
    $("#tipoTele").val("");
    $("#prioridad").val("");
    $("#editTele").val(0);
    objTelefono = {
      id: 0,
      numero: "",
      tipo: "",
      prioridad: "",
    };
    return guardarTelefono();
  }
});
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
//Al escribir validar que el numero no este registrado
$("#telefonoAdd").on("input", function (e) {
  numero = $("#telefonoAdd").val();
  buscarCorreoTel("telefonos/buscarTelefono/", numero, "msgTel", "telefono");
});
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
//Editar Telefono
function editarTelefono(id) {
  const fila = $(`#${id}`);
  const numero = fila.find("td").eq(0);
  const tipo = fila.find("td").eq(1);
  const prioridad = fila.find("td").eq(2);
  $("#telefonoAdd").val(numero.text());
  $("#tipoTele").val(tipo.attr("id"));
  $("#prioridad").val(prioridad.attr("id"));
  $("#editTele").val(fila.attr("id"));
  objTelefono = {
    id: fila.attr("id"),
    numero: numero.text(),
    tipo: tipo.attr("id"),
    prioridad: prioridad.attr("id"),
  };
  telefonos = telefonos.filter((tel) => tel.id != fila.attr("id"));
  guardarTelefono();
}
//Eliminar telefono de la tabla
function eliminarTel(id) {
  tp = $("#tp").val();
  if (tp == 2) {
    // Consulta tipo delete
    $.ajax({
      url: "" + id,
      type: "POST",
      dataType: "json",
      success: function (data) {
        if (data == 1) {
          return mostrarMensaje("success", "¡Se ha eliminado el telefono!");
        }
      },
    });
  }
  telefonos = telefonos.filter((tel) => tel.id != id);
  guardarTelefono(); //Actualizar tabla
}
//Agregar Correo a la tabla
$("#btnAddCorre").on("click", function (e) {
  const tp = $("#tp").val();
  const correo = $("#correoAdd").val();
  const prioridad = $("#prioridadCorreo").val();
  const editCorreo = $("#editCorreo").val();

  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!regex.test(correo)) {
    validCorreo = false;
    return mostrarMensaje("error", "¡Tipo de correo invalido!");
  }

  if ([correo, prioridad].includes("") || validCorreo == false) {
    return mostrarMensaje("error", "¡Hay campos vacios!");
  }
  let info = {
    id:
      [editCorreo].includes("") || editCorreo == 0
        ? `${(contador += 1)}e`
        : editCorreo,
    correo,
    prioridad,
  };
  let filtro = correos.filter((correo) => correo.prioridad == "P");
  let filtroCorreo = correos.filter((correo) => correo.correo == info.correo);

  if (filtroCorreo.length > 0) {
    filtro = [];
    return mostrarMensaje("error", "¡Ya se agrego este correo!");
  }
  if (info.prioridad == "S") {
    correos.push(info);
    $("#correoAdd").val("");
    $("#prioridadCorreo").val("");
    $("#editCorreo").val(0);
    objCorreo = {
      id: 0,
      correo: "",
      prioridad: "",
    };
    return guardarCorreo();
  } else if (filtro.length > 0) {
    filtro = [];
    return mostrarMensaje("error", "¡Ya hay un correo prioritario!");
  } else {
    correos.push(info);
    $("#correoAdd").val("");
    $("#prioridadCorreo").val("");
    $("#editCorreo").val(0);
    objCorreo = {
      id: 0,
      correo: "",
      prioridad: "",
    };
    return guardarCorreo();
  }
});
//Al escribir validar que el correo no este registrado
$("#correoAdd").on("input", function (e) {
  correo = $("#correoAdd").val();
  buscarCorreoTel("email/buscarEmail/", correo, "msgCorreo", "correo");
});
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
//Editar Correo
function editarCorreo(id) {
  const fila = $(`#${id}`);
  const correo = fila.find("td").eq(0);
  const prioridad = fila.find("td").eq(1);
  $("#correoAdd").val(correo.text());
  $("#prioridadCorreo").val(prioridad.attr("id"));
  $("#editCorreo").val(fila.attr("id"));
  objCorreo = {
    id: fila.attr("id"),
    correo: correo.text(),
    prioridad: prioridad.attr("id"),
  };
  correos = correos.filter((correo) => correo.id != fila.attr("id"));
  guardarCorreo();
}
//Eliminar correo de la tabla
function eliminarCorreo(id) {
  tp = $("#tp").val();
  if (tp == 2) {
    // Consulta tipo delete
    $.ajax({
      url: "" + id,
      type: "POST",
      dataType: "json",
      success: function (data) {
        if (data == 1) {
          mostrarMensaje("success", "¡Se ha eliminado el correo!");
        }
      },
    });
  }
  correos = correos.filter((correo) => correo.id != id);
  guardarCorreo(); //Actualizar tabla
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
        tableUsuarios.ajax.reload(null, false);
      });
    }
  });
}
