
// js para el formm y mostrar los mensajes del php eliminardependecias
function sendForm(event, eliminarC, link) {
    event.preventDefault();
    const form = document.getElementById(eliminarC);
    const formData = new FormData(form);

    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true || data.status === 'success') {
                ventanaeliminarCa();
                // Actualizar el contenido de la ventana después de eliminar la evaluación
                $('#containercargos').load(location.href + ' #containercargos>*', '');
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'warning') {
                ventanaeliminarCa();
                toastr.warning(data.message);
            }else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function ventanaeliminarCa() {
    // Mostrar la ventana u realizar otras operaciones si es necesario
    var ventanaeliminarC = document.getElementById("ventanaeliminarC");
    if (ventanaeliminarC) {
        ventanaeliminarC.style.display = "none";
    }
}
