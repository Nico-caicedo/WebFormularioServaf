<?php
require_once "Conexion.php";

$id_reserva = $_POST["id_reserva"];
$enviar_datos = array();
date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$fecha_actual_times = strtotime($fecha_actual);

$resul = mysqli_query($conexion, "SELECT * FROM asignacion INNER JOIN usuario ON  asignacion.idusuario = usuario.idusuario INNER JOIN rol_usuario ON  usuario.idrol = rol_usuario.idrol WHERE idsolicitud = '$id_reserva'");

if (mysqli_num_rows($resul) > 0) {
    $fila = mysqli_fetch_assoc($resul);
    $id_reserva = $fila["idsolicitud"];
    $resul5 = mysqli_query($conexion, "SELECT * FROM reporteactual_ambiente WHERE idreserva = '$id_reserva'");
    
    if (mysqli_num_rows($resul5) > 0) {
        if (isset($_POST["actuali"])) {
            while ($fila5 = mysqli_fetch_assoc($resul5)) {
                $fechaI = new DateTime($fila["fecha_inicio"]);
                $fechaF = new DateTime($fila["fecha_fin"]);
                
                while ($fechaI <= $fechaF) {
                    $nuevaFila = $fila; // Copia la fila original
                    $nuevaFila["fecha_inicio"] = $fechaI->format("Y-m-d");

                    $fechaI_reporte = new DateTime($fila5["fecha_inicio_reporte"]);
                    $fechaF_reporte = new DateTime($fila5["fecha_fin_reporte"]);
                    
                    while ($fechaI_reporte <= $fechaF_reporte) {
                        $fecha_actual_bd_times = strtotime($fechaI_reporte->format("Y-m-d"));
                        $fecha_inicio_cada_dia = $nuevaFila["fecha_inicio"];
                        $fecha_inicio_stro = strtotime($fecha_inicio_cada_dia);

                        if ($fecha_inicio_stro == $fecha_actual_bd_times) {
                            $enviar_datos = [
                                "datos_reserva" => $fila,
                                "disponibilidad" => $nuevaFila["fecha_inicio"]
                            ];
                            echo json_encode($enviar_datos);
                            exit();
                        }
                        
                        $fechaI_reporte->add(new DateInterval('P1D'));
                    }
                    
                    $fechaI->add(new DateInterval('P1D'));
                }
            }
        } else {
            while ($fila5 = mysqli_fetch_assoc($resul5)) {
                $fechaI_reporte_actu = new DateTime($fila5["fecha_inicio_reporte"]);
                $fechaF_reporte_actu = new DateTime($fila5["fecha_fin_reporte"]);
                
                while ($fechaI_reporte_actu <= $fechaF_reporte_actu) {
                    $fecha_actual_bd_times = strtotime($fechaI_reporte_actu->format("Y-m-d"));
                    
                    if ($fecha_actual_times == $fecha_actual_bd_times) {
                        $enviar_datos = [
                            "dispoNohay" => true
                        ];
                        echo json_encode($enviar_datos);
                        exit();
                    }
                    
                    $fechaI_reporte_actu->add(new DateInterval('P1D'));
                }
            }
        }
    }
    
    $enviar_datos = [
        "datos_reserva" => $fila
    ];
}
echo json_encode($enviar_datos);
?>
