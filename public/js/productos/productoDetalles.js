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
      $("#swiper-wrapper-img").html(cadena);

      crearSwiper('swiper-img', { autoplay: { delay: 2500, disableOnInteraction: false, }, direction: "horizontal", navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev", }, })
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

  if (cantidad == 0 || cantidad == '') {
    return mostrarMensaje("error", "¡Ingrese una cantidad valida!");
  } else {
    objProducto = carrito.filter((item) => item.id == idProduc)[0];
    if (objProducto != undefined) {
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
    $("#cantidad").val("0");
  }
});

$.ajax({
  url: `${url}productosCategoria`,
  type: 'POST',
  dataType: 'json',
  data: {
    id:id,
    categoria,
    estado: 'A'
  },
  success: function (res) {
    var cadena = '';
    switch (res.length) {
      case 0:
        cadena += `<p class="container text-center">NO HAY PRODUCTOS SIMILARES</p>`
        break;

      default:
        res.forEach(element => {
          var foto = `${url}imagenesProducto/${element.nombre_img}`;
          cadena += `
                  <article onclick="window.location.href='${url}detalles-producto/${element.id_producto}'" class="card swiper-slide">
                      <div class="row g-0">
                          <div class="col-md-4 d-flex justify-content-center w-100 py-3" >
                              <img src="${foto}"alt="${element.nombre_img}" width="130" height="150">
                          </div>
                          <div class="card-body text-center">
                              <h5 class="card-title text-capitalize fw-bold" style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1; overflow: hidden;"> ${element.nombre}</h5>
                              <p class="card-text fw-semibold text-danger">${formatearCantidad(element.precio)} COP <span class="text-secondary">c/u</span></p>
                              <small class="text-secondary text-capitalize">-${element.categoria}-</small>
                          </div>
                      </div>
                  </article>`
        });
        break;
    }

    $('#swiper-wrapper-similares').html(cadena)

    crearSwiper('swiper-similares', {autoplay: { delay: 2500, disableOnInteraction: false, },slidesPerView: 1,spaceBetween: 10,pagination: {el: ".swiper-pagination",clickable: true,},breakpoints: {640: {slidesPerView: 2,spaceBetween: 20,},768: {slidesPerView: 2,spaceBetween: 40,},1024: {slidesPerView: 3,spaceBetween: 50,},1300:{slidesPerView: 4,spaceBetween: 50,}},})
  }
})
const puntuacion = (rating) => {
  const startIcon = '★'
  const emptyIcon = '☆'
  const total = 5
  const stars = startIcon.repeat(rating)
  const empty = emptyIcon.repeat(total - rating)
  return stars + empty
}
function cargarComentarios() {
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
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
              <div class="d-flex gap-3 align-items-center">
                <img src="${url}img/logo-asoca-s.png" class="fotoUsuario" alt="foto usuario" width="50">
                <p class="mb-0 fw-semibold">${res[i].usuario}</p>
              </div>
              <p class="mb-0"><span class="fs-4 text-warning">${puntuacion(res[i].valoracion)}</span></p>
            </div>
            <p class="p-comentario">${res[i].comentario}</p>
            <p class="text-secondary fecha">Fecha Publicación: ${res[i].fecha_crea.split(' ')[0]}</p>
            ${res[i].id_usuario == id_usuario
              ? ` <button class="btn btn-outline-primary" onclick="editarComentario(${res[i].id_valoracion})">Editar</button>
                  <button class="btn btn-outline-danger" onclick="eliminarComentario(${res[i].id_valoracion})">Eliminar</button>` : ''}
           
          </li>
        `
          valor = Number(valor) + Number(res[i].valoracion)
        }
        valor = Math.round(valor / res.length)
      }
      $('#calificacion').text(`${puntuacion(valor)} ${valor}`)
      $('.listado-comentarios').html(cadena)
    }
  });
}
cargarComentarios()
const stars = document.querySelectorAll('.star')
stars.forEach(function (star, index) {
  star.addEventListener('click', function () {
    for (let i = 0; i <= index; i++) {
      stars[i].classList.add('checked')
    }
    for (let i = index + 1; i < stars.length; i++) {
      stars[i].classList.remove('checked')
    }
    $('#valorCom').val(index + 1)
  })
})
$('#btnEnvComen').on('click', function (e) {
  e.preventDefault();
  valoracion = $('#valorCom').val()
  comentario = $('#insertComent').val()
  idComen = $('#idComen').val()
  tp = $('#tp').val()

  if (valoracion == '') {
    $('#invalidValor').text('* Valor invalido *')
    setTimeout(() => $('#invalidValor').text(''), 2000)
    return false;
  }
  if (comentario == '') {
    $('#invalidComen').text('*Ingrese un comentario valido *')
    setTimeout(() => $('#invalidComen').text(''), 2000)
    return false;

  }
  $.ajax({
    url: `${url}insertarComen`,
    type: 'POST',
    dataType: 'JSON',
    data: {
      idComen,
      tp,
      valoracion,
      comentario,
      producto: id
    },
    success: function (res) {
      cargarComentarios()
      if (res == 1) {
        if (tp == 2) {
          Toast.fire({
            icon: `success`,
            title: `¡Se ha actualizado el comentario!`,
          });
        } else {
          Toast.fire({
            icon: `success`,
            title: `¡Comentario agregado con éxito!`,
          });
        }
      } else {
        Toast.fire({
          icon: `error`,
          title: `¡Ha ocurrido un error!`,
        });
      }
      $('#tp').val(1)
      $('#valorCom').val(0)
      $('#insertComent').val('')
      $('#idComen').val(0)
      $('#btnEnvComen').text('Publicar')
      $('#btnCancelar').attr('hidden', '')
      stars.forEach(function (star, index) {
        for (let i = 0; i <= 5; i++) {
          stars[i].classList.remove('checked')
        }
      })
    }
  })
})
function editarComentario(idComentario) {
  $.ajax({
    url: `${url}buscarComentario`,
    type: 'POST',
    dataType: 'JSON',
    data: {
      idComentario
    },
    success: function (res) {
      $('#valorCom').val(res.valoracion)
      $('#tp').val(2)
      $('#insertComent').val(res.comentario)
      $('#idComen').val(res.id_valoracion)
      $('#btnEnvComen').text('Actualizar')
      $('#btnCancelar').removeAttr('hidden')
      stars.forEach(function (star, index) {
        index = res.valoracion
        for (let i = 0; i <= index; i++) {
          stars[i].classList.add('checked')
        }
      })
    }
  })
}
$('#insertComent').on('input', () => $('#insertComent').val() != '' ? $('#btnCancelar').removeAttr('hidden') : $('#btnCancelar').attr('hidden', ''))

$('#btnCancelar').click(function (e) {
  e.preventDefault()
  $('#tp').val(1)
  $('#valorCom').val(0)
  $('#insertComent').val('')
  $('#idComen').val(0)
  $('#btnEnvComen').text('Publicar')
  $('#btnCancelar').attr('hidden', '')
  stars.forEach(function (star, index) {
    for (let i = 0; i <= 5; i++) {
      stars[i].classList.remove('checked')
    }
  })
})
function eliminarComentario(idComentario) {
  Swal.fire({
    title: "¿Desea eliminar este Comentario?",
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
        url: `${url}camEstComen`,
        data: {
          idComentario,
          estado: "I",
        },
      }).done(function (res) {
        cargarComentarios()
        if (res == 1) {
          Toast.fire({
            icon: `success`,
            title: `¡Se ha eliminado el comentario!`,
          });
        } else {
          Toast.fire({
            icon: `error`,
            title: `¡Ha ocurrido un error!`,
          });
        }
      });
    }
  });
}