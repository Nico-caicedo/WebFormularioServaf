<?php
include './Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cargo = mysqli_real_escape_string($conexion, $_POST['nombreC']);
    $descripcion = mysqli_real_escape_string($conexion,$_POST['descripcion']);
    $idDependencia = mysqli_real_escape_string($conexion,$_POST['iddependencia']);
    $estado = 1; // Asegúrate de tener el valor del estado

    // Verificar si el campo de dependencia está vacío
    if (empty($cargo)) {
        // Si está vacío, devuelve un mensaje de error
        $response = array('status' => 'warning', 'message' => 'No has ingresado ningún nombre de cargo');
    } else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/", $cargo)) {
        // Si contiene caracteres no permitidos (números u otros símbolos)
        $response = array('status' => 'warning', 'message' => 'El nombre del cargo solo debe contener letras');
    } else { 
        // Verificar si la dependencia ya existe en la base de datos
        $consultaExistencia = mysqli_query($conexion, "SELECT * FROM cargos WHERE Cargo = '$cargo'");

        if (mysqli_num_rows($consultaExistencia) > 0) {
            // La dependencia ya existe, no se puede insertar de nuevo
            $response = array('status' => 'warning', 'message' => 'el cargo ya existe en la base de datos');
        } else {
            // Insertar nueva dependencia en la base de datos
            $consultaInsertar = mysqli_query($conexion, "INSERT INTO cargos (Cargo,Descripcion,IdDependencia,Asignado) VALUES ('$cargo','$descripcion','$idDependencia','$estado')");
            if ($consultaInsertar === TRUE) {
                // Registro exitoso
                $response = array('status' => 'success', 'message' => 'Cargo registrado correctamente');
            } else {
                // Error en el registro
                $response = array('status' => 'error', 'message' => 'Error al registrar el cargo: ' . $conexion->error);
            }
        }
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se proporcionan datos, devolver un mensaje de error
    $response = array('status' => 'error', 'message' => 'No se proporcionaron datos para registrar el cargo');
    header('Content-Type: application/json');
    echo json_encode($response);
}
