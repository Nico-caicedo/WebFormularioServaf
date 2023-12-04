<?php

// conexion a base de datos

include './Conexion.php';




if(isset($_POST['idDelete'])) {
    // Obtener el valor de idDelete
    $idDelete = $_POST['idDelete'];




    // Preparar la consulta SQL para eliminar el registro
    $sql = "DELETE FROM evaluaciones WHERE IdEvaluacion = $idDelete"; // Ajusta según tu estructura de tabla

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // La eliminación se realizó con éxito
        $response = array('status' => 'success', 'message' => 'Registro eliminado correctamente');
    } else {
        // Hubo un error en la ejecución de la consulta
        $response = array('status' => 'error', 'message' => 'Error al eliminar el registro: ' . $conexion->error);
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
