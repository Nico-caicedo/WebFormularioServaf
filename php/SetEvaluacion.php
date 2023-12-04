<html>
    <img src="../img/EncabezadoSERVAF.png" alt="">
</html>

<?php



session_start();
include('conexion.php');

$Estado = 1;
$id_evaluacion = $_SESSION['id_evaluacion']; // Declarar e inicializar la variable



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_evaluado = 3;

    // Verificar la conexión a la base de datos
    if (!$conexion) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Consulta preparada
    $insert = mysqli_prepare($conexion, "INSERT INTO calificacion (IdEvaluado, IdPregunta, IdEvaluacion, Calificacion, Estado) VALUES (?, ?, ?, ?, ?)");

    // Declarar las variables antes de usarlas en mysqli_stmt_bind_param
    $IdPregunta = 0;
    $Calificacion = 0;

    mysqli_stmt_bind_param($insert, "iiiii", $id_evaluado, $IdPregunta, $id_evaluacion, $Calificacion, $Estado);

    for ($i = 0; $i < count($Id); $i++) {
        $IdPregunta = $Id[$i];
        $Calificacion = $Val[$i];

        if (!mysqli_stmt_execute($insert)) {
            // Manejar el error en caso de que la inserción falle
            echo "<script>alert('Inserción fallida');</script>";
        }
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($insert);
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Puedes realizar alguna acción adicional después de la inserción si es necesario
} else {
    echo "<script>alert('Error en la ejecución');</script>";
}
?>
