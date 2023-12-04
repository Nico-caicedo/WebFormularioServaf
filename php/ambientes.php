<?php

// // Función para insertar una nueva solicitud
// function insertarSolicitud($nombre, $ambiente, $caracteristicas) {
//     global $conexion;

//     // Validar y sanear las entradas (por ejemplo, usar prepared statements)
//     $nombre = mysqli_real_escape_string($conexion, $nombre);
//     $ambiente = mysqli_real_escape_string($conexion, $ambiente);
//     $caracteristicas = mysqli_real_escape_string($conexion, $caracteristicas);

//     $sql = "INSERT INTO solicitud (nombre, id_ambiente, caracteristicas, estado)
//             VALUES ('$nombre', '$ambiente', '$caracteristicas', 'pendiente')";

//     if ($conexion->query($sql) === TRUE) {
//         return true;
//     } else {
//         return false;
//     }
// }


if (isset($_POST["id_soli"])) {
    $id = $_POST['id_soli'];
    aceptarSolicitud($id);
}

if (isset($_POST["solici_r"])) {
    $id2 = $_POST['solici_r'];
    $texto = $_POST['text'];
    rechazarSolicitu($id2, $texto);
}



// Función para aceptar una solicitud
function aceptarSolicitud($id)
{
    include('Conexion.php');
    $sql = "UPDATE asignacion SET estado_ambiente = '2' WHERE idsolicitud = $id";

    if ($conexion->query($sql) === TRUE) {
        $ser = mysqli_query($conexion, "SELECT * FROM asignacion 
        INNER JOIN usuario ON asignacion.idusuario= usuario.idusuario
        INNER JOIN ambiente ON asignacion.idambiente= ambiente.idambiente
        WHERE idsolicitud = $id");
        $t = mysqli_fetch_assoc($ser);

        $dores = $t["correo"];
        $usuario = $t["nombre_usuario"];
        $ambiente = $t["nombre_ambiente"];
        $fecha = $t["fecha_inicio"];

        $tipo = 1;
        require_once "../controllers/enviarCorreo.php";
    }

}

// Función para rechazar una solicitud
function rechazarSolicitu($id, $tex)
{
    include('Conexion.php');
    $contenido = $tex;

    $sql = "UPDATE asignacion SET estado_ambiente = '3' WHERE idsolicitud = $id";

    if ($conexion->query($sql) === TRUE) {
        $ser = mysqli_query($conexion, "SELECT * FROM asignacion 
        INNER JOIN usuario ON asignacion.idusuario= usuario.idusuario
        INNER JOIN ambiente ON asignacion.idambiente= ambiente.idambiente
        WHERE idsolicitud = $id");
        $t = mysqli_fetch_assoc($ser);

        $corea = $contenido;
        $dores = $t["correo"];
        $usuario = $t["nombre_usuario"];
        $telefono = $t["telefono"];
        $ambiente = $t["nombre_ambiente"];
        $fecha = $t["fecha_inicio"];

        $tipo = 2;
        require_once "../controllers/enviarCorreo.php";
    }
}

?>