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
        return `<b class="fw-bold ${estiloEstado[row.nombreEstado]}">${estadosCompra[row.estado]
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
                  <button class="btn btn-outline-primary" onclick="seleccionarCompra(${data.id_compra_enc
          }, 1)" data-bs-target="#detallesModal" data-bs-toggle="modal" title="Detalle Compra"><i class="bi bi-clipboard2-check"></i></button>
                 
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
        $("#idCompra").val(id)
        var cadena = "";
        let numProductos = 0;
        var subtotal = 0;
        // $("#btnConfirmar")
        $("#tituloModal").text(`Detalles de Compra - ${id}`);
        $("#fecha").val(data[0].fecha_compra);
        $("#hora").val(data[0].hora_compra);
        $("#estado").val(`${estadosCompra[data[0].estado]}`);

        for (let i = 0; i < data.length; i++) {
          cadena += `
          <tr class="text-center">
          <td class="text-capitalize">${data[i].nombre}</td>
            <td>${data[i].cantidad
            } <small class="text-secondary">c/u</small></td>
            <td>${formatearCantidad(data[i].precio)}</td>
            <td>${formatearCantidad(data[i].subtotal)}</td>
            <td>
              ${data[i].estadoPro == 5
              ?
              '<button disabled class="btn btn-outline-success">Confirmado</button>'
              : data[i].estadoPro == 6
                ? '<button disabled class="btn btn-outline-danger" >Denegado</button>'
                :
                `<button id="${data[i].id_compra_det}" ${data[i].estadoPro !== 'A' && 'disabled'} class="btn btn-outline-success" onclick="confirProduc(${data[i].id_compra_det}, 5, '${data[i].nombre}')">Confirmar</button>
                <button id="${data[i].id_compra_det}" ${data[i].estadoPro !== 'A' && 'disabled'} class="btn btn-outline-danger" onclick="confirProduc(${data[i].id_compra_det}, 6, '${data[i].nombre}')">Denegar</button>`}
              
            </td>
            </tr>
            `;
          numProductos = Number(data[i].cantidad) + numProductos;
          subtotal = Number(subtotal) + Number(data[i].subtotal)
        }
        $("#totalCompra").val(subtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $("#bodyTel").html(cadena);
        $("#nProduc").val(numProductos);
      },
    });
  }
  //  else {
  //   $.ajax({
  //     url: `${url}detallesCompra`,
  //     type: "POST",
  //     dataType: "json",
  //     data: {
  //       id,
  //     },
  //     success: function (data) {
  //       $("#btnActualizar").removeAttr("hidden");

  //       var cadena = "";
  //       let numProductos = 0;

  //       $("#tituloModal").text(`Detalles de Compra - ${id}`);
  //       $("#totalCompra").val(
  //         data[0].totalCompra.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
  //       );
  //       $("#fecha").val(data[0].fecha_compra);
  //       $("#hora").val(data[0].hora_compra);
  //       $("#estado").val(`${estadosCompra[data[0].estado]}`);

  //       for (let i = 0; i < data.length; i++) {
  //         cadena += `
  //           <tr class="text-center" id="${data[i].id_compra_det}">
  //             <td class="text-capitalize">
  //               ${data[i].nombre}
  //             </td>
  //             <td> 
  //               <input class="text-center" value="${data[i].cantidad
  //           }" type="number">
  //             </td>
  //             <td>
  //               <input class="text-center" id="precio" value="${data[i].precio
  //           }" type="number" hidden>
  //               ${formatearCantidad(data[i].precio)}
  //             </td>
  //             <td>
  //               ${formatearCantidad(data[i].subtotal)}
  //             </td>
  //           </tr>
  //         `;
  //         numProductos = Number(data[i].cantidad) + numProductos;
  //       }
  //       $("#bodyTel").html(cadena);
  //       $("#nProduc").val(numProductos);
  //     },
  //   });
  // }
}


var productosConfirmar = [];

function confirProduc(id, estado, nombre) {
  if (id !== null || estado !== null) {
    const objConfirmar = {
      id, estado, nombre
    }
    if (estado == 5) {
      $(`#${id}.btn-outline-success`).text('CONFIRMADO')
      $(`#${id}.btn-outline-success`).attr('disabled', '')
      $(`#${id}.btn-outline-danger`).attr('hidden', '')
      console.log(estado)
    } else {
      $(`#${id}.btn-outline-danger`).text('DENEGADO')
      $(`#${id}.btn-outline-danger`).attr('disabled', '')
      $(`#${id}.btn-outline-success`).attr('hidden', '')
    }
    productosConfirmar.push(objConfirmar)
  }
}

$("#btnConfirmar").click(function (e) {
  e.preventDefault();
  idEnc = $("#idCompra").val()

  $.ajax({
    url: `${url}cambEstadoCompra`,
    type: 'POST',
    dataType: 'JSON',
    data: {
      id: idEnc,
      estado: 5
    },
    success: function (res) {
      if (res == 1) {
        tableCompras.ajax.reload(null,false)
        for (let i = 0; i < productosConfirmar.length; i++) {
          $.ajax({
            url: `${url}confirProduc`,
            type: 'POST',
            dataType: 'JSON',
            data: { id: productosConfirmar[i].id, estado: productosConfirmar[i].estado },
            success: function (res) {
              if (res == 1) {
                return mostrarMensaje('success', `¡Producto "${productosConfirmar[i].nombre}" confirmado!`)
              } else {
                return mostrarMensaje('error', `Error al confirmar "${productosConfirmar[i].nombre}"!`)
              }
            }
          })
        }
      } else {
        return mostrarMensaje('error', `¡Ha ocurrido un error!`)
      }
    }
  })
});
