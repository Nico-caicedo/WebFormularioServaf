
var verAmbiente = document.querySelectorAll(".verAmbientes");
var pisoId;

verAmbiente.forEach(function (contenedor) {
  contenedor.addEventListener("click", function () {
    pisoId = this.getAttribute("data-piso");
    fetch("php/consultarAmbientes.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "piso_id=" + encodeURIComponent(pisoId),
    })
      .then((response) => response.text())
      .then(function (responseText) {
        document.getElementById("contenedorPisos").style.display = 'none';
        document.getElementById("contenedorAMBIENTE").style.display = 'flex';
        document.getElementById("contenedorAMBIENTE").innerHTML = responseText;

        // Ahora que el contenido dinámico se ha cargado, agrega el event listener para la búsqueda por nombre
        agregarEventListenerBusquedaNombre();
        
        inicializarSwiper();
      })
      .catch(function (error) {
        console.error("Error:", error);
      });
  });
});



// Función para agregar el event listener para la búsqueda por nombre
function agregarEventListenerBusquedaNombre() {
  var contenedorAmb = document.querySelectorAll(".cardAmbiente");
  var busquedaNombre = document.getElementById("busquedaNombre");

  busquedaNombre.addEventListener("input", function () {
    var nombreBuscado = busquedaNombre.value.toLowerCase();

    contenedorAmb.forEach(contAmbie => {
      var ocupante = contAmbie.getAttribute("data-ocupante");

      // Verificar si ocupante es null o undefined
      if (ocupante === null || ocupante === undefined) {
        // Si no hay ocupante definido, mostrar el ambiente
        contAmbie.classList.remove("ocultarAmbi");
      } else {
        // Si hay ocupante, realizar la búsqueda por nombre
        ocupante = ocupante.toLowerCase();

        if (nombreBuscado === "" || ocupante.includes(nombreBuscado)) {
          contAmbie.classList.remove("ocultarAmbi");
        } else {
          contAmbie.classList.add("ocultarAmbi");
        }
      }
    });
  });
}



var contenedorAmbiente = document.getElementById("contenedorAMBIENTE");

contenedorAmbiente.addEventListener("change", function (event) {
  var target = event.target;

  if (target && target.id === "estatuto") {
    var selectedEstado = target.value;
    var contenedorAmb = document.querySelectorAll(".cardAmbiente");
    var ambientes_encotrado = false;

    contenedorAmb.forEach(contAmbie => {
      contAmbie.classList.remove("ocultarAmbi");
      var piso = contAmbie.getAttribute("data-piso");
      var estado = contAmbie.getAttribute("data-estado");

      if (pisoId == piso) {
        if (selectedEstado == "mostrar" || selectedEstado === estado) {
          ambientes_encotrado = true;
        } else {
          contAmbie.classList.add("ocultarAmbi");
        }
      }
    });

    if (!ambientes_encotrado) {
      alert("No hay ambientes de estado " + selectedEstado + " en este piso.");
      target.value = "mostrar";
      contenedorAmb.forEach(contAmbi => {
        contAmbi.classList.remove("ocultarAmbi");
      });
    }
  }
});


function vaciarPisos() {
  document.getElementById("contenedorAMBIENTE").innerHTML = '';
  document.getElementById("contenedorAMBIENTE").style.display = 'none';
  document.getElementById("contenedorPisos").style.display = 'flex';
}
