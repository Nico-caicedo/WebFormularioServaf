// Obtén los elementos "dark" y "ventana_evalu"
var dark = document.getElementById("dark");
var ventana = document.getElementById("ventana_evalu");
var inicio = document.getElementsByClassName("evaluacion_laboral")[0];
var evaluacion = document.getElementsByClassName("evaluacion_ventana")[0];
VentanaAlerta = document.getElementById("VentanaAlerta");
Form_eva = document.getElementById("form_eva");

// Comprueba si la información está en el localStorage

var isDisplayFlex = localStorage.getItem("displayFlex");

// Si la información indica que debe mostrarse con display: flex, hazlo
if (isDisplayFlex === "true") {
  dark.style.display = "flex";
  ventana.style.display = "flex";
}

// funcione para abrir y cerrar las funciones

function desplegar() {
  // Asegúrate de que dark no sea null antes de cambiar su estilo
  if (dark) {
    dark.style.display = "flex";
    ventana.style.display = "flex";

    // Al hacer clic en "desplegar", guarda la información en el localStorage
    localStorage.setItem("displayFlex", "true");
  }
}

function closes() {
  // Asegúrate de que dark no sea null antes de cambiar su estilo
  ventana.style.display = "none";
  dark.style.display = "none";
  VentanaAlerta.style.display = "none";
  // Al hacer clic en "closes", elimina la información del localStorage
  localStorage.removeItem("displayFlex");
  limpiarInputs();
}

function closess() {
  // Asegúrate de que dark no sea null antes de cambiar su estilo
  ventana.style.display = "none";
  dark.style.display = "none";
  VentanaAlerta.style.display = "none";
  // Al hacer clic en "closes", elimina la información del localStorage
  localStorage.removeItem("displayFlex");
}

// funciones para activar y descativar
// las vistas de las las evaluaciones

function iniciar_evaluacion() {
  inicio.style.display = "none";
  evaluacion.style.display = "flex";
}

function volver() {
  inicio.style.display = "flex";
  evaluacion.style.display = "none";
}

function BackAndDelete() {
  idDelete = document.getElementById("IdEvaluacion").value;

  var options = {
    method: "POST", // Puedes cambiar a 'GET' si prefieres
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", // Ajusta según tu necesidad
    },
    body: "idDelete=" + encodeURIComponent(idDelete), // Codifica el valor para la transmisión segura
  };

  // Hacer la solicitud fetch
  fetch("./php/eliminarEva.php", options)
    .then((response) => response.json()) // Ajusta según el tipo de respuesta esperado
    .then((data) => {
      // Manejar la respuesta del servidor, si es necesario
      console.log(data);
    })
    .catch((error) => {
      // Manejar errores de la solicitud
      console.error("Error en la solicitud fetch:", error);
    });

  inicio.style.display = "flex";
  evaluacion.style.display = "none";
  Form_eva.reset();
}

document.getElementById("Cancelar").addEventListener("click", BackAndDelete);

function abrirVentana() {
  VentanaAlerta.style.display = "flex";
}

function continuar() {
  VentanaAlerta.style.display = "none";
}

// Inicia codigo para cargar usuario

var cedula;

$(document).ready(function () {
  $("#Empleado").on("input", function () {
    var caso = $(this).val();

    if (caso === "") {
      // Si el input está vacío, oculta el elemento resultados
      document.getElementById("resultados").classList.remove("agg");
      $("#medicosResult").html("");
      return;
    }

    $.ajax({
      type: "POST",
      url: "./php/CodigoEmpleado.php",
      data: { query: caso },
      success: function (data) {
        document.getElementById("medicosResult").classList.add("agg");
        $("#medicosResult").html(data);

        // Capturar el valor de data-diag y asignarlo al input al hacer clic en un elemento mauso-diagnee
        $(".mauso-medicaa").on("click", function () {
          var valor = $(this).data("codigo");
          var nombre = $(this).data("nombre");
          var id = $(this).data("ids");
          cedula = valor;
          $("#MedicoFinal").val(id);
          $("#Empleado").val(valor + " //  " + nombre);
          document.getElementById("medicosResult").classList.remove("agg");
        });
      },
    });
  });
});

function ValidarEnvio() {
  var idEva = document.getElementById("MedicoFinal").value;
  var dates1 = document.getElementById("date1").value;
  var dates2 = document.getElementById("date2").value;

  if (idEva === "" || dates1 === "" || dates2 === "") {
    alert("Complete todos los campos");
  } else {
    EnviarFechas(date1.value, date2.value, idEva);
    evaluar();
    limpiarInputs();
  }
}

document.getElementById("Boton").addEventListener("click", ValidarEnvio);

function limpiarInputs() {
  // Obtén los elementos del formulario
  var date1 = document.getElementById("date1");
  var date2 = document.getElementById("date2");
  var Empleado = document.getElementById("Empleado");
  var date3 = document.getElementById("MedicoFinal");
  // Limpiar los valores de los inputs
  if (date1) {
    date1.value = "";
  }

  if (date2) {
    date2.value = "";
  }

  if (Empleado) {
    Empleado.value = "";
  }

  if (date3) {
    date3.value = "";
  }
}

function validarInputs() {
  // Obtener los valores de los inputs
  var input1 = document.getElementById("input1").value.trim();
  var input2 = document.getElementById("input2").value.trim();
  var input3 = document.getElementById("input3").value.trim();

  // Obtener el contenedor
  var miContenedor = document.getElementById("radio4");

  // Verificar si todos los campos están llenos
  if (input1 !== "" && input2 !== "" && input3 !== "") {
    // Cambiar la clase del contenedor
    miContenedor.classList.remove("check2");
    miContenedor.classList.add("check");
  } else {
    // Restablecer la clase del contenedor si no están todos los campos llenos
    miContenedor.classList.remove("check");
    miContenedor.classList.add("check2");
  }
}

function EnviarFechas(dates1, dates2, id) {
  // Crear un objeto con los datos a enviar
  var data = new URLSearchParams();
  data.append("date1", dates1);
  data.append("date2", dates2);
  data.append("id_evaluado", id);

  // Realizar una solicitud POST a un script PHP
  fetch("./php/guardar_eva.php", {
    method: "POST",
    body: data,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  })
    .then((response) => response.json()) // Parsear la respuesta como JSON
    .then((data) => {
      // Manejar la respuesta del servidor
      console.log(data);
      var fechaF =  document.getElementsByClassName('fechaF')[1];
      // Insertar la respuesta en el campo con id "nombre1"
      document.getElementById("nombre1").value = data.nombre1;
      document.getElementById("nombre2").value = data.nombre2;
      document.getElementById("apellido1").value = data.apellido1;
      document.getElementById("apellido2").value = data.apellido2;
      document.getElementById("dni").value = data.dni;
      document.getElementById("number999").value = data.number999;
      document.getElementById("Antiguedad").value = data.Antiguedad;
      document.getElementById("TiempoServicio").value = data.TiempoServicio;
      document.getElementById("IdEvaluado").value = data.IdEvaluado;
      document.getElementById("IdEvaluacion").value = data.IdEvaluacion;
      var radioElement = document.querySelector(
        '.dependencias input[type="radio"][id="' + data.idDependencia + '"]'
      );
      fechaF.textContent = data.PeriodoEvaluacion

      // Verificar si se encontró el elemento
      if (radioElement) {
        // Agregar el atributo checked
        radioElement.checked = true;
      }

      var selectElement = document.getElementById("cargo");

      // Verificar si se encontró el elemento
      if (selectElement) {
        // Iterar sobre las opciones del select y seleccionar la que coincide con idCargo
        for (var i = 0; i < selectElement.options.length; i++) {
          if (selectElement.options[i].value === data.id_cargo) {
            selectElement.options[i].selected = true;
            break; // Salir del bucle después de encontrar la coincidencia
          }
        }
      } else {
        console.error('No se encontró un elemento select con ID "cargo"');
      }

      // También puedes acceder a otros valores devueltos, como id_evaluacion, codigo_unico, etc.
      // Ejemplo: console.log(data.id_evaluacion, data.codigo_unico);

      // Puedes realizar otras acciones según tus necesidades
    })
    .catch((error) => {
      console.error("Error al enviar la solicitud: " + error);
    });
}

function formatearFecha(fecha) {
  // Array de nombres de meses
  const meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  // Obtener día, mes y año
  const dia = fecha.getDate();
  const mes = fecha.getMonth();
  const año = fecha.getFullYear();

  // Formatear la fecha
  const fechaFormateada = `${dia} de ${meses[mes]} del ${año}`;

  return fechaFormateada;
}

// Obtener la fecha actual
const fechaActual = new Date();

// Formatear la fecha
const fechaFormateada = formatearFecha(fechaActual);

// Obtener la etiqueta por su clase y asignar el contenido formateado
const etiquetaFecha = document.querySelector(".fechaF");
etiquetaFecha.textContent = fechaFormateada;

function evaluar() {
  closess();
  iniciar_evaluacion();
}

// funciones para activar y desactivar el cuadro de evaluacion de acuerdo a cada factor

// Obtén todos los contenedores por la clase "modulo" y "tabla"
const modulos = document.querySelectorAll(".modulo");
const tablas = document.querySelectorAll(".table");

// Agrega un controlador de eventos clic a cada contenedor "modulo"
modulos.forEach((modulo) => {
  modulo.addEventListener("click", () => {
    const dataId = modulo.getAttribute("data-id");
    toggleActiveClass(dataId, modulo);
  });
});

// Función para agregar o quitar la clase "active" a elementos con la clase "tabla" que tengan un atributo data-factor igual al data-id
function toggleActiveClass(dataId, modulo) {
  // Desactiva todas las tablas
  tablas.forEach((tabla) => {
    tabla.classList.remove("active");
  });

  // Activa o desactiva la tabla correspondiente
  const tablaActiva = document.querySelector(
    ".table[data-factor='" + dataId + "']"
  );
  if (tablaActiva) {
    if (tablaActiva.classList.contains("active")) {
      tablaActiva.classList.remove("active"); // Desactiva si ya está activa
    } else {
      tablaActiva.classList.add("active"); // Activa si no lo está
    }
  }

  // Desactiva el modulo si la tabla ya está activa
  if (tablaActiva && tablaActiva.classList.contains("active")) {
    modulo.classList.remove("active");
  }
}

document
  .getElementById("form_eva")
  .addEventListener("submit", function (event) {
    // Prevenir el comportamiento predeterminado del formulario
    event.preventDefault();

    // Crear un nuevo objeto FormData
    var formData = new FormData(this);

    // Agregar el par clave-valor al FormData
    formData.append("crearEvaluacion", true);
    var formulario = this;

    // Realizar la solicitud Fetch
    fetch("./php/addEva.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // Manejar la respuesta del servidor
        if (!response.ok) {
          throw new Error("Error en la solicitud");
        }
        return response.json(); // O response.text(), según el tipo de respuesta esperada
      })
      .then((data) => {
        // Manejar los datos obtenidos del servidor
        console.log(data);
        if(data){
          document.getElementById("form_eva").reset();
          volver();
          notaTotal.textContent =  " ";
        }
     
      })
      .catch((error) => {
        // Manejar errores en la solicitud
        console.error("Error en la solicitud:", error);
      });
  });

      // Obtener el formulario y el elemento <p> por su ID
      var formulario = document.getElementById('form_eva');
      var notaTotal = document.getElementById('NotaTotal');

      // Asociar la función al evento input de todos los elementos numéricos dentro del formulario
      formulario.addEventListener('input', actualizarNotas);

      function actualizarNotas(event) {
          // Verificar que el evento provenga de un input de tipo número y que no sea el input con el ID "dni"
       
              // Obtener todos los inputs numéricos dentro del formulario
              var inputsNumericos = formulario.querySelectorAll('input[type="number"]');

              // Calcular la suma de los valores
              var sumaTotal = 0;
              inputsNumericos.forEach(function(input) {
                  sumaTotal += parseFloat(input.value) || 0;
              });
              var ValorReal = sumaTotal.toFixed(2)
              // Asignar el resultado al contenido del elemento <p>
              notaTotal.textContent =  ValorReal;
          
      }