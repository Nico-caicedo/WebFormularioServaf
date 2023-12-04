function habilitarMotivo() {
  valor_select = this.value;
  if (valor_select == "otros") {
    $("#descripcionMotivo").addClass("motivoAbierto");
    $("#descripcionMotivo").removeClass("motivo");
    // document.querySelector("#descripcionMotivo").classList.add("motivoAbierto");
    // document.querySelector("#descripcionMotivo").classList.remove("motivo");
  } else {
    $("#descripcionMotivo").addClass("motivo");
    $("#descripcionMotivo").removeClass("motivoAbierto");
  }
}

function ActualizarEstadoAsigacion() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");

  var contenedor = document.querySelector(".menu-estado-ambi");
  var idReserva = contenedor.getAttribute("data-id_reserva");

  if (idReserva == "nodis") {
    alert("Ambiente disponible actualmente, ¡no puedes cambiar el estado!.");
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    return;
  }
  // obtenemos el id usuario
  var contenedor_u = document.querySelector("#estado-ambi");

  var idUsuario = contenedor_u.getAttribute("data-id_usuario");
  // obtenemos el nuevo estado y el motivo
  // var estadoSeleccionado = $("#estadoSelect").val();
  var motivoReporte = $("#motivo").val();
  var descripcionTomada = document.querySelector(".motivoAbierto");

  if (descripcionTomada) {
    var descripcion = descripcionTomada.value;
  } else {
    var descripcion = motivoReporte;
  }

  var descripcionEnviada = descripcion;

  if (descripcionEnviada.trim().length === 0) {
    toastr.warning("El motivo está vacío. Por favor, escriba algo.");
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    return;
  }
  // var descripcion = $("#descripcionMotivo").val();

  console.log(idReserva);

  var datos = {
    idReserva: idReserva,
    idUsuario: idUsuario,
    motivoReporte: motivoReporte,
    descripcionEnviada: descripcionEnviada,
  };

  $.ajax({
    url: "php/asigAmbi.php",
    type: "POST",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      // Comprueba si la respuesta contiene el mensaje de éxito o de error
      if (respuesta.mensaje.includes("correctamente")) {
        toastr.success("Estado actualizado correctamente.");

        // Espera 2 segundos (2000 milisegundos) y luego recarga la página
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        alert("Error al actualizar el estado:\n" + respuesta.mensaje);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
  $(".cargando-da").hide();
}
