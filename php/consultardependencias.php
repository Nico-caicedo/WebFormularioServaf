<?php
require_once 'Conexion.php';
$resul = mysqli_query($conexion, "SELECT * FROM dependencias");
if (mysqli_num_rows($resul) > 0) {
    while ($fila = mysqli_fetch_assoc($resul)) {
        $UPDATE = $fila['IdDependencia'];
        $dependencia = $fila["Dependencia"];
        echo "<article class='containerD'>";
        echo "<div class='titleD'>";
        echo "<form method='post' class='formD' onsubmit='sendform(event,formD,./php/consultarCargosDependencias.php)'>";
        echo "<input type='hidden' name='nuevadependencia' value='$dependencia'>";
        echo "<button type='submit'>$dependencia</button>";
        echo "</form>";
        echo "</div>";
        echo "<article class='btndepdenycar'>";
        echo "<form method='post' class='updateD' onsubmit='sendform(event,updateD,./php/actualizarDependencias.php)'>";
        echo "<input type='hidden' name='updateD' value='$UPDATE'>";
        echo "<button type='submit'><img src='./img/editar.png' class='iconss' alt=''></button>";
        echo "</form>";
        echo "<form method='post' class='updateD' onsubmit='sendform(event,updateD,./php/actualizarDependencias.php)'>";
        echo "<input type='hidden' name='updateD' value='$UPDATE'>";
        echo "<button type='submit'><img src='./img/eliminar.png' class='iconss' alt=''></button>";
        echo "</form>";
        echo "</article>";
        echo "</article>";
    }
}
