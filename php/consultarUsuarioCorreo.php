<?php
function consultarUsuarioCorreo($email)
{
    require_once 'Conexion.php';

    $consulta = $conexion->query("SELECT idusuario FROM usuario WHERE correo ='$email'");

    if ($consulta->num_rows > 0) {
        
        $id = $consulta->fetch_assoc();
        $idUsuario = $id['idusuario'];
        return $idUsuario;
    }else{
        return null;
    }
}
?>