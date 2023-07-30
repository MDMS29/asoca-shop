$("#btnEnviarCompra").click(function (e) {
  e.preventDefault();
  id = $("#id").val();
  subtotal = $("#subtotal").val();
  Swal.fire({
    title: `¿Desea confirmar su compra?"`,
    text: "¡Confirme si esta seguro de su carrito de compras!",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí",
  }).then((respon) => {
    if (respon.isConfirmed) {
      $.ajax({
        url: `${url}confirCompra`,
        type: "POST",
        dataType: "json",
        data: {
          id,
          subtotal,
          carrito,
        },
        success: function (res) {
          if (res == 1) {
            mostrarMensaje("success", "¡Compra realizada con exito!");
            setTimeout(() => {
              carrito = [];
              recargaCarrito();
              window.location.href = `${url}verComprasRealizadas`;
            }, 1500);
          } else {
            return mostrarMensaje("error", "¡Ha ocurrido un error!");
          }
        },
      });
    }
  });
});
