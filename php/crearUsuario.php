<?php
include 'Conexion.php';

$response = array();
if (isset($_POST['crearUsuario'])) {
    $nombreUsuario = $_POST['nombreUsuario'];
    $apellidoUsuario = $_POST['apellidoUsuario'];
    $documento = $_POST['documento'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];
    $tipoVinculacion = $_POST['TV'];

    if (isset($_POST['fi']) and isset($_POST['fn'])) {
        $fi = $_POST['fi'];
        $fn = $_POST['fn'];
    } else {
        $fi = 0;
        $fn = 0;
    }

    $idestado = 1;
    $ruta = 'img/default.jpg';
    $ruta_imagen = basename($ruta);

    // Validar que la imagen se haya cargado correctamente
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $carpeta_destino = "../imgusuario/";
        $nombre_archivo = $_FILES['imagen']['name'];
        $archivo_subido = $_FILES['imagen']['tmp_name'];
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($archivo_subido, $ruta_archivo)) {
            $imagen = $ruta_archivo;
            $ruta_imagen = basename($imagen);
        } else {
            $response['error'] = 'Ha ocurrido un error al guardar la imagen. Por favor, inténtelo de nuevo.';
        }
    } else {
        $response['error'] = 'Error al cargar la imagen. Por favor, inténtelo de nuevo.';
    }

    if (empty($nombreUsuario) || empty($apellidoUsuario) || empty($documento) || empty($password) || empty($correo) || empty($telefono) || empty($rol) || empty($tipoVinculacion)) {
        $response['error'] = "Por favor, complete todos los campos antes de enviar el formulario.";
    } elseif (empty($nombreUsuario) || $nombreUsuario === "0") {
        $response['error'] = 'El NOMBRE de usuario es inválido';
    } elseif (empty($apellidoUsuario) || $apellidoUsuario === "0") {
        $response['error'] = 'El APELLIDO es inválido';
    } elseif ($documento === "0") {
        $response['error'] = 'El número de DOCUMENTO es inválido';
    } elseif (empty($password)) {
        $response['error'] = 'La CONTRASEÑA es requerida';
    } elseif (empty($correo) || $correo === "0" || preg_match('/^0+$/', $correo)) {
        $response['error'] = 'El CORREO es inválido';
    } elseif (empty($documento) || $documento === "0" || preg_match('/^0+$/', $documento)) {
        $response['error'] = 'El número de DOCUMENTO es inválido';
    } elseif (empty($telefono) || $telefono === "0" || preg_match('/^0+$/', $telefono) || !preg_match('/^\d{10}$/', $telefono)) {
        $response['error'] = 'El número de TELEFONO es inválido';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $nombreUsuario)) {
        $response['error'] = 'El NOMBRE no debe contener números o ceros';
    } elseif (preg_match('/\d/', $apellidoUsuario)) {
        $response['error'] = 'El APELLIDO no debe contener números o ceros';
    } else {
        $sql_existe = "SELECT * FROM usuario WHERE documento = ? OR correo = ?";
        $stmt = mysqli_prepare($conexion, $sql_existe);
        mysqli_stmt_bind_param($stmt, "ss", $documento, $correo);
        mysqli_stmt_execute($stmt);
        $resultado_usuario = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado_usuario) === 0) {
            $sql_crear_usuario = "INSERT INTO usuario(nombre_usuario, apellido, documento, password_usuario,correo,telefono,idestado,idrol, imagen, fechainiciocontrato, fechafincontrato, idvinculacion ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($conexion, $sql_crear_usuario);
            mysqli_stmt_bind_param($stmt, "ssssssiisssi", $nombreUsuario, $apellidoUsuario, $documento, $password, $correo, $telefono, $idestado, $rol, $ruta_imagen, $fi, $fn, $tipoVinculacion);
            $usuario_insertado = mysqli_stmt_execute($stmt);

            if ($usuario_insertado) {
                $response['success'] = 'El usuario se creó satisfactoriamente';
            } else {
                $response['error'] = 'Hubo un error al crear el usuario';
            }
        } else {
            $response['error'] = 'El usuario ya existe con el mismo correo o documento';
        }
    }

    // Cerrar la conexión a la base de datos después de finalizar todas las operaciones
    $conexion->close();

    echo json_encode($response);
}
