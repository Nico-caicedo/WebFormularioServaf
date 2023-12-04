// cierra sesión





function cerrarSesion() {
  if (confirm('¿Está seguro de cerrar sesión?')) {
    // Hacer una solicitud al servidor para cerrar la sesión utilizando fetch.
    fetch('./php/cerrar.php', {
      method: 'POST', // Puedes usar 'GET' o 'POST' según tu configuración.
      credentials: 'same-origin' // Para enviar las cookies de sesión si es necesario.
    })
    .then(response => {
      if (response.ok) {
        // El servidor debería manejar la lógica de cierre de sesión.
        // Puedes redirigir al usuario a la página de inicio de sesión u otra página deseada.
        window.location.href = './index.php'; // Reemplaza '/inicio-de-sesion' con la URL real.
      } else {
        console.error('Error al cerrar sesión:', response.statusText);
        // Manejar errores aquí si es necesario.
      }
    })
    .catch(error => {
      console.error('Error al cerrar sesión:', error);
      // Manejar errores aquí si es necesario.
    });
  }
}