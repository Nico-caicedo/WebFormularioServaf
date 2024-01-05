// const contadorUsuarios = document.getElementById('contadorUsuarios');

// function actualizarContadorUsuarios() {
//   fetch('./php/contadorUsuarios.php') // Reemplaza esto con la ruta de tu endpoint
//     .then(response => response.json())
//     .then(data => {
//       contadorUsuarios.textContent = `Empleados: ${data.cantidad}`;
//     })
//     .catch(error => {
//       console.error('Error al obtener la cantidad de usuarios:', error);
//     });
// }

// // Llama a la función inicialmente y luego cada cierto intervalo de tiempo (por ejemplo, cada 5 segundos)
// actualizarContadorUsuarios();
// setInterval(actualizarContadorUsuarios, 5000); // Actualiza cada 5 segundos (5000 milisegundos)


// const contadorDependencias = document.getElementById('contadorDependencias');

// function actualizarContadorDependencias() {
//   fetch('./php/contadorDependencias.php') // Reemplaza esto con la ruta de tu endpoint
//     .then(response => response.json())
//     .then(data => {
//         contadorDependencias.textContent = `Dependencias: ${data.cantidad}`;
//     })
//     .catch(error => {
//       console.error('Error al obtener la cantidad de dependencias:', error);
//     });
// }

// // Llama a la función inicialmente y luego cada cierto intervalo de tiempo (por ejemplo, cada 5 segundos)
// actualizarContadorDependencias();
// setInterval(actualizarContadorDependencias, 1000); // Actualiza cada 5 segundos (5000 milisegundos)


// const contadorCargos = document.getElementById('contadorCargos');

// function actualizarContadorCargos() {
//   fetch('./php/contadorCargos.php') // Reemplaza esto con la ruta de tu endpoint
//     .then(response => response.json())
//     .then(data => {
//         contadorCargos.textContent = `Cargos: ${data.cantidad}`;
//     })
//     .catch(error => {
//       console.error('Error al obtener la cantidad de cargos:', error);
//     });
// }

// // Llama a la función inicialmente y luego cada cierto intervalo de tiempo (por ejemplo, cada 5 segundos)
// actualizarContadorCargos();
// setInterval(actualizarContadorCargos, 1000); // Actualiza cada 5 segundos (5000 milisegundos)
