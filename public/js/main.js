$("#btnMenu").click(function () {
  $("aside").toggleClass("active");
  $("li a span").toggleClass("active");
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

$("#formularioLogin").on("submit", function (e) {
  e.preventDefault();
  usuario = $("#usuario").val();
  contrasena = $("#contrasena").val();
  try {
    $.ajax({
      type: "POST",
      url: `${url}login`,
      dataType: "json",
      data: {
        usuario,
        contrasena,
      },
    }).done(function (res) {
      if (res == 1) {
        window.location.reload();
      } else {
        $("#contrasena").val("");
        $("#invalid-feedback").text("¡Usuario o Contraseña incorrectos!");
        setTimeout(() => {
          $("#invalid-feedback").text("");
        }, 3000);
      }
    });
  } catch (error) {
    console.log(error);
  }
});

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
