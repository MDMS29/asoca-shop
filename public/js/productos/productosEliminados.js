contadorProd = 0;
var validProduc = true;

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
  var column = tableProductos.column($(this).attr("data-column"));
  // Toggle the visibility
  column.visible(!column.visible());
});

// Tabla de usuarios
var tableProductos = $("#tableProductos").DataTable({
  ajax: {
    url: `${url}obtenerProductos`,
    method: "POST",
    data: {
      estado: "I",
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
          '<div class="d-flex gap-2 justify-content-center">' +
          '<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#agregarProducto" onclick=seleccionarProducto(' +
          data.id_producto +
          ') title="Ver Producto"><i class="bi bi-eye"></i></button>' +
          '<button class="btn btn-outline-danger" onclick="restaurarProducto(' +
          data.id_producto +
          ')" title="Restaurar Producto"><i class="bi bi-arrow-clockwise"></i></i></button></div>'
        );
      },
    },
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  },
});

function seleccionarProducto(id) {
  $.ajax({
    url: `${url}buscarProducto`,
    type: "POST",
    dataType: "json",
    data: {
      id,
    },
    success: function (res) {
      $("#id").val(id);
      $("#tp").val(tp);
      $("#nombre").val(res[0]["nombre"]);
      $("#nombreEdit").val(res[0]["nombre"]);
      $("#descripcion").val(res[0]["descripcion"]);
      $("#precio").val(res[0]["precio"]);
      $("#cantidad").val(res[0]["cantidad_actual"]);
      $("#fecha").val(res[0]["fecha_public"]);
    },
  });
}

function restaurarProducto(id) {
  Swal.fire({
    title: "¿Desea restaurar este Producto?",
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
        url: `${url}camEstProducto`,
        data: {
          id,
          estado: "A",
        },
      }).done(function (data) {
        contadorProd = 0;
        mostrarMensaje("success", data);
        tableProductos.ajax.reload(null, false);
      });
    }
  });
}
