id = $("#idProduc").val();
const Toast = Swal.mixin({
  toast: true,
  showConfirmButton: false,
  timer: 2000,
  didOpen: (toast) => {
    toast.style.position = "fixed";
    toast.style.top = "10px";

  },
});

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
  imgProduc = $("#imgProduc").val();

  if ([cantidad].includes("")) {
    return mostrarMensaje("error", "¡Ingrese una cantidad valida!");
  } else {
    objProducto = carrito.filter((item) => item.id == idProduc)[0];
    if (objProducto != undefined) {
      // const { cantidad } = objProducto;
      let nuevaCant = Number(cantidad) + Number(objProducto.cantidad);
      carrito.filter((item) => item.id == idProduc)[0].cantidad = nuevaCant;
    } else {
      objProducto = {
        id: Number(idProduc),
        nombre: nomProduc,
        precio: Number(precioProduc),
        cantidad: Number(cantidad),
        img: imgProduc,
      };
      carrito.push(objProducto);
    }
    Toast.fire({
      icon: `success`,
      title: `¡Se ha agregado el producto "${nomProduc}"!`,
    });
    recargaCarrito();
    $("#cantidad").val("");
  }
});

const puntuacion = (rating) => {
  const startIcon = '★'
  const emptyIcon = '☆'
  const total = 5
  const stars = startIcon.repeat(rating)
  const empty = emptyIcon.repeat(total - rating)
  return stars + empty
}

$.ajax({
  url: `${url}obtenerComentarios`,
  type: "POST",
  dataType: "json",
  data: {
    id,
    estado: 'A'
  },
  success: function (res) {
    var cadena = ''
    var valor = 0
    if (res.length == 0) {
      cadena = '<li class="comentario"><p>(～￣▽￣)～ Se el primero en comentar...</p></li>'
    } else {

      for (let i = 0; i < res.length; i++) {
        cadena += `
        <li class="comentario mt-3">
        <div class="d-flex align-items-center justify-content-between  flex-wrap mb-2">
          <div class="d-flex gap-3 align-items-center">
            <img src="${url}img/logo-asoca-s.png" class="fotoUsuario" alt="foto usuario" width="50">
            <p class="mb-0 fw-semibold">${res[i].usuario}</p>
            </div>
          <p class="mb-0">Valoración: <span class="fs-4 text-warning">${puntuacion(res[i].valoracion)}</span></p>
          </div>
        <p class="p-comentario">${res[i].comentario}</p>
        <p class="text-secondary fecha">Fecha Publicación: ${res[i].fecha_crea.split(' ')[0]}</p>
      </li>
      `
        valor = valor + res[i].valoracion

      }
    }
    valor = res.length == 0 ? valor = 0 : valor / res.length
    $('#calificacion').text(`${puntuacion(valor)} ${valor}`)
    $('.listado-comentarios').html(cadena)


  }
});