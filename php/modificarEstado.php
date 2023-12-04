<?php
include './Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$estado = $_POST['estado'];

$IdUser = $_POST['idUpdate'];





$update = mysqli_query($conexion, "UPDATE users SET Estado ='$estado' WHERE IdUser = $IdUser");

if ($update) {
    // La actualización fue exitosa
    $response = array('success' => true, 'message' => 'Estado actualizado correctamente');
} else {
    // La actualización falló
    $response = array('success' => false, 'message' => 'Error al actualizar el estado');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);



}