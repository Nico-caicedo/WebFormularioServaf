<?php
require_once "Conexion.php";

$id_reserva = $_POST["id_reserva"];
$datos = array();

$resul = mysqli_query($conexion, "SELECT * FROM reporteactual_ambiente WHERE idreserva = '$id_reserva'");

if($resul ->num_rows >0){
   while($filas = $resul -> fetch_assoc()){
    $datos[] = $filas;
   }
}
echo json_encode($datos);
?>