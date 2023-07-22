var carrito = [];
let objProducto = {
  id: 0,
  nombre: "",
  precio : 0,
  cantidad: 0,
};

carrito = JSON.parse(localStorage.getItem("carrito")) ?? []

const recargaCarrito = () => {
  localStorage.setItem("carrito", JSON.stringify(carrito));
  $("#numProducs").text(`${carrito?.length}`);

  
};
recargaCarrito();

$("#btnMenu").click(function () {
  $("aside").toggleClass("active");
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
const formatearCantidad = (cantidad) => {
  return Number(cantidad).toLocaleString("es-CO", {
    style: "currency",
    currency: "COP",
  });
};
