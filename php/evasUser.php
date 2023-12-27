<?php

include 'Conexion.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$IdUser = $_POST['infoUser'];
$IdEva = $_POST['IdEva'];

$sql = "SELECT DISTINCT IdEvaluacion FROM calificacion WHERE IdEvaluado = $IdEva";

// Ejecutar la consulta
$resultado = $conexion->query($sql);

// Variable para almacenar el contenido que se enviará al contenedor
$containerContent = '';
$UserInfo = '';
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

        <!-- Comentario: ¿Esto debería estar habilitado? -->
        <div onclick='editEva({$fila["IdEvaluacion"]})'><img src='./img/editar.png' class='iconss' alt=''></div>


<div onclick='abrirVentanaEliminar({$fila["IdEvaluacion"]})'><img src='./img/eliminar.png' class='iconss' alt=''></div>

       
        
    </div>
</div>";
        }
    }

   

} else {
    // Si no hay evaluaciones, establecer un mensaje de error
    $containerContent = "No hay evaluaciones disponibles";
}

$datos = mysqli_query($conexion, "SELECT * FROM users where IdUser = $IdUser");
if ($datos->num_rows > 0) {
    $row = mysqli_fetch_assoc($datos);
    if($row['FotoPerfil'] == null){
        $img = "sin_foto.png";
    }else{
        $img = $row['FotoPerfil'];
    }


    $idCargo = $row['IdCargo'];

    $cargo = mysqli_query($conexion, "SELECT * FROM cargos where IdCargo = $idCargo");
    $fila = mysqli_fetch_assoc($cargo);

    $NombreCargo = $fila['Cargo'];

    $UserInfo = "
    <div class='circle'><img src='./imgusuario/$img' class='User_img' alt=''></div>

          <div class='datos_user'>
            <input type='hidden' name='evadelet' id='evadelet'  value={$IdEva} >
            <p>{$row['Nombre1']} {$row['Nombre2']} {$row['Apellido1']} {$row['Apellido2']}</p>
            <p>{$row['TypeDocument']} {$row['Document']}</p>
            <p>$NombreCargo</p>
            <p onclick='desplegar(); ocultar({$IdUser})' id='solito' class='boton_Eva'>Evaluar</p>
            </div>
    ";

}




  // Construir el array de respuesta
  $response = [
    'containerContent' => $containerContent,
    'userInfo' => $UserInfo
];

// Enviar la respuesta al cliente en formato JSON
echo json_encode($response);

}
?>
