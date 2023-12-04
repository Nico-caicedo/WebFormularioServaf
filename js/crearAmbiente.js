$(document).ready(function () {
    $("#registrarAmbiente").submit(function (e) {
        e.preventDefault(); // Prevenir el comportamiento de envío predeterminado del formulario

        var formData = new FormData(this);
        formData.append('crearAmbiente', true);
        $.ajax({
            url: 'php/crearAmbiente.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Especifica que esperas una respuesta en formato JSON
            success: function (response) {
                console.log(response);
                if (response.success) {
                    alert(response.success);
                    document.getElementById('registrarAmbiente').reset();
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
