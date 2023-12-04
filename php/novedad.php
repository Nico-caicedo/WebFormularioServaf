<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoge los datos del formulario

    $id = $_POST["idusuario"];
    $ambiente = $_POST["idambiente"];
    $descrip = $_POST["descripcion"];
    date_default_timezone_set('America/Bogota');
    $fecha = date("Y-m-d H:i:s");
    $estado = 2;

    
    // Realiza alguna lógica con los datos (por ejemplo, almacenarlos en una base de datos o enviar un correo electrónico)
    // Construir y ejecutar la consulta INSERT
    $sql = mysqli_query($conexion, "INSERT INTO reporteactual_ambiente (idreserva, fecha_inicio_reporte, estado_reporte, idusuario ,descripcion) 
VALUES ('$ambiente', '$fecha', '$estado', '$id', '$descrip')");
$data = array(
    'success' => true
);
echo json_encode($data);

    // En este ejemplo, simplemente mostraremos los datos recibidos

} else {
    // Si no se recibió una solicitud POST, muestra un mensaje de error o redirecciona a una página de error
    echo "Error: No se recibió una solicitud POST.";
}
