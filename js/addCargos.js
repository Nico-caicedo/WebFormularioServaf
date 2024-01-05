
// js para el formm y mostrar los mensajes del php eliminardependecias
function sendFormaddC(event, addC, link) {
    event.preventDefault();
    const form = document.getElementById(addC);
    const formData = new FormData(form);

    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true || data.status === 'success') {
                cerrarVentanaanadirC();
                
                // Actualizar el contenido de la ventana después de eliminar la evaluación
                $('#containercargos').load(location.href + ' #containercargos>*', '');
                toastr.success(data.message);
            }else if (data.status === false || data.status === 'info') {
                toastr.info(data.message);
            } else if (data.status === false || data.status === 'warning') {
                toastr.warning(data.message);
            }else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function cerrarVentanaanadirC() {
    // Mostrar la ventana u realizar otras operaciones si es necesario
    const ventanaañadirC  = document.getElementById("ventanaañadirC");
    if (ventanaañadirC) {
        ventanaañadirC.style.display = "none";
    }
}