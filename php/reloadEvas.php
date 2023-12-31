<?php
include 'Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $IdEva = $_POST['deleteEva'];
$sql = "SELECT DISTINCT IdEvaluacion FROM calificacion WHERE IdEvaluado = $IdEva";

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Variable para almacenar el contenido que se enviará al contenedor
$containerContent = '';

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Iterar a través de los resultados y construir el contenido
    while ($fila = $resultado->fetch_assoc()) {
        $IdEvaluacion = $fila["IdEvaluacion"];

        $eva = mysqli_query($conexion, "SELECT * FROM evaluaciones WHERE IdEvaluacion = $IdEvaluacion");

        if ($eva->num_rows > 0) {
            $data = mysqli_fetch_assoc($eva);

            $containerContent .= "<div class='Evas'>
    <p class='name_eva'>
        {$data['Nombre']}
    </p>

    <div  class='iconos'>
        <div  onclick='OpenPdf({$fila["IdEvaluacion"]})'  data-IdEva='{$fila["IdEvaluacion"]}'><img src='./img/see.png' class='iconss' alt=''></div>
        <div onclick='DownloadPdf({$fila["IdEvaluacion"]})'><img src='./img/pdf.png' class='iconss' alt=''></div>

   
        <div id='editEva'><img src='./img/editar.png' class='iconss' alt=''></div>


<div onclick='abrirVentanaEliminar({$fila["IdEvaluacion"]})'><img src='./img/eliminar.png' class='iconss' alt=''></div>

       
        
    </div>
</div>";
        }
    }

   

} else {
    // Si no hay evaluaciones, establecer un mensaje de error
    $containerContent = "No hay evaluaciones disponibles";
}



  // Construir el array de respuesta
  $response = [
    'containerContent' => $containerContent,

];

// Enviar la respuesta al cliente en formato JSON
echo json_encode($response);


}


