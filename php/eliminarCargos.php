<?php
include './Conexion.php';

if (isset($_POST['eliminarC'])) {
    $idCargo = $_POST['eliminarC'];

    // Verificar si existen cargos asignados a esta dependencia
    $consultaCargos = mysqli_query($conexion, "SELECT count(*) AS totalusers FROM users WHERE IdCargo = '$idCargo'");
    $filaCargos = mysqli_fetch_assoc($consultaCargos);
    $totalusers = $filaCargos['totalusers'];

    if ($totalusers > 0) {
        // Si existen cargos asignados, devolver un mensaje indicando que no se puede eliminar
        $response = array('status' => 'warning', 'message' => 'No se puede eliminar el cargo, porque tiene usuarios asignados');
    } else {
        // Si no hay cargos asignados, proceder con la eliminación
        $consultadependencia = mysqli_query($conexion, "DELETE FROM cargos WHERE idcargo = '$idCargo'");

        if ($consultadependencia === TRUE) {
            // La eliminación se realizó con éxito
            $response = array('status' => 'success', 'message' => 'Cargo eliminado correctamente');
        } else {
            // Hubo un error en la ejecución de la consulta
            $response = array('status' => 'error', 'message' => 'Error al eliminar el registro: ' . $conexion->error);
        }
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se proporciona el valor idDelete, devolver un mensaje de error
    $response = array('status' => 'error', 'message' => 'No se proporcionó el valor idDelete');
    header('Content-Type: application/json');
    echo json_encode($response);
}
