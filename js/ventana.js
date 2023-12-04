
var modal = document.getElementById('modalCargueAsignaciones');

modal.style.display = 'none';

function mostrarCargueAsignacion() {
    modal.style.display = 'flex';
}


function cerrarCargueAsignacion() {
    modal.style.display = 'none';
}

window.addEventListener("click", function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});


