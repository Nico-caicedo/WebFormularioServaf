$(document).ready(function () {
    $("#cargarExcelAmbientes").submit(function (e) {
        e.preventDefault(); // Prevenir el comportamiento de envío predeterminado del formulario

        var formData = new FormData(this);
        console.log(formData);
        formData.append('guardarDatosAmbientes', true);
        $.ajax({
            url: 'php/cargarExcelAmbientes.php',
            type: 'POST',
            data: formData,  
            contentType: false,
            processData: false,
            dataType: 'json', // Especifica que esperas una respuesta en formato JSON
            success: function (response) {
                console.log(response);
                if (response.success) {
                    alert(response.success);
                    $('#Ambientes').load(location.href + ' #Ambientes>*', '');
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
