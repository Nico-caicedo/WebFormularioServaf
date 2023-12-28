<?php
include './Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dependencia = $_POST['nombreD'];
    $estado = 1; // Asegúrate de tener el valor del estado

    // Verificar si el campo de dependencia está vacío
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
            // Insertar nueva dependencia en la base de datos
            $consultaInsertar = mysqli_query($conexion, "INSERT INTO dependencias (Dependencia, Estado) VALUES ('$dependencia', '$estado')");

            if ($consultaInsertar === TRUE) {
                // Registro exitoso
                $response = array('status' => 'success', 'message' => 'Dependencia registrada correctamente');
            } else {
                // Error en el registro
                $response = array('status' => 'error', 'message' => 'Error al registrar la dependencia: ' . $conexion->error);
            }
        }
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se proporcionan datos, devolver un mensaje de error
    $response = array('status' => 'error', 'message' => 'No se proporcionaron datos para registrar la dependencia');
    header('Content-Type: application/json');
    echo json_encode($response);
}
