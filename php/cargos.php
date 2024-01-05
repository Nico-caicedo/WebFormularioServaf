<?php
include("Conexion.php");

$sql = "SELECT IdCargo, Cargo FROM Cargos";
$resultado = mysqli_query($conexion, $sql);

$options = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $options[] = [
        'value' => $fila['IdCargo'],
        'text' => $fila['Cargo']
    ];
}

echo json_encode($options);
?>
