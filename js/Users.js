$(document).ready(function () {
    function cargarYRenderizarUsuarios(searchTerm) {
        // Obtener la URL correcta para la solicitud AJAX
        var url = './php/buscarUsuarios.php';
        var method = 'GET';
        var requestData = {};

        // Si hay un término de búsqueda, cambiar la URL y el método
        if (searchTerm) {
            url = './php/buscarUsuarios.php';
            method = 'POST';
            requestData = { searchTerm: searchTerm };
        }

        // Realizar la solicitud AJAX
        $.ajax({
            url: url,
            method: method,
            data: requestData,
            dataType: 'json',
            success: function (data) {
                renderizarUsuarios(data);
            },
            error: function (error) {
                console.error('Error en la solicitud ajax:', error);
            }
        });
    }

    // Función para renderizar usuarios
    function renderizarUsuarios(data) {
        $('#Users').empty();

        if (data.length > 0 && data[0].mensaje) {
            // Mostrar mensaje de no hay resultados
            $('#Users').html('<div class="SinInfo"><img src="./img/search.png"><p>' + data[0].mensaje + '</p></div>');
        } else {
            // Mostrar los resultados en el contenedor
            $.each(data, function (index, usuario) {
                // Construir el elemento HTML para cada usuario
                var html = construirHTMLUsuario(usuario);

                // Agregar el elemento HTML al contenedor
                $('#Users').append(html);
            });

            // Iterar sobre los elementos con la clase "estados" y agregar el evento CambiarEstado
            $('.estados').each(function () {
                $(this).on("click", CambiarEstado);
            });
        }
    }

    // Función para construir el HTML de un usuario
    function construirHTMLUsuario(usuario) {
        return '<div class="itemProfileview">' +
            '<div class="profileAbout">' +
            '<img src="' + usuario.imagen + '" alt="" />' +
            '<span>' +
            '<b>' + usuario.nombre + '</b>' +
            '<p>' + usuario.cargo + '</p>' +
            '</span>' +
            '</div>' +
            '<div class="profileDocument">' +
            '<b>Correo</b>' +
            '<p>' + usuario.correo + '</p>' +
            '</div>' +
            '<div class="profileDocument">' +
            '<b>Teléfono</b>' +
            '<p>' + usuario.telefono + '</p>' +
            '</div>' +
            '<div class="show" onclick="AbrirVentanaS(this)" data-eva="' + usuario.idEvaluados + '" data-infoUser="' + usuario.idUsuario + '">' +
            '<img class="iconss" src="./img/see.png">' +
            '</div>' +
            '<div class="estados ' + usuario.estado.toLowerCase() + '">' +
            '<input type="hidden" class="Estado" value="' + usuario.idUsuario + '">' +
            '<p class="NameState">' + usuario.estado + '</p>' +
            '</div>' +
            '<div class="edit">' +
            '<input type="hidden" id="inactivo-' + usuario.idUsuario + '" name="estadoCliente[' + usuario.estado + ']" value="2" ' + (usuario.estado == 'Inactivo' ? 'checked' : '') + '>' +
            '<p>Editar</p>' +
            '</div>' +
            '</div>';
    }

    // Función para cambiar el estado de un usuario
    function CambiarEstado() {
        var contenedor = $(this);
        var input = contenedor.find('.Estado');
        var valorInput = input.val();

        var estadoActivo = 1;
        var estadoInactivo = 2;

        console.log('Funciona para cambio. Valor del input:', valorInput);

        function hacerSolicitudFetch(estado) {
            var data = 'idUpdate=' + encodeURIComponent(valorInput) + '&estado=' + encodeURIComponent(estado);

            $.ajax({
                url: './php/modificarEstado.php',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        if (estado === estadoActivo) {
                            contenedor.removeClass('inactivo').addClass('activo');
                            contenedor.find('p.NameState').text('Activo');
                        } else {
                            contenedor.removeClass('activo').addClass('inactivo');
                            contenedor.find('p.NameState').text('Inactivo');
                        }
                    } else {
                        console.error('Error:', data.message);
                    }
                },
                error: function (error) {
                    console.error('Error en la solicitud ajax:', error);
                }
            });
        }

        if (contenedor.hasClass('activo')) {
            hacerSolicitudFetch(estadoInactivo);
        } else {
            hacerSolicitudFetch(estadoActivo);
        }
    }

     // Variable para almacenar el contenido original
     var contenidoOriginal = $('#Users').html();


    cargarYRenderizarUsuarios();

    // Manejar el evento de entrada en el campo de búsqueda
    $('#searchInput').on('input', function () {
        // Obtener el valor del campo de búsqueda
        var searchTerm = $(this).val();

        // Cargar y renderizar usuarios con el término de búsqueda
        cargarYRenderizarUsuarios(searchTerm);
    });
});


var fileInput = document.getElementById('fileInput');

// Agrega un evento de cambio al elemento de entrada de tipo archivo
fileInput.addEventListener('change', function () {
    // Obtén la primera (y única) archivo seleccionado
    var file = fileInput.files[0];

    if (file) {
        // Crea un objeto URL para la imagen seleccionada
        var imageURL = URL.createObjectURL(file);

        // Obtén referencia al elemento de imagen
        var previewImage = document.getElementById('previewImage');

        // Establece la fuente de la imagen con la URL creada
        previewImage.src = imageURL;
    }
});


var addUserForm = document.getElementById('addUser');

    addUserForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Crear un objeto FormData con los datos del formulario
        var formData = new FormData(addUserForm);

        // Enviar los datos del formulario al servidor utilizando fetch
        fetch('URL_DEL_SERVIDOR', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Manejar la respuesta del servidor
            console.log('Respuesta del servidor:', data);
        })
        .catch(error => {
            // Manejar errores de la solicitud
            console.error('Error al enviar la solicitud:', error);
        });
    });