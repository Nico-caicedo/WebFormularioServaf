<?php
include './Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDependencia = mysqli_real_escape_string($conexion, $_POST['idDependencia']);
    $dependencia = mysqli_real_escape_string($conexion, $_POST['nombreeditadoD']);

    // Obtener el nombre actual de la dependencia desde la base de datos
    $consultaDependenciaActual = mysqli_query($conexion, "SELECT Dependencia FROM dependencias WHERE IdDependencia = $idDependencia");
    $filaDependenciaActual = mysqli_fetch_assoc($consultaDependenciaActual);
    $dependenciaActual = $filaDependenciaActual['Dependencia'];

    // Verificar si no hay cambios en el nombre de la dependencia
    if ($dependencia === $dependenciaActual) {
        // Mensaje de advertencia si no hay cambios
        $response = array('status' => 'warning', 'message' => 'Sin cambios en la dependencia');
    } else {
        // Verificar si el campo de dependencia está vacío o tiene caracteres no permitidos
        if (empty($dependencia)) {
            // Si está vacío, devuelve un mensaje de error
            $response = array('status' => 'warning', 'message' => 'No has ingresado ningún nombre de dependencia');
        } else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/", $dependencia)) {
            // Si contiene caracteres no permitidos (números u otros símbolos)
            $response = array('status' => 'warning', 'message' => 'El nombre de dependencia solo debe contener letras');
        } else {
            // Verificar si la dependencia ya existe en la base de datos
            $consultaExistencia = mysqli_query($conexion, "SELECT * FROM dependencias WHERE Dependencia = '$dependencia'");

            if (mysqli_num_rows($consultaExistencia) > 0) {
                // La dependencia ya existe, no se puede insertar de nuevo
                $response = array('status' => 'warning', 'message' => 'La dependencia ya existe en la base de datos');
            } else {
                // Actualizar la dependencia en la base de datos
                $consultaInsertar = mysqli_query($conexion, "UPDATE dependencias SET Dependencia = '$dependencia' WHERE IdDependencia = $idDependencia");

                if ($consultaInsertar === TRUE) {
                    // Registro exitoso
                    $response = array('status' => 'success', 'message' => 'Dependencia actualizada correctamente');
                } else {
                    // Error en la actualización
                    $response = array('status' => 'error', 'message' => 'Error al actualizar la dependencia: ' . $conexion->error);
                }
            }
        }
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se proporcionan datos, devolver un mensaje de error
    $response = array('status' => 'error', 'message' => 'No se proporcionaron datos para actualizar la dependencia');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
