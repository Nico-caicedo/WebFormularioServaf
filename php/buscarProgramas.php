<?php
require_once "Conexion.php";
$dato = array();
$valorFicha = $_POST["valorFicha"];

if(empty($valorFicha)){
    $dato = array(
        'noexiste'=> true
    );
    echo json_encode($dato);
    exit();
}

    $consulta_general = "SELECT ficha, nombreprograma FROM programas
        WHERE ficha LIKE '%$valorFicha%'";
    $resultado = mysqli_query($conexion, $consulta_general);

    if($resultado ->num_rows > 0){
        while($programa = $resultado -> fetch_assoc()){
            $datos = array(
                'ficha'=> $programa['ficha'],
                'nombreprograma'=> $programa['nombreprograma'],
            );
            $dato[] = $datos;
        }
   }else{
    $dato = array(
        'noexiste'=> true
    );
   }
    echo json_encode($dato);
?>