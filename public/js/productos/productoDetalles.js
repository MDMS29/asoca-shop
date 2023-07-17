id = $("#idProduc").val();
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