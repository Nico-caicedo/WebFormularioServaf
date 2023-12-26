<?php
session_start();
$IdEvaluador = $_SESSION['id_evaluador'];
include('Conexion.php');








$Estado = 1;

if (isset($_POST['date1']) && isset($_POST['date2'])) {


// genera el nombre que llevara la evaluación 


date_default_timezone_set('America/Bogota');

// Obtener la fecha y hora actual
$fechaHoraActual = new DateTime();
$fechaHoraActual->setTimezone(new DateTimeZone('America/Bogota'));

// Formatear la fecha y hora según tus necesidades
$formatoFechaHora = 'Ymd_His';
$fechaHoraFormateada = $fechaHoraActual->format($formatoFechaHora);

// Crear la variable concatenando "Eva_" con la fecha y hora formateada
$NombreEva = "Eva_" . $fechaHoraFormateada;



    $Date1 = $_POST['date1'];
    $Date2 = $_POST['date2'];
    $id = $_POST['id_evaluado'];
    $Codigo = $NombreEva;
    $FechaActual = date("Y-m-d");


    $componentes1 = explode("-", $Date1);

    $anio1 = $componentes1[0];
    $mes1 = ltrim($componentes1[1], '0');
    $dia1 = $componentes1[2];


    $componentes2 = explode("-", $Date2);

    $anio2 = $componentes2[0];
    $mes2 = ltrim($componentes2[1], '0');
    $dia2 = $componentes2[2];





    $nombresMeses = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    ];


    $NameMes1 = $nombresMeses[$mes1];
    $NameMes2 = $nombresMeses[$mes2];
 

    $periodoEvaluacion = "Del ".  $dia1 . " de " . $NameMes1 . " Al " . $dia2 . " De " . $NameMes2;
 





    $consultas = mysqli_query($conexion, "SELECT * FROM evaluados where IdUser = $id");
    $rows = mysqli_fetch_assoc($consultas);
    $IdEvaluado  = $rows['IdEvaluado'];

    $query = mysqli_query($conexion, "INSERT INTO evaluaciones (IdEvaluador, Fecha_Evaluacion, Perido_Del, Periodo_Al, Nombre, Estado) 
        VALUES ('$IdEvaluador', '$FechaActual', '$Date1', '$Date2', '$Codigo', '$Estado')");

    $id_evaluacion = mysqli_insert_id($conexion);
    $_SESSION['id_evaluacion'] = $id_evaluacion;

    $datosUse = mysqli_query($conexion, "SELECT * FROM users where IdUser = $id");
    $datos = mysqli_fetch_assoc($datosUse);
    $nombre1 = $datos['Nombre1'];
    $nombre2 = $datos['Nombre2'];
    $apellido1 = $datos['Apellido1'];
    $apellido2 = $datos['Apellido2'];
    $dni = $datos['Document'];
    $idCargo = $datos['IdCargo'];
    $TiempoServicio = $datos['TiempoServicio'];
    $Antiguedad = $datos['Antiguedad'];
    $idUser = $datos['IdUser'];
    $consulta = mysqli_query($conexion, "SELECT * FROM cargos where IdCargo = $idCargo");
    $row = mysqli_fetch_assoc($consulta);
    

    $idDependencia = $row['IdDependencia'];

    // Puedes imprimir o utilizar el id_evaluacion según tus necesidades
    echo json_encode(array(
        'id_evaluacion' => $id_evaluacion,
        'IdEvaluado' => $IdEvaluado,
        'nombre1' => $nombre1,
        'nombre2' => $nombre2,
        'apellido1' => $apellido1,
        'apellido2' => $apellido2,
        'dni' => $dni,
        'TiempoServicio' => $TiempoServicio,
        'Antiguedad' => $Antiguedad,
        'id_cargo' => $idCargo,
        'idDependencia' => $idDependencia,
        'number999' => $idUser,
        'IdEvaluacion' => $_SESSION['id_evaluacion'] ,
        'PeriodoEvaluacion' =>  $periodoEvaluacion
    ));

    // Hacer algo con $date1 y $date2, como almacenarlos en una base de datos o realizar algún procesamiento.
}
?>
