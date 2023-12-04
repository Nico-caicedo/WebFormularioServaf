<?php


$conexion = mysqli_connect("localhost", "root", "", "evaluacionservaf");

// Conexion a base de datos
// $conexion = mysqli_connect("localhost", "c1601882_AA", "keGOtude02", "c1601882_AA");

if (!$conexion) {
  die("algo salio mal" . mysqli_connect_error());
}

// Configurar la conexión para usar utf8mb4
if (!$conexion->set_charset("utf8mb4")) {
  die("Error al establecer el conjunto de caracteres utf8mb4: " . $conexion->error);
}


// $serverName = "DESKTOP-7HFRCGT\SQLEXPRESS";
// $connectionOptions = array(
//     "Database" => "EvaluacionServaf",
//     "Uid" => "sa",
//     "PWD" => "123456789"
// );

// $conexion = sqlsrv_connect($serverName, $connectionOptions);

// if (!$conexion) {
//     die("Algo salió mal: " . print_r(sqlsrv_errors(), true));
// }

?>
