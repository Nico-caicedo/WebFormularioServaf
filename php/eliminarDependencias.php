<?php
include './Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminarD'])) {
    $idDependencia = $_POST['eliminarD'];

    // Verificar si existen cargos asignados a esta dependencia
    $consultaCargos = mysqli_query($conexion, "SELECT COUNT(*) AS totalCargos FROM cargos WHERE IdDependencia = '$idDependencia'");
    $filaCargos = mysqli_fetch_assoc($consultaCargos);
    $totalCargos = $filaCargos['totalCargos'];

    if ($totalCargos > 0) {
        // Si existen cargos asignados, devolver un mensaje indicando que no se puede eliminar
        $response = array('status' => 'warning', 'message' => 'No se puede eliminar la dependencia, tiene cargos asignados');
    } else {
        // Si no hay cargos asignados, proceder con la eliminación
        $consultadependencia = mysqli_query($conexion, "DELETE FROM dependencias WHERE IdDependencia = '$idDependencia'");

        if ($consultadependencia === TRUE) {
            // La eliminación se realizó con éxito
            $response = array('status' => 'success', 'message' => 'Dependencia eliminada correctamente');
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
?>

