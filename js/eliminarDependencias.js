
// js para el formm y mostrar los mensajes del php eliminardependecias
function sendForm(event, eliminarD, link) {
    event.preventDefault();
    const form = document.getElementById(eliminarD);
    const formData = new FormData(form);

    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true || data.status === 'success') {
                cerrarVentanaEliminarD();
                // Actualizar el contenido de la ventana después de eliminar la evaluación
                $('#containerdependencias').load(location.href + ' #containerdependencias>*', '');
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'warning') {
                cerrarVentanaEliminarD();
                toastr.warning(data.message);
            }else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function cerrarVentanaEliminarD() {
    // Mostrar la ventana u realizar otras operaciones si es necesario
    var ventanaeliminarD = document.getElementById("ventanaeliminarD");
    if (ventanaeliminarD) {
        ventanaeliminarD.style.display = "none";
    }
}
