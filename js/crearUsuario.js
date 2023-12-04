$(document).ready(function () {
    $("#registrarUsuario").submit(function (e) {
        e.preventDefault(); // Prevenir el comportamiento de envío predeterminado del formulario

        var formData = new FormData(this);
        formData.append('crearUsuario', true);
        $.ajax({
            url: 'php/crearUsuario.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Especifica que esperas una respuesta en formato JSON
            success: function (response) {
                console.log(response);
                if (response.success) {
                    alert(response.success);
                    document.getElementById('registrarUsuario').reset();
                    $('#Usuarios').load(location.href + ' #Usuarios>*', '');
                } else if (response.error) {
                    alert(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
