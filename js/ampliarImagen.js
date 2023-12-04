const modales = {}; // Objeto para almacenar las ventanas modales

function mostrarImagenAmpliada(imagen) {
    if (!modales[imagen.src]) { // Verifica si la ventana modal no está abierta
        // Crea una ventana modal
        const modal = document.createElement("div");
        modal.classList.add("moda-temporal-img");
        modal.style.position = "fixed";
        modal.style.top = "0";
        modal.style.left = "0";
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.background = "rgba(0, 0, 0, 0.5)"; // Fondo negro transparente
        modal.style.display = "flex";
        modal.style.justifyContent = "center";
        modal.style.alignItems = "center";
        modal.style.zIndex = "1000"; // Asegura que esté por encima de otros elementos

        // Crea la imagen ampliada dentro de la ventana modal
        const imgAmpliada = new Image();
        imgAmpliada.src = imagen.src;
        imgAmpliada.style.maxWidth = "90%";
        imgAmpliada.style.maxHeight = "90%";
        imgAmpliada.style.transition = "transform 0.2s"; // Agrega una transición suave

        modal.appendChild(imgAmpliada);
        document.body.appendChild(modal);

        // Cierra la ventana modal al hacer clic fuera de la imagen
        modal.addEventListener("click", function (event) {
            if (event.target === modal) {
                document.body.removeChild(modal);
                modales[imagen.src] = null; // Marca la ventana modal como cerrada
            }
        });

        modales[imagen.src] = modal; // Almacena la ventana modal en el objeto
    } else {
        // Si la ventana modal ya está abierta, ciérrala al tercer clic
        document.body.removeChild(modales[imagen.src]);
        modales[imagen.src] = null; // Marca la ventana modal como cerrada
    }
}

function cerrarImagen(imagen) {
    if (modales[imagen.src]) {
        // Si la ventana modal está abierta, ciérrala al primer clic fuera de la imagen
        document.body.removeChild(modales[imagen.src]);
        modales[imagen.src] = null; // Marca la ventana modal como cerrada
    }
}




