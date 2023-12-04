// Función para cargar los datos del carrusel
function cargarDatosCarrusel() {
    limpiarContenedor();
    obtenerDatosSlider();
}

// Función para limpiar el contenido del carrusel
function limpiarContenedor() {
    const mainCarrusel = document.getElementById('mainCarrusel');
    mainCarrusel.innerHTML = '';

    // También puedes restablecer el contenido del slider aquí
    const swiperWrapper = document.querySelector('.swiper-wrapper');
    swiperWrapper.innerHTML = ''; // Esto elimina todos los elementos hijos del slider
}

// Función para obtener los datos del slider desde el servidor
function obtenerDatosSlider() {
    fetch('php/mostrarSlider.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                actualizarTexto(data.textoNoticia);
                crearImagenesSlider(data.imagenes);
                inicializarCarrusel();
                crearTarjetasCarrusel(data.id, data.imagenes);
                configurarEliminacionSostenida(); // Nueva función para eliminar con confirmación
            } else {
                console.log('No se encontraron imágenes.');
            }
        })
        .catch(error => {
            console.error(error);
        });
}

// Función para actualizar el contenido de texto
function actualizarTexto(texto) {
    document.getElementById("textoAnuncio").textContent = texto;
    document.getElementById("textoAnuncio").title = texto;
    document.getElementById('T100').value = texto;
    document.getElementById('T1000').value = texto;
}

// Función para crear imágenes en el slider
function crearImagenesSlider(imagenes) {
    const swiperWrapper = document.querySelector('.swiper-wrapper');
    imagenes.forEach((imagen) => {
        const slide = document.createElement('div');
        slide.classList.add('swiper-slide');

        const img = document.createElement('img');
        img.src = imagen;
        img.alt = '';

        slide.appendChild(img);
        swiperWrapper.appendChild(slide);
    });
}

// Función para inicializar el carrusel
function inicializarCarrusel() {
    const swiper = new Swiper('.swiper-container', {
        // Configuración de Swiper
    });
}

// Función para crear tarjetas en el carrusel adicional
function crearTarjetasCarrusel(idImagenes, imagenes) {
    const mainCarrusel = document.getElementById('mainCarrusel');

    idImagenes.forEach((idImagen, index) => {
        const articleA = document.createElement('article');
        articleA.classList.add('cardCarrusel');

        const inputHidd = document.createElement('input');
        inputHidd.classList.add('idImagenDelete');
        inputHidd.type = 'hidden';
        inputHidd.value = idImagen;

        const imgA = document.createElement('img');
        imgA.src = imagenes[index];
        imgA.alt = '';

        articleA.appendChild(imgA);
        articleA.appendChild(inputHidd);

        mainCarrusel.appendChild(articleA);
    });
}


// Función para configurar la eliminación de tarjetas al sostenerlas
function configurarEliminacionSostenida() {
    const cards = document.querySelectorAll('.cardCarrusel');
    let timeoutId = 0;

    cards.forEach((card) => {
        card.addEventListener('mousedown', () => {
            timeoutId = setTimeout(() => {
                card.classList.add('condicionCumplida');
                const idImagen = card.querySelector('.idImagenDelete').value;
                confirmarEliminacion(idImagen);
            }, 1200); // 1.2 segundos
        });

        card.addEventListener('mouseup', () => {
            clearTimeout(timeoutId);
            card.classList.remove('condicionCumplida');
        });

        // Agregar detección de doble clic (doble tap) en dispositivos móviles
        let lastTouchEnd = 0;
        const delay = 300; // 300 milisegundos

        card.addEventListener('touchend', (event) => {
            const currentTime = new Date().getTime();
            const tapLength = currentTime - lastTouchEnd;

            if (tapLength < delay && tapLength > 0) {
                // Se detectó un doble toque (doble tap) en la tarjeta
                card.classList.add('condicionCumplida');
                const idImagen = card.querySelector('.idImagenDelete').value;
                confirmarEliminacion(idImagen);
                event.preventDefault();
            }

            lastTouchEnd = currentTime;
        });
    });
}


// Función para confirmar la eliminación de una tarjeta
function confirmarEliminacion(idImagen) {
    Swal.fire({
        title: '¿Estás seguro de eliminar esta imagen?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarImagenCarrusel(idImagen);
        } else {
            // Remover la clase 'condicionCumplida' si se cancela la eliminación
            const cards = document.querySelectorAll('.cardCarrusel');
            cards.forEach((card) => {
                card.classList.remove('condicionCumplida');
            });
        }
    });
}


// Función para eliminar una imagen del carrusel
function eliminarImagenCarrusel(idImagen) {
    document.getElementById('carga').style.display = 'grid';
    fetch('php/eliminarImagenCarrusel.php', {
        method: 'POST',
        body: JSON.stringify({ idImagen: idImagen }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('carga').style.display = 'none';
                Swal.fire({
                    title: 'Imagen eliminada correctamente.',
                    icon: 'success',
                });
                cargarDatosCarrusel();
            } else {
                Swal.fire({
                    title: 'Error al eliminar la imagen.',
                    icon: 'error',
                });
            }
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                title: 'Error en la solicitud al servidor.',
                icon: 'error',
            });
        });
}



// Llama a cargarDatosCarrusel al cargar la página
cargarDatosCarrusel();

// Función para manejar el envío del formulario
function enviarFormularioCarrusel() {
    const carruselNoticias = document.getElementById('carruselNoticias');

    carruselNoticias.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(carruselNoticias);
        document.getElementById('carga').style.display = 'grid';
        fetch('php/guardarImagenCarrusel.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success === true) {
                    document.getElementById('carga').style.display = 'none';
                    alert("Se guardaron correctamente los cambios");

                    carruselNoticias.reset();
                    cargarDatosCarrusel();
                } else {
                    alert("Hubo un error al guardar los cambios.");
                }
            })
            .catch(error => {
                console.error(error);
                alert("Error en la solicitud al servidor.");
            });
    });
}

// Llama a la función para manejar el envío del formulario
enviarFormularioCarrusel();

function validar100() {
    const inputField = document.getElementById('T100');

    inputField.addEventListener('input', () => {
        if (inputField.value.length > 80) {

            toastr.warning('El texto no debe superar los 100 caracteres', '', {
                positionClass: 'toast-top-right', 
                timeOut: 3000, 
                progressBar: true, 
                closeButton: false 
            });
        }
    });
}

validar100();


function MostrarTitulo() {
    if (window.innerWidth < 768) {
        const textoAnuncio = document.getElementById('textoAnuncio');
        textoAnuncio.addEventListener('click', () => {
            const titulo = textoAnuncio.getAttribute('title');
            alert(titulo);
        });
    }
}

MostrarTitulo();
