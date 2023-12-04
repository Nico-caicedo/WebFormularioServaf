<?php
include('../php/Conexion.php');

function consultarInforme($fecha_inicio, $fecha_fin)
{
    $dataReturn = array();
    global $conexion;

    // Consulta general de asignaciones dentro del rango de fechas
    $sql = "SELECT 
    usuario.nombre_usuario AS Nombre,
    usuario.apellido AS Apellido,
    ambiente.nombre_ambiente AS Ambiente,
    ambiente.numero_ambiente AS Numero,
    asignacion.fecha_inicio AS Fecha_inicio,
    asignacion.fecha_fin AS Fecha_fin, 
    asignacion.numero_ficha AS Ficha,
    asignacion.formacion AS Formacion,
    jornadas.jornada AS jornada,
    asignacion.motivo AS Motivo,
    estado_ambiente.estado_ambiente AS Estado_asignacion

    FROM asignacion 
    INNER JOIN usuario ON asignacion.idusuario = usuario.idusuario 
    JOIN estado_ambiente ON asignacion.estado_ambiente = estado_ambiente.idestado
    JOIN jornadas ON asignacion.jornada = jornadas.id_jornada
    JOIN ambiente ON asignacion.idambiente = ambiente.idambiente
    JOIN rol_usuario ON usuario.idrol = rol_usuario.idrol
    WHERE  DATE(asignacion.fecha_inicio) >= '$fecha_inicio' AND DATE(asignacion.fecha_fin) <= '$fecha_fin'";


    $data = $conexion->query($sql);
    if ($data->num_rows > 0) {
        while ($dato = $data->fetch_assoc()) {
            $dataReturn[] = $dato;
        }
        return $dataReturn;
    } else {
        return null;
    }
}

// Recibir una peticion post

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Llamar la función con las fechas de inicio y fin
    $result = consultarInforme($fecha_inicio, $fecha_fin);

    echo json_encode($result);
}

?>