<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: crearSolicitud.php");
    exit;
}
$idusuario = $_SESSION['id'];

// Incluir la conexión a la base de datos
include('Conexion.php');

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los valores del formulario
    $numero_ficha = mysqli_real_escape_string($conexion, $_POST["numero_ficha"]);
    $formacion = mysqli_real_escape_string($conexion, $_POST["formacion"]);
    $motivo = mysqli_real_escape_string($conexion, $_POST["motivo"]);
    $fecha_inicio = mysqli_real_escape_string($conexion, $_POST["fecha_inicio"]);
    $fecha_fin = mysqli_real_escape_string($conexion, $_POST["fecha_fin"]);
    $jornada = mysqli_real_escape_string($conexion, $_POST["jornada"]);
    $idambiente = mysqli_real_escape_string($conexion, $_POST["idambiente"]);
    $idEstadoAmbiente = 1;



    // Preparar la consulta SQL con sentencia preparada
    $sql = "INSERT INTO asignacion (numero_ficha, formacion, motivo, fecha_inicio, fecha_fin, jornada, idusuario, idambiente, estado_ambiente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular los parámetros con los valores
        $stmt->bind_param("ssssssiii", $numero_ficha, $formacion, $motivo, $fecha_inicio, $fecha_fin, $jornada, $idusuario, $idambiente, $idEstadoAmbiente);

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Inserción exitosa
           header("location: ../admin.php");
        } else {
            // Error en la inserción
            echo "Error al insertar los datos: " . $stmt->error;
        }

        // Cerrar la sentencia preparada
        $stmt->close();
    } else {
        // Error en la preparación de la sentencia
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    // Redireccionar si se intenta acceder directamente al controlador sin enviar el formulario
    header("Location: crearSolicitud.php");
    exit;
}
?>
