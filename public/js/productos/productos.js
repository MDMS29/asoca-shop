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
// Tabla de productos
var tableProductos = $("#tableProductos").DataTable({
  ajax: {
    url: `${url}obtenerProductos`,
    method: "POST",
    data: {
      estado: "A",
    },
    dataSrc: "",
  },
  order: [0, 'asc'],
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
      data: "categoria",
      render: function (data, type, row) {
        return `<span class="text-capitalize">${row.categoria}</span>`;
      },
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
          '<button class="btn btn-outline-danger" onclick="eliminarProducto(' +
          data.id_producto +
          ')" title="Eliminar Producto"><i class="bi bi-trash3-fill"></i></button></div>'
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
        $("#nombreEdit").val(res[0]["nombre"]);
        $("#categoria").val(res[0]["categoria"]);
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
    $("#nombreEdit").val("");
    $("#categoria").val("");
    $("#descripcion").val("");
    $("#precio").val("");
    $("#cantidad").val("");
    $("#fecha").val("");
    $("#btnGuardar").text("Agregar");
  }
}

$("#nombre").on("input", function (e) {
  e.preventDefault();
  nombre = $("#nombre").val();
  nombreEdit = $("#nombreEdit").val();
  $.ajax({
    url: `${url}buscarProducto`,
    type: "POST",
    dataType: "json",
    data: {
      nombre,
    },
    success: function (res) {
      if (res.length == 0 || nombre == nombreEdit) {
        $("#msgNombre").text("");
        validProduc = true;
      } else {
        validProduc = false;
        $("#msgNombre").text(" * Este producto ya existe * ");
      }
    },
  });
});

$("#formularioProductos").submit(function (e) {
  e.preventDefault();
  id = $("#id").val();
  tp = $("#tp").val();
  nombre = $("#nombre").val();
  categoria = $("#categoria").val();
  descripcion = $("#descripcion").val();
  precio = $("#precio").val();
  cantidad = $("#cantidad").val();
  fecha = $("#fecha").val();
  if ([nombre, categoria, descripcion, precio, cantidad].includes("") || !validProduc) {
    return mostrarMensaje("error", "¡Hay campos vacios o invalidos!");
  } else {
    var formData = new FormData();
    formData.append("id", id);
    formData.append("tp", tp);
    formData.append("nombre", nombre);
    formData.append("categoria", categoria);
    formData.append("descripcion", descripcion);
    formData.append("precio", precio);
    formData.append("cantidad", cantidad);
    formData.append("fecha", fecha);
    formData.append("foto", $("#fileInput")[0].files[0]);
    formData.append("foto1", $("#fileInput1")[0].files[0]);
    formData.append("foto2", $("#fileInput2")[0].files[0]);

    $.ajax({
      url: `${url}insertarProducto`,
      type: "POST",
      dataType: "json",
      data: formData,
      dataType: "json",
      contentType: false, // Importante: desactiva el tipo de contenido predeterminado
      processData: false, // Importante: no proceses los datos
      success: function (res) {
        tableProductos.ajax.reload(null, false);
        contadorProd = 0;
        if (tp == 2) {
          if (res == 1) {
            $("#agregarProducto").modal("hide");
            return mostrarMensaje("success", "¡Se ha actualizado el producto!");
          } else {
            return mostrarMensaje("error", "¡Ha ocurrido un error!");
          }
        } else {
          if (res == 1) {
            $("#agregarProducto").modal("hide");
            return mostrarMensaje("success", "¡Se ha agregado el producto!");
          } else {
            return mostrarMensaje("error", "¡Ha ocurrido un error!");
          }
        }
      },
    });
  }
});

function eliminarProducto(id) {
  Swal.fire({
    title: "¿Desea eliminar este Producto?",
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
        url: `${url}camEstProducto`,
        data: {
          id,
          estado: "I",
        },
      }).done(function (data) {
        contadorProd = 0;
        mostrarMensaje("success", data);
        tableProductos.ajax.reload(null, false);
      });
    }
  });
}

// Agregar evento change al elemento de entrada de archivo
$("#prev-img #fileInput").on('change', function (e) {
  const file = e.target.files[0];
  console.log(e.target)
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $(`#previewImage`).attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
  }
})
$("#prev-img #fileInput1").on('change', function (e) {
  const file = e.target.files[0];
  console.log(e.target)
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $(`#previewImage1`).attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
  }
})
$("#prev-img #fileInput2").on('change', function (e) {
  const file = e.target.files[0];
  console.log(e.target)
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $(`#previewImage2`).attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
  }
})
