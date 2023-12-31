
// js para el formm y mostrar los mensajes del php eliminardependecias
function sendFormeditarC(event, editarC, link) {
    event.preventDefault();
    const form = document.getElementById(editarC);
    const formData = new FormData(form);
    // const idCargo = document.getElementById('idCargo').value;
    // formData.append('idCargo', idCargo);
    fetch(link, {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true || data.status === 'success') {
                cerrarVentanaeditarD();
                $('#selectcargo').load(location.href + ' #selectcargo>*', '');
                $('#selector').load(location.href + ' #selector>*', '');
                // Actualizar el contenido de la ventana después de eliminar la evaluación
                $('#containercargos').load(location.href + ' #containercargos>*', '');
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'info') {
                toastr.info(data.message);
            }else if (data.status === false || data.status === 'warning') {
                toastr.warning(data.message);
            } else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function cerrarVentanaeditarD() {
    // Mostrar la ventana u realizar otras operaciones si es necesario
    const ventanaeditarD = document.getElementById("ventanaeditarD");
    if (ventanaeditarD) {
        ventanaeditarD.style.display = "none";
    }
}