// Obtén todos los elementos con la clase "estados"
var elementos = document.querySelectorAll(".estados");

function CambiarEstado(event) {
    // Obtén la lista de clases del elemento actual
    var clases = this.classList;
    var contenedor = event.currentTarget;
    var input = contenedor.querySelector('input');
    var valorInput = input.value;
    
    // Define los valores de estado
    var estadoActivo = 1;
    var estadoInactivo = 2;

    // Muestra el valor en la consola
    console.log('Funciona para cambio. Valor del input:', valorInput);

    // Define la función para hacer la solicitud fetch
    function hacerSolicitudFetch(estado) {
        var ID = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'idUpdate=' + encodeURIComponent(valorInput) + '&estado=' + encodeURIComponent(estado),
        };

        fetch('./php/modificarEstado.php', ID)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (estado === estadoActivo) {
                        clases.remove('inactivo');
                        clases.add('activo');
                        contenedor.querySelector('p').textContent = 'Activo';
                    } else {
                        clases.remove('activo');
                        clases.add('inactivo');
                        contenedor.querySelector('p').textContent = 'Inactivo';
                    }
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Error en la solicitud fetch:', error);
            });
    }

    // Verifica si la clase "activo" está presente
    if (clases.contains('activo')) {
        hacerSolicitudFetch(estadoInactivo);
    } else {
        hacerSolicitudFetch(estadoActivo);
    }
}

// Itera sobre la colección de elementos y agrega el evento a cada uno
elementos.forEach(elemento => {
    elemento.addEventListener("click", CambiarEstado);
});
