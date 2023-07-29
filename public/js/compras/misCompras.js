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
    data: {},
    dataSrc: "",
  },
  columns: [
    {
      data: null,
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
      render : function(data, type, row){
        return ( 
            `<b class="fw-bold ${row.estado == 'P' ? 'text-warning' : row.estado == 'D' ? 'text-danger' : 'text-success'}">
            ${row.estado == 'P' ? 'Pendiente' : row.estado == 'D' ? 'Denegado' : 'Confirmado'}
            </b>`
        )
      }
    },
    {
      data: "subtotal",
    },
    {
      data: null,
      render: function (data, type, row) {
        return (
          '<div class="d-flex gap-2 justify-content-center"><button class="btn btn-outline-primary" onclick="verCompra(' +
          data.id_compra_enc +
          ')" data-bs-target="#detallesModal" data-bs-toggle="modal" title="Ver Detalles"><i class="bi bi-eye-fill"></i></button></div>'
        );
      },
    },
  ],
  language: {
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  },
});

function verCompra(id){
    $.ajax({
        url : `${url}detallesCompra`,
        type: "POST",
        dataType : 'json',
        data : {
            id
        },
        success : function(data){
            console.log(data)
        }
    })
}