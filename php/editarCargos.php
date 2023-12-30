<?php
include './Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCargo = mysqli_real_escape_string($conexion, $_POST['idCargo']);
    $cargo = mysqli_real_escape_string($conexion, $_POST['nombreeditadoC']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $idDependencia = mysqli_real_escape_string($conexion, $_POST['iddependenciaC']);

    // Obtener la información actual del cargo
    $consultaCargoActual = mysqli_query($conexion, "SELECT Cargo, Descripcion, IdDependencia FROM cargos WHERE IdCargo = $idCargo");
    $filaCargoActual = mysqli_fetch_assoc($consultaCargoActual);
    $cargoActual = $filaCargoActual['Cargo'];
    $descripcionActual = $filaCargoActual['Descripcion'];
    $dependenciaActual = $filaCargoActual['IdDependencia'];

    // Verificar si hay cambios en el cargo, la descripción o la dependencia
    $cambios = false;
    if ($cargo !== $cargoActual || $descripcion !== $descripcionActual || $idDependencia !== $dependenciaActual) {
        $cambios = true;
    }

    // Si hay cambios, actualizar la información en la base de datos
    if ($cambios) {
        // Verificar si el campo de cargo está vacío
        if (empty($cargo)) {
            // Si está vacío, devuelve un mensaje de error
            $response = array('status' => 'warning', 'message' => 'No has ingresado ningún nombre de cargo');
        } else if (empty($descripcion)) {
            // Si está vacío, devuelve un mensaje de error
            $response = array('status' => 'warning', 'message' => 'No has ingresado ninguna descripción del cargo');
        } else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/", $cargo)) {
            // Si contiene caracteres no permitidos (números u otros símbolos)
            $response = array('status' => 'warning', 'message' => 'El nombre del cargo solo debe contener letras');
        } else {
            // Actualizar el cargo y su información en la base de datos
            $consultaActualizar = mysqli_query($conexion, "UPDATE cargos SET Cargo = '$cargo', Descripcion = '$descripcion', IdDependencia = '$idDependencia' WHERE IdCargo = '$idCargo'");

            if ($consultaActualizar === TRUE) {
                // Actualización exitosa
                $response = array('status' => 'success', 'message' => 'Cargo actualizado correctamente');
            } else {
                // Error en la actualización
                $response = array('status' => 'error', 'message' => 'Error al actualizar el cargo: ' . $conexion->error);
            }
        }
    } else {
        // No se realizaron cambios
        $response = array('status' => 'warning', 'message' => 'Sin cambios en el Cargo');
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se proporcionan datos, devolver un mensaje de error
    $response = array('status' => 'error', 'message' => 'No se proporcionaron datos para actualizar el cargo');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

