$(document).ready(function () {
    $("#cargarExcelUsuario").submit(function (e) {
        e.preventDefault(); // Prevenir el comportamiento de envío predeterminado del formulario

        var formData = new FormData(this);
        console.log(formData);
        formData.append('guardarDatosUsuario', true);
        $.ajax({
            url: 'php/cargarExcelUsuarios.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Especifica que esperas una respuesta en formato JSON
            success: function (response) {
                console.log(response);
                if (response.success) {
                    alert(response.success);
                    $('#Usuarios').load(location.href + ' #Usuarios>*', '');
                    $("#datosUsuarios").val('');
                } else if (response.error) {
                    alert(response.error);
                    $("#datosUsuarios").val('');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
