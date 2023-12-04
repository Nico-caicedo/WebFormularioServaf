// Función para cargar los ambientes relacionados
function cargarAmbientes(idAmb) {
    fetch(`./php/call_ambientes.php?id_Amb=${idAmb}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar ambientes");
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            // Referenciamos la etiqueta select de ambientes
            var selectAmb = document.getElementById("list-ambientes");

            // Limpiamos el select antes de añadir nuevas opciones
            selectAmb.innerHTML = '';

            // Recorremos las opciones y las añadimos al select de ambientes
            data.forEach(function (opcion) {
                var option = document.createElement("option");
                option.value = opcion.id_asignacion;
                option.text = opcion.nombre;
                selectAmb.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

// Agregamos un evento de cambio al select de pisos
var selectPisos = document.getElementById("list-pisos");
console.log(selectetPisos);
selectPisos.addEventListener("change", function () {
    var selectedValue = selectPisos.value;
    
    cargarAmbientes(selectedValue);
});
