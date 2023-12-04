<?php
require_once ("Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $documento = $_POST["documento"];
    $password = $_POST["password"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    // Consulta para actualizar la información del usuario
    $sql = "UPDATE usuario SET nombre_usuario=?, apellido=?, documento=?, password_usuario=?, correo=?, telefono=? WHERE idusuario=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido, $documento, $password, $correo, $telefono, $id_usuario);

    if ($stmt->execute()) {
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_temp = $_FILES['imagen']['tmp_name'];
            $imagen_ruta = '../imgusuario/' . $imagen_nombre;
            
            // Mueve la imagen a la carpeta de destino
            move_uploaded_file($imagen_temp, $imagen_ruta);

            // Actualiza el campo imagen
            $sql_imagen = "UPDATE usuario SET imagen=? WHERE idusuario=?";
            $stmt_imagen = $conexion->prepare($sql_imagen);
            $stmt_imagen->bind_param("si", $imagen_nombre, $id_usuario);
            $stmt_imagen->execute();
        }

        echo "<script>alert('Perfil actualizado'); window.location='../admin.php';</script>";
    } else {
        echo "Error al actualizar la información: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no autorizado.";
}
?>
