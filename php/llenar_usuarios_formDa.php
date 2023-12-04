<?php
session_start();
require_once "Conexion.php";

if(!$_SESSION["rol"] == 1){
    header("Location: ../index.php");
    exit();
}

$datos = array();
$res = mysqli_query($conexion, "SELECT nombre_usuario, rol_usuario.nombre_rol, idestado, apellido, idusuario FROM usuario INNER JOIN rol_usuario ON  usuario.idrol = rol_usuario.idrol");
if($res){
    while($fila = mysqli_fetch_assoc($res)){
        if($fila["idestado"] == 1){
            $datos[] = $fila;
        }
    }
}
echo json_encode($datos);
?>