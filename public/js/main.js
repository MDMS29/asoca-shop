var carrito = [];
var departamentos = [];
var municipios = [];


const cargarApiMunicipios = async () => {
  try {
    const data = await fetch('https://www.datos.gov.co/resource/xdk5-pm3f.json');
    const res = await data.json();
    const departamentosSet = new Set(); // Conjunto para almacenar departamentos únicos
    const municipiosSet = new Set();

    res.forEach(item => {
      departamentosSet.add(item.departamento);
      municipiosSet.add({
        departamento: item.departamento,
        municipio: item.municipio
      });
    });

    departamentos = Array.from(departamentosSet); // Convertir el conjunto a un array
    municipios = Array.from(municipiosSet);

    var cadena = ''
    cadena = ` <option value="">-- Seleccione --</option>`
    for (let i = 0; i < departamentos.length; i++) {
      cadena += ` <option value="${departamentos[i]}">${departamentos[i]}</option>`
    }
    $('#departamento').html(cadena)
  } catch (error) {
    console.log(error);
  }
}
cargarApiMunicipios();

carrito = JSON.parse(localStorage.getItem("carrito")) ?? [];
let objProducto = {
  id: 0,
  nombre: "",
  precio: 0,
  cantidad: 0,
  img: "",
};

const formatearCantidad = (cantidad) => {
  return Number(cantidad).toLocaleString("es-CO", {
    style: "currency",
    currency: "COP",
  });
};

$("#btnMenu").click(function () {
  $("#asidePrin").toggleClass("active");
  $("li a span").toggleClass("active");
});

$("#btnCarrito").click(function () {
  $("#asideCar").toggleClass("active");
});

function mostrarMensaje(tipo, msg) {
  Swal.fire({
    position: "center",
    icon: `${tipo}`,
    text: `${msg}`,
    showConfirmButton: false,
    timer: 1500,
  });
}
function salir() {
  $.ajax({
    type: "POST",
    url: `${url}salir`,
    data: {},
    success: function () {
      window.location.href = `${url}`;
    },
  });
}

const recargaCarrito = () => {
  var cadena = "";
  localStorage.setItem("carrito", JSON.stringify(carrito));
  $("#numProducs").text(`${carrito?.length}`);
  carrito.length == 0 ? $('.btnDetalle').attr('hidden', '') : $('.btnDetalle').removeAttr('hidden')

  if (carrito.length == 0) {
    cadena += `
    <li class="text-center d-flex flex-column justify-content-center align-items-center p-3 gap-5 h-100 m-0"> 
      <img src="${url}img/empty-car.png" alt="Imagen carrito vacio" width="150">
      <p class="fs-5">¡Carrito vacío!</p>
      <p class="fs-6">Aún no tienes ningún artículo en el carrito, descubre todo lo que tenemos para ti</p>
      <a href="${url}" class="btn btn-secondary">Descubrir</a>
    </li>`
  } else {

    carrito.forEach((element) => {
      var foto = `${url}imagenesProducto/${element.img}`;
      cadena += `
          <li>
          <div class="d-flex gap-3">
              <img src="${foto}" alt="${element.nombre}" width="120"/>
              <div>
                <p class="text-capitalize">${element.nombre}</p>
                <label>Precio: </label>
                <p>${formatearCantidad(element.precio)} COP</p>
                <p>Cantidad: ${element.cantidad}</p>
              </div>
            </div>
            <div class="d-flex mt-1">
              <a href="${url}detalles-compra" class="flex-grow-1 btn btn-primary" style="color:white !important;border-radius:0;"><i class="bi bi-pencil-square"></i> Editar</a>
              <button onclick="eliminarProducCar(${element.id})" class="flex-grow-1 btn btn-danger" style="border-radius:0;"><i class="bi bi-trash3-fill"></i> Eliminar</button>
            </div>
          </li>
          `;
    });
  }
  $("#listaProductos").html(cadena);
};
recargaCarrito();

function eliminarProducCar(id) {
  carrito = carrito.filter((item) => item.id != id);
  recargaCarrito();
}


$('#departamento').on('change', function () {
  const departamento = $('#departamento').val()
  const municipio = municipios.filter(item => item.departamento == departamento)

  var cadena = ''
  cadena = ` <option value="">-- Seleccione --</option>`
  for (let i = 0; i < municipio.length; i++) {
    cadena += ` <option value="${municipio[i].municipio}">${municipio[i].municipio}</option>`
  }

  $('#municipio').html(cadena)
})

