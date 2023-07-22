id = $("#idProduc").val();
$.ajax({
  url: `${url}buscarProducto`,
  type: "POST",
  dataType: "json",
  data: {
    id,
  },
  success: function (data) {
    $("#precio").text(`${formatearCantidad(data[0].precio)} COP c/u`);
  },
});
$.ajax({
  url: `${url}urlImg`,
  type: "POST",
  dataType: "json",
  data: {
    id: id,
  },
  success: function (res) {
    var cadena = "";
    for (let i = 0; i < res.length; i++) {
      var foto = `${url}imagenesProducto/${res[i].nombre_img}`;
      cadena += `<div class="swiper-slide">
                        <img src="${foto}" class="d-block" alt="imagen producto">
                    </div> `;
      $("#swiper-wrapper").html(cadena);
      const swiper = new Swiper(".swiper", {
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        direction: "horizontal",
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    }
  },
});

$("#btnAddCar").on("click", function (e) {
  e.preventDefault();
  idProduc = $("#idProduc").val();
  nomProduc = $("#nomProduc").val();
  precioProduc = $("#precioProduc").val();
  cantidad = $("#cantidad").val();

  if ([cantidad].includes("")) {
    return mostrarMensaje("error", "¡Ingrese una cantidad valida!");
  } else {
    objProducto = carrito.filter((item) => item.id == idProduc)[0];
    if (objProducto != undefined) {
      const { cantidad } = objProducto;
      let nuevaCant = Number(cantidad) + Number(objProducto.cantidad);
      carrito.filter((item) => item.id == idProduc)[0].cantidad = nuevaCant;
    } else {
      objProducto = {
        id: Number(idProduc),
        nombre: nomProduc,
        precio: Number(precioProduc),
        cantidad: Number(cantidad),
      };
      carrito.push(objProducto);
    }
    recargaCarrito();
    $("#cantidad").val("");
  }
});
