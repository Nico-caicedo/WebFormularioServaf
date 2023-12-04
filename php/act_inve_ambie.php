<?php
require_once "Conexion.php";

$idAmbiente = $_POST["idAmbiente"];
$sillas = $_POST["sillas"];
$mesas = $_POST["mesas"];
$tv = $_POST["tv"];
$aire_a = $_POST["aire_a"];
$pc = $_POST["pc"];
$res = mysqli_query($conexion, "UPDATE inventario_ambiente SET silla='$sillas', mesa='$mesas', tv='$tv', aire_acondicionado='$aire_a', computador='$pc' WHERE idambiente = '$idAmbiente'");
if($res){

}
?>