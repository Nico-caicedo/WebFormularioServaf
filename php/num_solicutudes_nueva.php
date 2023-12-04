<?php
// require_once "Conexion.php";
// date_default_timezone_set('America/Bogota');
// $fecha_actual = date("Y-m-d");
// $hora_actual = date("H:i:s");
// $con = mysqli_query($conexion, "SELECT * FROM asignacion WHERE estado_ambiente = 1");

// if ($con) {
//     if (mysqli_num_rows($con) > 0) {
//         $condision = false;
//         $asig_nuevas = 0;
//         while ($fila = mysqli_fetch_assoc($con)) {
//             $fecha_inicio = $fila["fecha_inicio"];

//             $fecha_inicio_timestamp = strtotime($fecha_inicio);
//             $fecha_actual_timestamp = strtotime($fecha_actual . ' ' . $hora_actual);
//             if ($fecha_actual_timestamp < $fecha_inicio_timestamp) {
//                 $condision = true;
//                 $asig_nuevas += 1;
//             }
//         }
//         if ($condision) {
?>
            <!-- <span class="asig_nuevas"><?php echo $asig_nuevas ?></span>
            <script>
                $("body").data("nuevas", "<?php echo $asig_nuevas ?>");
            </script> -->
<?php
//         }
//     }
// }
?>