
$(".cantidad").on('input', function(e){
  if(e.target.value <= 0){
    $(`#in${e.target.id}`).text('* Valor invalido *')
  }else{
    producto = carrito.filter(item => item.id == e.target.id)[0]
    carrito.filter(item => item.id == e.target.id)[0].cantidad = e.target.value
    recargaCarrito();
    window.location.reload()
  }
})

$("#btnEnviarCompra").click(function (e) {
  e.preventDefault();
  id = $("#id").val();
  subtotal = $("#subtotal").val();
  if (carrito.length == 0) {
    Swal.fire({
      title: `Carrito vacío`,
      text: "Aún no tienes ningún artículo en el carrito, descubre todo lo que tenemos para ti",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Descubrir",
    }).then((respon) => {
      if (respon.isConfirmed) {
        window.location.href = `${url}`
      }
    })
  } else {
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
              mostrarMensaje("success", "¡Compra realizada con éxito!");
              setTimeout(() => {
                carrito = [];
                recargaCarrito();
                window.location.href = `${url}compras-realizadas`;
              }, 1500);
            } else {
              return mostrarMensaje("error", "¡Ha ocurrido un error!");
            }
          },
        });
      }
    });
  }
});
