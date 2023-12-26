function sendForm(event, formeliminareva, link) {
    event.preventDefault();
    const form = document.getElementById(formeliminareva);
    const formData = new FormData(form);

    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status) {
                // Actualizar el contenido de la ventana después de eliminar la evaluación
                cerrarVentanaEliminar()
                actualizarContenidoVentana();
       
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function actualizarContenidoVentana() {
    var ContainerEvas = document.getElementsByClassName("Evas_container")[0];
    deleteEva = document.getElementById('evadelet').value;

    var requestBody = "deleteEva=" + encodeURIComponent(deleteEva);

    fetch("./php/reloadEvas.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: requestBody,
    })
        .then((response) => response.json())
        .then((data) => {
            // Insertar la respuesta en el contenedor EVAS_CONTAINER
            ContainerEvas.innerHTML = data.containerContent;
        })
        .catch((error) => {
            console.error("Error en la solicitud:", error);
        });
}


function cerrarVentanaEliminar() {


    // Mostrar la ventana u realizar otras operaciones si es necesario
    var ventanaeliminar = document.getElementById("ventanaeliminar");
    if (ventanaeliminar) {
        ventanaeliminar.style.display = "none";
    }
}
