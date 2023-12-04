<?php
require_once "Conexion.php";
date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$datos = array();
$idReserva = $_POST["idReserva"];
$idUsuario = $_POST["idUsuario"];
$estadoSeleccionado = 3;
$motivoReporte = $_POST["motivoReporte"];
$descripcionReporte = $_POST["descripcionEnviada"];


// Primero, selecciona los registros que coincidan con idAmbiente
$res = mysqli_query($conexion, "INSERT INTO reporteactual_ambiente (idreserva, fecha_inicio_reporte, fecha_fin_reporte, estado_reporte, idusuario, motivo, descripcion) VALUES ('$idReserva','$fecha_actual', '$fecha_actual', '$estadoSeleccionado','$idUsuario','$motivoReporte', '$descripcionReporte')");
if ($res) {
    $datos["mensaje"] = "Estado actualizado correctamente.";
}

echo json_encode($datos);
?>
