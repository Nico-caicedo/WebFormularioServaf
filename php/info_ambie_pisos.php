<?php
require_once "Conexion.php";
date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");
$estadoCount = array(1 => array(0, 0, 0),  
                     2 => array(0, 0, 0),  
                     3 => array(0, 0, 0)); 

$sinAsig = array(1 => array(),  
                    2 => array(), 
                    3 => array());

$piso_ambie = array(1 => array(),  
2 => array(), 
3 => array());
   
$resul = mysqli_query($conexion, "SELECT * FROM ambiente");

if(mysqli_num_rows($resul) > 0){
    while($fila = mysqli_fetch_assoc($resul)){
        $idambiente = $fila["idambiente"];        
        $piso_ambiente = $fila["piso_ambiente"];
        $enhoramala = null;
        $piso_ambie[$piso_ambiente][] = $idambiente; 
        $resul2 = mysqli_query($conexion, "SELECT * FROM asignacion WHERE idambiente = '$idambiente'");
        
        if(mysqli_num_rows($resul2)){
            while ($fila2 = mysqli_fetch_assoc($resul2)){
                $fecha_inicio = $fila2["fecha_inicio"];
                $fecha_fin = $fila2["fecha_fin"];
                $parts_inicio = explode(" ", $fecha_inicio);
                $parts_fin = explode(" ", $fecha_fin);

                $fecha_inici = $parts_inicio[0];
                $hora_inicio = $parts_inicio[1];

                $fecha_fi = $parts_fin[0];
                $hora_fin = $parts_fin[1];

                $fecha_inicio_times = strtotime($fecha_inici);
                $fecha_fin_timestamp = strtotime($fecha_fi);
                $hora_inicio_timestamp = strtotime($hora_inicio);
                $hora_fin_timestamp = strtotime($hora_fin);
                $fecha_actual_times = strtotime($fecha_actual);
                $hora_actual_times = strtotime($hora_actual);
                $fecha_inicio_timestamp = strtotime($fecha_inicio);
                $fecha_actual_timestamp = strtotime($fecha_actual . ' ' . $hora_actual);
                $estado_ambiente = $fila2["estado_ambiente"];
                if ($fecha_actual_times >= $fecha_inicio_times && $fecha_actual_times <= $fecha_fin_timestamp) {
                    if ($hora_actual_times >= $hora_inicio_timestamp && $hora_actual_times <= $hora_fin_timestamp) {
                        if($estado_ambiente >= 1 && $estado_ambiente <= 3){
                            if($estado_ambiente == 1){
                                if ($fecha_actual_timestamp < $fecha_inicio_timestamp) {
                                    $estado_ambiente = 1;
                                } else {
                                    $estado_ambiente = 3;
                                }
                            }
                            $id_reserva = $fila2["idsolicitud"];
                            $resul5 = mysqli_query($conexion, "SELECT * FROM reporteactual_ambiente WHERE idreserva = '$id_reserva'");
                            if(mysqli_num_rows($resul5) > 0){
                                while($fila5 = mysqli_fetch_assoc($resul5)){
                                    $fechaI_reporte_actu = new DateTime($fila5["fecha_inicio_reporte"]);
                                    $fechaF_reporte_actu = new DateTime($fila5["fecha_fin_reporte"]);
                                    while ($fechaI_reporte_actu <= $fechaF_reporte_actu) {
                                        $fecha_actual_bd_times = strtotime($fechaI_reporte_actu->format("Y-m-d"));
                                        if($fecha_actual_times == $fecha_actual_bd_times){
                                            $estado_ambiente = $fila5["estado_reporte"];
                                        }
                                        $fechaI_reporte_actu->add(new DateInterval('P1D')); 
                                    }
                                }
                            }
                            $estadoCount[$piso_ambiente][$estado_ambiente - 1]++;
                            $enhoramala = null;
                        }
                        break;
                    }else{
                        $enhoramala = $idambiente;
                    }
                } else {
                    $enhoramala = $idambiente;
                }
            }
        }else{
            $sinAsig[$piso_ambiente][] = $idambiente; 
        }
        if($enhoramala){
            $sinAsig[$piso_ambiente][] = $enhoramala; 
        }
    }
}


$datos = [
    "asignados" => $estadoCount,
    "noAsignados" => $sinAsig,
    "piso_ambie" => $piso_ambie
];

echo json_encode($datos);
