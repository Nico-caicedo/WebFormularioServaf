var bodyId = $("body").data("nuevas");

if (bodyId) {
  toastr.options = {
    closeButton: false,
    progressBar: true,
    positionClass: 'toast-top-right',
    onclick: function () {
      mostrarContenedor('Solicitudes', document.getElementById("4"));
    }
  };

  toastr.info("Tienes " + bodyId + " solicitudes pendientes. Haz clic para responderlas.");
}


var activeContainer = localStorage.getItem('activeContainer');
var activeBoton = localStorage.getItem('activeBoton');
if (activeContainer && activeBoton) {
  botonId = document.getElementById(activeBoton);
  mostrarContenedor(activeContainer, botonId); // Mostrar el contenedor guardado en el menú
} else {
  mostrarContenedor('Ambientes', document.querySelector(".pri")); // Mostrar el contenedor de Dashboard por defecto
}


function mostrarContenedor(contenedorId, boton) {
  var contenedores = document.getElementsByClassName('pages');
  for (var i = 0; i < contenedores.length; i++) {
    contenedores[i].style.display = 'none'; // Ocultar todos los contenedores
  }

  var botones = document.getElementsByClassName('botones');
  for (var i = 0; i < botones.length; i++) {
    botones[i].classList.remove("active-nav");
    p = botones[i].querySelector("p");
    iElement = botones[i].querySelector("i");
    p.classList.remove("active-nav-p");
    iElement.classList.remove("active-nav-p");
  }

  var p = boton.querySelector("p");
  var iElement = boton.querySelector("i");
  p.classList.add("active-nav-p");
  iElement.classList.add("active-nav-p");
  boton.classList.add("active-nav");

  if (contenedorId == "Ambientes") {
    recibirDatos();
  }

  if (contenedorId == "descubre_asig") {
    agg_icono_descubreAsig(boton);
  }else{
    remove_icono_descubreAsig();
  }

  document.getElementById(contenedorId).style.display = 'flex'; // Mostrar el contenedor seleccionado
  localStorage.setItem('activeContainer', contenedorId); // Guardar el contenedor seleccionado en el menú
  localStorage.setItem('activeBoton', boton.id);
}

function agg_icono_descubreAsig(boton){
  var icono = boton.querySelector("i");
  icono.classList.remove("fa-play");
  icono.classList.add("fa-pause");
}

function remove_icono_descubreAsig(){
  var icono = document.querySelector(".fa-pause");
  if(icono){
    icono.classList.remove("fa-pause");
    icono.classList.add("fa-play");
  }
}

function mostrarFormulario() {
  document.getElementById("formulario").style.display = "block";
}


function cerrarFormulario() {
  document.getElementById("formulario").style.display = "none";
}

function mostrarUserCard() {
  var modal = document.getElementById("ventanaeditarP");
  modal.style.display = "flex";
}

function ocultarUserCard() {
  var cerrar = document.getElementById("ventanaeditarP");
  cerrar.style.display = "none";
}

window.onclick = function (event) {
  var modal = document.getElementById("ventanaeditarP");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function focus_buscador_descubre_asig(){
  var input_buscador_descubre_asig = document.querySelector(".input_buscador_descubre_asig");

  input_buscador_descubre_asig.addEventListener("focus", function(){
    document.querySelector(".buscador").classList.add("focus_buscador_descubre_asig");
  });
  input_buscador_descubre_asig.addEventListener("blur", function(){
    document.querySelector(".buscador").classList.remove("focus_buscador_descubre_asig");
  });
}
focus_buscador_descubre_asig();

window.onload = function() {
  var cont_cargando_inicio = document.querySelector(".cont_cargando_inicio");

  cont_cargando_inicio.classList.add("ocultar_cont_cargando_inicio");

  setTimeout(function() {
    cont_cargando_inicio.style.display = "none";
  }, 500);
}
