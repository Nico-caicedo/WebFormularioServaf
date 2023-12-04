<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "Conexion.php";

    // Obtén el valor del idImagen del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'));
    $idImagen = $data->idImagen;

    // Consulta la ruta de la imagen a eliminar en la base de datos
    $consulta = $conexion->query("SELECT rutaimagen FROM carruselnoticias WHERE idcarrusel = '$idImagen'");
    $imagen = $consulta->fetch_assoc();

    // Elimina la imagen de la carpeta si existe
    if ($imagen && file_exists('../imgusuario/' . $imagen['rutaimagen'])) {
        $rutaEliminar = '../imgusuario/' . $imagen['rutaimagen'];
        unlink($rutaEliminar);
    }

    // Elimina el registro de la base de datos
    $eliminar = $conexion->query("DELETE FROM carruselnoticias WHERE idcarrusel = '$idImagen'");

    if ($eliminar) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}
?>
