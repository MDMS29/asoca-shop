contadorUser = 0;
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
        contadorUser = contadorUser + 1;
        return "<b>" + contadorUser + "</b>";
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
      data: "cantidad",
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
          ' , 2 )" data-bs-target="#agregarUsuario" data-bs-toggle="modal" title="Editar Usuario"><i class="bi bi-pencil-square"></i></button>' +
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
      success: function(res){
        
      }
    });
  } else {
  }
}

$("#formularioProductos").submit(function (e) {
  e.preventDefault();
});
