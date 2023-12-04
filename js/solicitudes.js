// JavaScript para manejar los eventos
const contenedores = document.querySelectorAll(".solicitud");
const modal = document.getElementById("modal");
const modal2 = document.getElementById("modal2");
const confirmAcceptBtn = document.getElementById("confirm-accept");
const cancelAcceptBtn = document.getElementById("cancel-accept");
const rechazarAcceptBtn = document.getElementById("confirm-rechazar");
const cancel = document.getElementById("cancel-rechazar");

contenedores.forEach((contenedor) => {
  const verDetallesBtn = contenedor.querySelector(".ver-detalles-btn");
  verDetallesBtn.addEventListener("click", function () {
    const idConcurret = contenedor.getAttribute("data-id");
    modal.setAttribute("data-id", idConcurret); // Almacenar el ID en el modal
    modal.style.display = "block";
  });
});



  confirmAcceptBtn.addEventListener("click", function () {
    const id = modal.getAttribute("data-id");
    aceptarSolicitud(id);
    modal.style.display = "none";
  });

  cancelAcceptBtn.addEventListener("click", function () {
    modal.style.display = "none";
  });


function aceptarSolicitud(id) {
  const data = new URLSearchParams();
  data.append("id_soli", id);


  fetch("php/ambientes.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: data,
  })
    .then((response) => response.text())
    .then(function (responseText) {
      alert("Ambiente asignado con exito");
      contenedores.forEach((contenedor) => {
        const idConcurret = contenedor.getAttribute("data-id");
        if (idConcurret == id) {
          const contenedorPadre = contenedor.parentNode;
          contenedorPadre.classList.add("ocultarAmbi");
          const contenidoActual = parseInt($(".asig_nuevas").text(), 10);
          if (contenidoActual == 1) {
            $(".asig_nuevas").addClass("ocultarAmbi");
            window.location.reload();
            return;
          }
          if (!isNaN(contenidoActual)) {
            const nuevoContenido = contenidoActual - 1;
            $(".asig_nuevas").text(nuevoContenido);
          }
        }
      });
    })
    .catch(function (error) {
      console.error("Error:", error);
    });
}

contenedores.forEach((contenedor) => {
  const verDetallesBtn2 = contenedor.querySelector(".rechazarSolicitud-btn");
  verDetallesBtn2.addEventListener("click", function () {
    console.log("chao");
    const idConcurret2 = contenedor.getAttribute("data-id");
    modal2.setAttribute("data-id", idConcurret2); // Almacenar el ID en el modal
    modal2.style.display = "block";
  });
});


  rechazarAcceptBtn.addEventListener("click", function () {
    const id = modal2.getAttribute("data-id");
    rechazarSolicitud(id);
    modal2.style.display = "none";
  });

  cancel.addEventListener("click", function () {
    modal2.style.display = "none";
  });

function rechazarSolicitud(id) {
  const data = new URLSearchParams();
  data.append("solici_r", id);

  fetch("php/ambientes.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: data,
  })
    .then((response) => response.text())
    .then(function (responseText) {
      alert("Solicitud rechazada con exito.");
      contenedores.forEach((contenedor) => {
        const idConcurret = contenedor.getAttribute("data-id");
        if (idConcurret == id) {
          const contenedorPadre = contenedor.parentNode;
          contenedorPadre.classList.add("ocultarAmbi");
          const contenidoActual = parseInt($(".asig_nuevas").text(), 10);
          if (contenidoActual == 1) {
            $(".asig_nuevas").addClass("ocultarAmbi");
            window.location.reload();
            return;
          }
          if (!isNaN(contenidoActual)) {
            const nuevoContenido = contenidoActual - 1;
            $(".asig_nuevas").text(nuevoContenido);
          }
        }
      });
    })
    .catch(function (error) {
      console.error("Error:", error);
    });
}
