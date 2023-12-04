<?php 

session_start();
error_reporting(0);
// $varsesion = $_SESSION['nombre'];

// if($varsesion == null || $varsesion = '' ){
//     echo "no tiene autorización";
//     die();
// }
session_unset();
session_destroy();
header("location: ../index.php");
