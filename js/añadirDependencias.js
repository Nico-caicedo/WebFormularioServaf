
// js para el formm y mostrar los mensajes del php eliminardependecias
function sendFormañadirD(event, añadirD, link) {
    event.preventDefault();
    const form = document.getElementById(añadirD);
    const formData = new FormData(form);

    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true || data.status === 'success') {
                cerrarVentanaanadirD();
                $('#selectcargo').load(location.href + ' #selectcargo>*', '');
                $('#selector').load(location.href + ' #selector>*', '');
                // Actualizar el contenido de la ventana después de eliminar la evaluación
                $('#containerdependencias').load(location.href + ' #containerdependencias>*', '');
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'warning') {
                toastr.warning(data.message);
            }else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function cerrarVentanaanadirD() {
    // Mostrar la ventana u realizar otras operaciones si es necesario
    const ventanaañadirD = document.getElementById("ventanaañadirD");
    if (ventanaañadirD) {
        ventanaañadirD.style.display = "none";
    }
}