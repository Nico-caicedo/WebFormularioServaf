<?php
require_once("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $documento = $_POST["documento"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    // Validaciones
    $errores = array();

    // Validación de nombre y apellido: solo letras permitidas
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/", $nombre)) {
        $errores['nombre'] = "El nombre solo puede contener letras y espacios.";
    }
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/", $apellido)) {
        $errores['apellido'] = "El apellido solo puede contener letras y espacios.";
    }

    // Validación del documento: solo números entre 6 y 10 dígitos
    if (!preg_match("/^[0-9]{6,10}$/", $documento)) {
        $errores['documento'] = "El documento debe contener entre 6 y 10 dígitos numéricos.";
    }

    // Validación del teléfono: solo números y exactamente 10 dígitos
    if (!preg_match("/^[0-9]{10}$/", $telefono)) {
        $errores['telefono'] = "El teléfono debe contener exactamente 10 dígitos numéricos.";
    }

    if (empty($errores)) {
        // Consulta para obtener los datos actuales del usuario
        $sql_actual = "SELECT Nombre1, Apellido1, Document, pasword, correo, telefono, FotoPerfil FROM users WHERE IdUser=?";
        $stmt_actual = $conexion->prepare($sql_actual);
        $stmt_actual->bind_param("i", $id_usuario);
        $stmt_actual->execute();
        $result_actual = $stmt_actual->get_result();
        $row_actual = $result_actual->fetch_assoc();

        // Comprobar si los datos son iguales a los actuales
        if (
            $nombre === $row_actual['Nombre1'] &&
            $apellido === $row_actual['Apellido1'] &&
            $documento === $row_actual['Document'] &&
            $password === $row_actual['pasword'] &&
            $correo === $row_actual['correo'] &&
            $telefono === $row_actual['telefono'] &&
            $_FILES['imagen']['error'] !== UPLOAD_ERR_OK
        ) {
            $response = array('status' => 'info', 'message' => 'Aún no hay cambios');
        } else {
            // Si hay cambios, procede con la actualización
            $sql = "UPDATE users SET Nombre1=?, Apellido1=?, Document=?, pasword=?, correo=?, telefono=? WHERE IdUser=?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssssssi", $nombre, $apellido, $documento, $password, $correo, $telefono, $id_usuario);

            if ($stmt->execute()) {
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $imagen_nombre = $_FILES['imagen']['name'];
                    $imagen_temp = $_FILES['imagen']['tmp_name'];
                    $imagen_ruta = '../imgusuario/' . $imagen_nombre;
                    
                    // Mueve la imagen a la carpeta de destino
                    move_uploaded_file($imagen_temp, $imagen_ruta);

                    // Actualiza el campo imagen
                    $sql_imagen = "UPDATE users SET FotoPerfil=? WHERE IdUser=?";
                    $stmt_imagen = $conexion->prepare($sql_imagen);
                    $stmt_imagen->bind_param("si", $imagen_nombre, $id_usuario);
                    $stmt_imagen->execute();
                }
                $response = array('status' => 'success', 'message' => 'Perfil Actualizado');
            } else {
                $response = array('status' => 'error', 'message' => 'Error al actualizar información');
            }

            $stmt->close();
        }

        $stmt_actual->close();
        $conexion->close();
    } else {
        // Si hay errores de validación, mostramos esos errores
        $response = array('status' => 'error', 'message' => 'Error en los datos enviados.', 'errors' =>$errores );
    }

    // Enviar la respuesta al cliente
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Acceso no autorizado');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
