contadorProd = 0;
// Tabla de usuarios
var tableProductos = $("#tableProductos").DataTable({
  ajax: {
    url: `${url}obtenerProductos`,
    method: "POST",
    data: {
      estado: "A",
    },
    dataSrc: "",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row) {
        contadorProd = contadorProd + 1;
        return "<b>" + contadorProd + "</b>";
      },
    },
    {
      data: "nombre",
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<div style="max-width: 300px !important;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><span>${row.descripcion}</span></div>`;
      },
    },
    {
      data: "cantidad_actual",
    },
    {
      data: null,
      render: function (data, type, row) {
        return formatearCantidad(row.precio);
      },
    },
    {
      data: "fecha_public",
    },
    {
      data: "valoracion",
    },
    {
      data: "nomCreador",
    },
    {
      data: null,
      render: function (data, type, row) {
        return (
          '<div class="d-flex gap-2 justify-content-center"><button class="btn btn-outline-primary" onclick="seleccionarProducto(' +
          data.id_producto +
          ',2)" data-bs-target="#agregarProducto" data-bs-toggle="modal" title="Editar Usuario"><i class="bi bi-pencil-square"></i></button>' +
          '<button class="btn btn-outline-danger" onclick="eliminarUsuario(' +
          data.id_producto +
          ')" data-bs-toggle="modal" data-bs-target="#modalConfirmar" title="Eliminar Usuario"><i class="bi bi-trash3-fill"></i></button></div>'
        );
      },
    },
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  },
});

function seleccionarProducto(id, tp) {
  if (tp == 2) {
    $.ajax({
      url: `${url}buscarProducto`,
      type: "POST",
      dataType: "json",
      data: {
        id,
      },
      success: function (res) {
        $("#tituloModal").text("Editar");
        $("h1 i.bi-plus-lg")
          .removeClass("bi-plus-lg")
          .addClass("bi-pencil-square");
        $("#id").val(id);
        $("#tp").val(tp);
        $("#nombre").val(res[0]["nombre"]);
        $("#descripcion").val(res[0]["descripcion"]);
        $("#precio").val(res[0]["precio"]);
        $("#cantidad").val(res[0]["cantidad_actual"]);
        $("#fecha").val(res[0]["fecha_public"]);
        $("#btnGuardar").text("Actualizar");
      },
    });
  } else {
    $("#tituloModal").text("Agregar");
    $("h1 i.bi-pencil-square")
      .removeClass("bi-pencil-square")
      .addClass("bi-plus-lg");
    $("#id").val(id);
    $("#tp").val(tp);
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#precio").val("");
    $("#cantidad").val("");
    $("#fecha").val("");
    $("#btnGuardar").text("Agregar");
  }
}

$("#formularioProductos").submit(function (e) {
  e.preventDefault();
  id = $("#id").val();
  tp = $("#tp").val();
  nombre = $("#nombre").val();
  descripcion = $("#descripcion").val();
  precio = $("#precio").val();
  cantidad = $("#cantidad").val();
  fecha = $("#fecha").val();
  if ([nombre, descripcion, precio, cantidad].includes("")) {
    return mostrarMensaje("error", "¡Hay campos vacios!");
  }else{
    $.ajax({
      url : `${url}insertarProducto`,
      type : 'POST',
      dataType : 'json',
      data : {
        id,tp,nombre,descripcion,precio,cantidad
      },
      success : function(res){
        tableProductos.ajax.reload(null, false);
        contadorProd = 0
        if(tp == 2){
          if(res == 1){
            $('#agregarProducto').modal('hide')
            return mostrarMensaje('success', '¡Se ha actualizado el producto!')
          }else{
            return mostrarMensaje('error', '¡Ha ocurrido un error!')
          }
        }else{
          if(res == 1){
            $('#agregarProducto').modal('hide')
            return mostrarMensaje('success', '¡Se ha agregado el producto!')
          }else{
            return mostrarMensaje('error', '¡Ha ocurrido un error!')
          }
        }
      }
    })
  }
});
