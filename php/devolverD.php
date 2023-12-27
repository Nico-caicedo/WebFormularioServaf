<?php
session_start();
$IdEvaluador = $_SESSION['id_evaluador'];
include('Conexion.php');

$Estado = 1;

if (isset($_POST['id_evaluado'])) {
$id = $_POST['id_evaluado'];

// genera el nombre que llevara la evaluación 

    $datosUse = mysqli_query($conexion, "SELECT * FROM users where IdUser = $id");
    $datos = mysqli_fetch_assoc($datosUse);
    $nombre1 = $datos['Nombre1'];
    $nombre2 = $datos['Nombre2'];
    $apellido1 = $datos['Apellido1'];
    $apellido2 = $datos['Apellido2'];
    $dni = $datos['Document'];

    $html = "";

    $html = "
        <input type='hidden' id='empleadoEva'  name='id_evaluado' value='$id'>
        <p>$nombre1 $nombre2 $apellido1 $apellido2</p>
        <p>CC $dni</p>
    
    
    
    ";

    // Puedes imprimir o utilizar el id_evaluacion según tus necesidades
    echo json_encode(array(
        // 'id_evaluacion' => $id_evaluacion,
        // 'IdEvaluado' => $IdEvaluado,
        'datos' => $html,
        // 'nombre2' => $nombre2,
        // 'apellido1' => $apellido1,
        // 'apellido2' => $apellido2,
        // 'dni' => $dni,
        // 'TiempoServicio' => $TiempoServicio,
        // 'Antiguedad' => $Antiguedad,
        // 'id_cargo' => $idCargo,
        // 'idDependencia' => $idDependencia,
        // 'number999' => $idUser,
        // 'IdEvaluacion' => $_SESSION['id_evaluacion'] ,
        // 'PeriodoEvaluacion' =>  $periodoEvaluacion
    ));

    // Hacer algo con $date1 y $date2, como almacenarlos en una base de datos o realizar algún procesamiento.
}
?>
