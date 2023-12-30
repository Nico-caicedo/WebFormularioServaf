<?php
require_once 'Conexion.php';
$resul = mysqli_query($conexion, "SELECT * FROM cargos ORDER BY IdCargo DESC");
if (mysqli_num_rows($resul) > 0) {
    while ($fila = mysqli_fetch_assoc($resul)) {
        $cargo = $fila["Cargo"];
        echo "<article class='containerD'>";
        echo "<div class='titleD'>";
        echo "<p>$cargo</p>";
        echo "</div>";
        echo "<article class='btndepdenycar'>";
        echo "<div onclick='abrirventanaeditarC({$fila['IdCargo']}, " . json_encode($fila['Cargo']) . ", " . json_encode($fila['Descripcion']) . ", " . json_encode($fila['IdDependencia']) . ")'><img src='./img/editar.png' class='iconss' alt=''></div>";
        echo "<div onclick='abrirVentanaEliminarC({$fila['IdCargo']})'><img src='./img/eliminar.png' class='iconss' alt=''></div>";
        echo "</article>";
        echo "</article>";
    }
} else {
    // Si no hay registros, mostrar el mensaje correspondiente
    echo "No hay cargos registrados.";
}
?>

