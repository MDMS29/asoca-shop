var carrito = [];
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
              <a href="${url}verDetallesCompra" class="flex-grow-1 btn btn-primary" style="color:white !important;border-radius:0;"><i class="bi bi-pencil-square"></i> Editar</a>
              <button onclick="eliminarProducCar(${
                element.id
              })" class="flex-grow-1 btn btn-danger" style="border-radius:0;"><i class="bi bi-trash3-fill"></i> Eliminar</button>
            </div>
          </li>
          `;
  });
  $("#listaProductos").html(cadena);
};
recargaCarrito();

function eliminarProducCar(id) {
  carrito = carrito.filter((item) => item.id != id);
  recargaCarrito();
}
