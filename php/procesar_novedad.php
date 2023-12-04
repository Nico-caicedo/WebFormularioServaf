<?php
session_start();


if(isset($_POST['cargar_novedad'])) {
    require_once 'Conexion.php';
 

    $id_asignacion = $_POST['id_asignacion'];
    $fecha_actual_reporte = $_POST['fecha_actual_reporte'];
    $id_usuario = $_POST['id_usuario'];
    $estado_reporte = $_POST['estado_reporte'];


    $sql = "INSERT INTO reporteactual_ambiente (id_asignacion, fecha_actual_reporte, estado_reporte, id_usuario) VALUES ('$id_asignacion', '$fecha_actual_reporte', '$estado_reporte', $id_usuario)";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Reporte creado con éxito'); window.location='../admin.php';</script>";
    } else {
        echo "Error al crear el reporte: " ;
    }


    $conexion->close();
} else {
    header('Location: index.php');
}
?>
