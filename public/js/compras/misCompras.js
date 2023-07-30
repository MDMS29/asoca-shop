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
  var column = tableCompras.column($(this).attr("data-column"));
  // Toggle the visibility
  column.visible(!column.visible());
});
// Tabla de compras
var tableCompras = $("#tableCompras").DataTable({
  ajax: {
    url: `${url}obtenerComprasRealizadas`,
    method: "POST",
    data: {
      estado: "A",
    },
    dataSrc: "",
  },
  columns: [
    {
      data: "id_compra_enc",
      render: function (data, type, row) {
        return "<b>" + row.id_compra_enc + "</b>";
      },
    },
    {
      data: "numProductos",
    },
    {
      data: "fecha_compra",
    },
    {
      data: "hora_compra",
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<b class="fw-bold ${
          row.estado == "P"
            ? "text-warning"
            : row.estado == "D"
            ? "text-danger"
            : "text-success"
        }">
            ${
              row.estado == "P"
                ? "Pendiente"
                : row.estado == "D"
                ? "Denegado"
                : "Confirmado"
            }
            </b>`;
      },
    },
    {
      data: "subtotal",
      render: function (data, type, row) {
        return formatearCantidad(row.subtotal);
      },
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<div class="d-flex gap-2 justify-content-center">
                  <button class="btn btn-outline-primary" onclick="seleccionarCompra(${
                    data.id_compra_enc
                  }, 1)" data-bs-target="#detallesModal" data-bs-toggle="modal" title="Ver Detalles"><i class="bi bi-eye"></i></button>
                  ${
                    row.estado == "P"
                      ? `
                    <button class="btn btn-outline-warning" data-bs-target="#detallesModal" data-bs-toggle="modal"  onclick="seleccionarCompra(${data.id_compra_enc}, 2)" title="Editar Compra"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-outline-danger"  onclick="cancelarCompra(${data.id_compra_enc})" title="Cancelar Compra"><i class="bi bi-x-circle"></i></button>
                      `
                      : ""
                  }
                </div>`;
      },
    },
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  },
});

function seleccionarCompra(id, tp) {
  if (tp == 1) {
    $.ajax({
      url: `${url}detallesCompra`,
      type: "POST",
      dataType: "json",
      data: {
        id,
      },
      success: function (data) {
        var cadena = "";
        let numProductos = 0;

        $("#tituloModal").text(`Detalles de Compra - ${id}`);
        $("#totalCompra").val(
          data[0].totalCompra.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
        $("#fecha").val(data[0].fecha_compra);
        $("#hora").val(data[0].hora_compra);
        let estado =
          data[0].estado == "P"
            ? "Pendiente"
            : data[0].estado == "D"
            ? "Denegado"
            : "Confirmado";
        $("#estado").val(estado);

        for (let i = 0; i < data.length; i++) {
          cadena += `
          <tr class="text-center">
          <td class="text-capitalize">${data[i].nombre}</td>
            <td>${
              data[i].cantidad
            } <small class="text-secondary">c/u</small></td>
            <td>${formatearCantidad(data[i].precio)}</td>
            <td>${formatearCantidad(data[i].subtotal)}</td>
            </tr>
            `;
          numProductos = Number(data[i].cantidad) + numProductos;
        }
        $("#bodyTel").html(cadena);
        $("#nProduc").val(numProductos);
      },
    });
  } else {
    $.ajax({
      url: `${url}detallesCompra`,
      type: "POST",
      dataType: "json",
      data: {
        id,
      },
      success: function (data) {
        var cadena = "";
        let numProductos = 0;

        $("#tituloModal").text(`Detalles de Compra - ${id}`);
        $("#totalCompra").val(
          data[0].totalCompra.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
        $("#fecha").val(data[0].fecha_compra);
        $("#hora").val(data[0].hora_compra);
        let estado =
          data[0].estado == "P"
            ? "Pendiente"
            : data[0].estado == "D"
            ? "Denegado"
            : "Confirmado";
        $("#estado").val(estado);

        for (let i = 0; i < data.length; i++) {
          cadena += `
          <tr class="text-center">
          <td class="text-capitalize">${data[i].nombre}</td>
            <td> <input value="${data[i].cantidad}" type="number"></td>
            <td>${formatearCantidad(data[i].precio)}</td>
            <td>${formatearCantidad(data[i].subtotal)}</td>
            </tr>
            `;
          numProductos = Number(data[i].cantidad) + numProductos;
        }
        $("#bodyTel").html(cadena);
        $("#nProduc").val(numProductos);
      },
    });
  }
}

function cancelarCompra(id) {
  Swal.fire({
    title: `¿Desea cancelar esta compra?"`,
    text: "¡Al eliminarla no podrá recuperarla!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí",
    showCancelButton: true,
  }).then((respon) => {
    $.ajax({
      url: `${url}cancelCompra`,
      type: "POST",
      dataType: "json",
      data: {
        id,
      },
      success: function (res) {
        if (res == 1) {
          mostrarMensaje("success", "¡Su compra ha sido cancelada!");
          tableCompras.ajax.reload(null, false);
        } else {
          return mostrarMensaje("error", "¡Ha ocurrido un error!");
        }
      },
    });
  });
}
