const formularioN = document.getElementById("forma_novedad");

formularioN.addEventListener("submit", function (event) {
  event.preventDefault(); // Evita que el formulario se envíe de manera convencional
  
  const datosFormulario = new FormData(formularioN);

  // Realiza una solicitud POST al servidor para enviar los datos
  fetch("php/novedad.php", {
    method: 'POST',
    body: datosFormulario
  })
  .then(response => response.json()) // Si esperas una respuesta JSON del servidor
  .then(data => {
    // Maneja la respuesta del servidor aquí
    if(data.success === true){
    
      formularioN.reset();
      cerrarFormularioN();
      alert('Novedad guardada correctamente');
    }
  })
  .catch(error => {
    // Maneja los errores aquí
    console.error("Error al enviar la solicitud:", error);
  });
});