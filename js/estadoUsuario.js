document.getElementById('submitBtn').addEventListener('click', function () {
    var form = document.getElementById('estadoForm');
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/actualizarEstado.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert("Estados actualizados correctamente");
        }
    };
    xhr.send(formData);
});