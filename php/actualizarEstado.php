<?php 
require_once'Conexion.php';
// Actualizar el estado de los usuarios
if (isset($_POST['estadoCliente'])) {
    $estados = $_POST['estadoCliente'];

    updateUserState($estados);
}
  //Funcion para activar /desactivar usuario se recibe por parametro un array con los idUser => estado
     function updateUserState($user)
    {
        global $conexion;
        foreach ($user as $idUser => $state) {
            $update = "UPDATE usuario SET idestado = '$state' WHERE idusuario = '$idUser'";
            $result = $conexion->query($update);
        }
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

?>