function enviarInforme(event) {
  event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

  // Obtener los valores de los inputs de fecha
  const fechaInicio = document.getElementById("fecha_inicio").value;
  const fechaFin = document.getElementById("fecha_fin").value;

  // Verificar si ambos inputs de fecha tienen valor
  if (fechaInicio && fechaFin) {
    const formData = new FormData(filtroInforme);
    const url = "php/exportarInforme.php"; // Reemplaza con la URL a la que deseas enviar los datos

    fetch(url, {
      method: "POST", // Puedes cambiar a "GET" si es necesario
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data === null) {
          inputsInfo = document.querySelectorAll('.inputsFecha');
          inputsInfo.forEach(input => {
            input.style.boxShadow='rgba(8, 255, 70, 0.05) 0px 0px 0px 1px, rgb(241, 26, 11) 0px 0px 0px 1px inset';
          });

          toastr.warning("No existen asignaciones en ese rango de fechas");
        } else {
          inputsInfo = document.querySelectorAll('.inputsFecha');
          inputsInfo.forEach(input => {
            input.style.boxShadow='rgba(8, 255, 70, 0.05) 0px 0px 0px 1px, rgb(16, 176, 53) 0px 0px 0px 1px inset';
          });
          // Mostrar una alerta de confirmación utilizando SweetAlert
          Swal.fire({
            title: '¿Desea guardar el informe?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              exportarInformeExcel(data);
            }
          });
        }
      })
      .catch((error) => {
        console.error("Ocurrió un error:", error);
      });
  }
}

// Función para exportar el informe en Excel
function exportarInformeExcel(responseData) {
  var workbook = XLSX.utils.book_new();
  var worksheet = XLSX.utils.json_to_sheet(responseData);
  XLSX.utils.book_append_sheet(workbook, worksheet, "Informe");
  XLSX.writeFile(workbook, "informe.xlsx");
}

// Función para mostrar el modal de filtro de informe
function abrirModalInforme() {
  inputsInfo = document.querySelectorAll('.inputsFecha');
  inputsInfo.forEach(input => {
    input.value='';
    input.style.boxShadow = 'rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset';
  });
  document.getElementById('ModalfiltroInforme').style.display = 'flex';
}

// Función para cerrar el modal de filtro de informe
function cerrarModalInforme() {
  document.getElementById('ModalfiltroInforme').style.display = 'none';

}

// Función para actualizar las fechas de inicio y fin según el mes seleccionado
function actualizarFechasSegunMes() {
  const mesSeleccionado = parseInt(document.getElementById("mesSeleccionado").value);
  const primerDiaDelMes = new Date(new Date().getFullYear(), mesSeleccionado - 1, 1);
  const ultimoDiaDelMes = new Date(new Date().getFullYear(), mesSeleccionado, 0);
  const fechaInicioFormatted = primerDiaDelMes.toISOString().split('T')[0];
  const fechaFinFormatted = ultimoDiaDelMes.toISOString().split('T')[0];
  document.getElementById("fecha_inicio").value = fechaInicioFormatted;
  document.getElementById("fecha_fin").value = fechaFinFormatted;
}


document.getElementById("filtroInforme").addEventListener("submit", enviarInforme);
document.getElementById('abrirModalInforme').addEventListener('click', abrirModalInforme);
document.getElementById('cerrarModalInforme').addEventListener('click', cerrarModalInforme);
document.getElementById("mesSeleccionado").addEventListener("change", actualizarFechasSegunMes);

// Función para cerrar el modal si se hace clic fuera del contenedor
function cerrarModalFueraDelContenedor(event) {
  const modal = document.getElementById('ModalfiltroInforme');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
}

// Agregar evento al documento para cerrar el modal fuera del contenedor
document.addEventListener('click', cerrarModalFueraDelContenedor);
