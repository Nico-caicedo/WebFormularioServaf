document.addEventListener('DOMContentLoaded', function () {
    // Agregar un evento de clic al botón de descarga
    document.getElementById('descargarCSV').addEventListener('click', function () {
        // Enviar una solicitud a tu script PHP a través de una petición AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/descargarPlantillaUsuarios.php', true);
        xhr.responseType = 'blob'; // Especifica el tipo de respuesta como binaria

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Crear un enlace para descargar el archivo
                var blob = new Blob([xhr.response], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'plantillaCargueUsuarios.csv';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            }
        };

        // Envía la solicitud
        xhr.send();
    });
});