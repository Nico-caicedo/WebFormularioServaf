<?php
require_once 'Conexion.php';
$resul = mysqli_query($conexion, "SELECT * FROM dependencias ORDER BY IdDependencia ASC");
if (mysqli_num_rows($resul) > 0) {
    while ($fila = mysqli_fetch_assoc($resul)) {
        $UPDATE = $fila['IdDependencia'];
        $dependencia = $fila["Dependencia"];
        echo "<article class='containerD'>";
        echo "<div class='titleD'>";
        echo "<p>$dependencia</p>";
        echo "</div>";
        echo "<article class='btndepdenycar'>";
        echo "<div onclick='abrirventanaeditarD({$fila['IdDependencia']}, " . json_encode($fila['Dependencia']) . ")'><img src='./img/editar.png' class='iconss' alt=''></div>";
        echo "<div onclick='abrirVentanaEliminarD({$fila['IdDependencia']})'><img src='./img/eliminar.png' class='iconss' alt=''></div>";
        echo "</article>";
        echo "</article>";
    }
} else {
    // Si no hay registros, mostrar el mensaje correspondiente
    echo "No hay dependencias registradas.";
}
?>
