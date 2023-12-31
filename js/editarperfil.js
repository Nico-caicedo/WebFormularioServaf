// Función para manejar el envío del formulario y mostrar mensajes
function editarperfil(event, editardatosperfil, link) {
    event.preventDefault();
    const form = document.getElementById(editardatosperfil);
    const formData = new FormData(form);

    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === 'success') {
                cerrarVentanaeditarP();
                toastr.success(data.message);
            } else if (data.status === 'error') {
                
                if (data.errors) {
                    Object.keys(data.errors).forEach((key) => {
                        toastr.error(data.errors[key]);
                    });
                }
            }
        })
        .catch((error) => console.error('Error:', error));
}

// Función para cerrar la ventana
function cerrarVentanaeditarP() {
    const ventanaeditarP = document.getElementById("ventanaeditarP");
    if (ventanaeditarP) {
        ventanaeditarP.style.display = "none";
    }
}
