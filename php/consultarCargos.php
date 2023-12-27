<?php 
require_once 'Conexion.php';
$resul = mysqli_query($conexion, "SELECT * FROM cargos");
if (mysqli_num_rows($resul) > 0) {
    while ($fila = mysqli_fetch_assoc($resul)) {
        $cargo = $fila["Cargo"];
        echo "<article class='containerD'>";
        echo "<div class='titleD'>";
        echo "<form method='post' class='formD' onsubmit='sendform(event,formD,./php/cargoscargos.php)'>";
        echo "<button name='btnD'>$cargo</button>";
        echo "</form>";
        echo "</div>";
        echo "</article>";
    }
}

?>