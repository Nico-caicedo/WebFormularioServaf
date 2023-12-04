$(document).ready(function () {
    $("#cargarExcelAsignacion").submit(function (e) {
        e.preventDefault(); // Prevenir el comportamiento de envío predeterminado del formulario

        var formData = new FormData(this);
        formData.append('guardarDatosAsignacion', true);
        $.ajax({
            url: 'php/cargarExcelAsignacion.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Especifica que esperas una respuesta en formato JSON
            success: function (response) {
                console.log(response);
                if (response.success) {
                    alert(response.success);
                    // Limpiar el campo de entrada de archivos
                    $("#datosAsignacion").val('');
                } else if (response.error) {
                    alert(response.error);
                    $("#datosAsignacion").val('');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
