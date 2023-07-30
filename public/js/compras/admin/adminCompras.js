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
      estado: 0,
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
      data: "comprador",
    },
    {
      data: "direccion",
    },
    {
      data: "numProductos",
    },
    {
      data: "fecha_compra",
    },
    {
      data: null,
      render: function (data, type, row) {
        return `<b class="fw-bold ${estiloEstado[row.nombreEstado]}">${
          estadosCompra[row.estado]
        }</b>`;
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
                    [estadosCompra[row.estado]].includes("Pendiente")
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

        $("#btnActualizar").attr("hidden", "");
        $("#tituloModal").text(`Detalles de Compra - ${id}`);
        $("#totalCompra").val(
          data[0].totalCompra.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
        $("#fecha").val(data[0].fecha_compra);
        $("#hora").val(data[0].hora_compra);
        $("#estado").val(`${estadosCompra[data[0].estado]}`);

        for (let i = 0; i < data.length; i++) {
          cadena += `
          <tr class="text-center">
          <td class="text-capitalize">${data[i].nombre}</td>
            <td>${
              data[i].cantidad
            } <small class="text-secondary">c/u</small></td>
            <td>${formatearCantidad(data[i].precio)}</td>
            <td>${formatearCantidad(data[i].subtotal)}</td>
            <td>
                <button class="btn btn-outline-success">Confirmar</button>
                <button class="btn btn-outline-danger">Declinar</button>
            </td>
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
        $("#btnActualizar").removeAttr("hidden");

        var cadena = "";
        let numProductos = 0;

        $("#tituloModal").text(`Detalles de Compra - ${id}`);
        $("#totalCompra").val(
          data[0].totalCompra.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        );
        $("#fecha").val(data[0].fecha_compra);
        $("#hora").val(data[0].hora_compra);
        $("#estado").val(`${estadosCompra[data[0].estado]}`);

        for (let i = 0; i < data.length; i++) {
          cadena += `
            <tr class="text-center" id="${data[i].id_compra_det}">
              <td class="text-capitalize">
                ${data[i].nombre}
              </td>
              <td> 
                <input class="text-center" value="${
                  data[i].cantidad
                }" type="number">
              </td>
              <td>
                <input class="text-center" id="precio" value="${
                  data[i].precio
                }" type="number" hidden>
                ${formatearCantidad(data[i].precio)}
              </td>
              <td>
                ${formatearCantidad(data[i].subtotal)}
              </td>
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
    if (respon.isConfirmed) {
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
    }
  });
}

$("#btnActualizar").click(function (e) {
  e.preventDefault();
  for (let i = 0; i < $("#bodyTel tr").length; i++) {
    id = $("#bodyTel tr")[i].id;

    const fila = $("#bodyTel tr").eq(i);
    const cantidad = fila.find('input[type="number"]').val();
    const precio = fila.find('input[id="precio"]').val();

    $.ajax({
      url: `${url}actuaDetCompra`,
      type: "POST",
      dataType: "json",
      data: {
        id,
        cantidad,
        precio,
      },
      success: function (data) {
        tableCompras.ajax.reload(null, false);
        if (data == 1) {
          return mostrarMensaje("success", "¡Su compra ha sido actualizada!");
        } else {
          return mostrarMensaje("error", "¡Ha ocurrido un error!");
        }
      },
    });
  }
});
