const selectVinculacion = document.getElementById('TV');
const contenedor = document.getElementById('containerInputFecha');

selectVinculacion.addEventListener('change', () => {
    aparecerInputsFecha();
});

function aparecerInputsFecha() {
    // Eliminar los inputs existentes si los hay
    contenedor.innerHTML = '';

    if (selectVinculacion.value === '2' || selectVinculacion.value === '3' || selectVinculacion.value === '4') {
        // Crear un elemento de párrafo (p) para agrupar los elementos
        const p1 = document.createElement('p');
        const p2 = document.createElement('p');

        // Crear input de fecha de inicio
        const labelInicio = document.createElement('label');
        labelInicio.textContent = 'Fecha de Inicio:';
        const inputInicio = document.createElement('input');
        inputInicio.type = 'date';
        inputInicio.id = 'fechainicio';
        inputInicio.classList.add('inputs');
        inputInicio.name = 'fi'; // Nombre del input de fecha de inicio

        // Crear input de fecha de fin
        const labelFin = document.createElement('label');
        labelFin.textContent = 'Fecha de Fin:';
        const inputFin = document.createElement('input');
        inputFin.type = 'date';
        inputFin.classList.add('inputs');
        inputFin.id = 'fechafin';
        inputFin.name = 'fn'; // Nombre del input de fecha de fin

        // Agregar los elementos al párrafo (p)
        p1.appendChild(labelInicio);
        p1.appendChild(inputInicio);
        p2.appendChild(labelFin);
        p2.appendChild(inputFin);

        // Agregar el párrafo (p) al contenedor
        contenedor.appendChild(p1);
        contenedor.appendChild(p2);
    }
}
