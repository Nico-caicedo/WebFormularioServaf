<?php
include 'Conexion.php';

header('Content-Type: application/json'); // Establece el encabezado para indicar que la respuesta es JSON

// Consulta para obtener la cantidad de usuarios
$sql = "SELECT COUNT(*) AS totaldependencias FROM dependencias"; // Reemplaza 'users' con el nombre de tu tabla de usuarios
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totaldependencias = $row["totaldependencias"];
    echo json_encode(array("cantidad" => $totaldependencias)); // Devuelve la cantidad de usuarios en formato JSON
} else {
    echo json_encode(array("cantidad" => 0)); // Si no se encuentran usuarios, devuelve 0
}

$conexion->close();
?>
