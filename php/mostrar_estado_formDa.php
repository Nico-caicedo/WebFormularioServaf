<?php
require_once "Conexion.php";

date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");
$id_ambiente = $_POST["id_ambiente"];
$horaI = $_POST["horaI"];
$horaf = $_POST["horaf"];
$fechaI = $_POST["fechaI"];
$fechaf = $_POST["fechaf"];
$estado_fecha = null;
$estado_hora = null;
$concuerdan = false;

if(empty($horaI) || empty($horaf) || empty($fechaI) || empty($fechaf)){
    echo json_encode("");
    return;
}

$fechaI_times = strtotime($fechaI);
$horaI_times = strtotime($horaI);
$hora_alcanze1 = strtotime("05:00");
$hora_alcanze2 = strtotime("22:00");
$fechaF_times = strtotime($fechaf);
$horaF_times = strtotime($horaf);
$fecha_actual_timestamp = strtotime($fecha_actual);
$hora_actual_timestamp = strtotime($hora_actual);

if($fechaF_times < $fechaI_times){
    $estado_fecha = "nocon";
    $concuerdan = true;
}

if($horaF_times < $horaI_times){
    $estado_hora = "nocon";
    $concuerdan = true;
}

if($concuerdan){
    $estados = [
        "estado_fecha" => $estado_fecha,
        "estado_hora" => $estado_hora
    ];
    
    echo json_encode($estados);
    exit();
}

if($fechaI_times < $fecha_actual_timestamp){

    if($horaI_times < $hora_actual_timestamp){
        $estados = [
            "estado_hora" => "ant"
        ];
        
        echo json_encode($estados);
        exit();
    }
    $estados = [
        "estado_fecha" => "ant"
    ];
    
    echo json_encode($estados);
    exit();
}


$fechaI_mas_un_trimestre = strtotime("+3 months", $fechaI_times);

if ($fechaF_times > $fechaI_mas_un_trimestre) {
    $estados = [
        "estado_fecha" => "fechamastri"
    ];
    
    echo json_encode($estados);
    exit();
} 

$cumplirse = false;

$res = mysqli_query($conexion, "SELECT * FROM asignacion WHERE idambiente = '$id_ambiente'");

if (mysqli_num_rows($res) > 0) {
    while ($fila = mysqli_fetch_assoc($res)) {
        $fecha_inicio = $fila["fecha_inicio"];
        $fecha_fin = $fila["fecha_fin"];

        $parts_inicio = explode(" ", $fecha_inicio);
        $parts_fin = explode(" ", $fecha_fin);

        $fecha_inici = $parts_inicio[0];
        $hora_inicio = $parts_inicio[1];

        $fecha_fi = $parts_fin[0];
        $hora_fin = $parts_fin[1];

        $fecha_inicio_com = strtotime($fecha_inicio);
        $fecha_fin_com = strtotime($fecha_fin);
        $fecha_inicio_times = strtotime($fecha_inici);
        $fecha_fin_timestamp = strtotime($fecha_fi);
        $hora_inicio_timestamp = strtotime($hora_inicio);
        $hora_fin_timestamp = strtotime($hora_fin);
        $estado_ambiente = $fila["estado_ambiente"];

        if ($fecha_inicio_times <= $fechaF_times && $fecha_fin_timestamp >= $fechaI_times) {
            if ($estado_ambiente == 1) {
                $estado_fecha = "pen";
            } else if ($estado_ambiente == 2) {
                $estado_fecha = "ocu";
            } else if ($estado_ambiente == 3) {
                $estado_fecha = "dis";
            }

            $id_reserva = $fila["idsolicitud"];
    
            $resul5 = mysqli_query($conexion, "SELECT * FROM reporteactual_ambiente WHERE idreserva = '$id_reserva'");
            if (mysqli_num_rows($resul5) > 0) {
                while ($fila5 = mysqli_fetch_assoc($resul5)) {
                    $fechaI_reporte_actu = new DateTime($fila5["fecha_inicio_reporte"]);
                    $fechaF_reporte_actu = new DateTime($fila5["fecha_fin_reporte"]);
                    while ($fechaI_reporte_actu <= $fechaF_reporte_actu) {
                        $fecha_actual_bd_times = strtotime($fechaI_reporte_actu->format("Y-m-d"));
                        if ($fechaI_times == $fecha_actual_bd_times) {
                           $cumplirse = true;
                        }
                        $fechaI_reporte_actu->add(new DateInterval('P1D'));
                    }
                }
            }

            if ($hora_inicio_timestamp < $horaF_times && $hora_fin_timestamp > $horaI_times) {
                if ($estado_ambiente == 1) {
                    $estado_hora = "pen";
                } else if ($estado_ambiente == 2) {
                    $estado_hora = "ocu";
                    break;
                } else if ($estado_ambiente == 3) {
                    $estado_hora = "dis";
                }
                break;
            } else {
                $estado_hora = "dis";
            }
        } else {
            $estado_fecha = "dis";
            $estado_hora = "dis";
        }
    }
}else{
    $estado_fecha = "dis";
    $estado_hora = "dis";
}

if($horaI_times < $hora_alcanze1 || $horaF_times > $hora_alcanze2){
    $estado_hora = "alc";
}

if($cumplirse){
    $estados = [
        "estado_fecha" => "dis",
        "estado_hora" => "dis"
    ];
}else{
    $estados = [
        "estado_fecha" => $estado_fecha,
        "estado_hora" => $estado_hora
    ];
}

echo json_encode($estados);