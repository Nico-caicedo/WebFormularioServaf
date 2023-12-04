<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'Conexion.php';
    $texto = $_POST['textoNoticia'];
    $textoActual = $_POST['textoActual'];

    $imagenes = $_FILES['imagenes'];

    // Verifica si se han cargado imágenes
    $hayImagenes = false;
    foreach ($imagenes['tmp_name'] as $rutaImg) {
        if (!empty($rutaImg)) {
            $hayImagenes = true;
            break;
        }
    }

    if (!$hayImagenes) {
        // No se cargaron imágenes, actualiza los registros con el mismo textoActual
        $actualizarRegistros = $conexion->query("UPDATE carruselnoticias SET textonoticia = '$texto' WHERE textonoticia = '$textoActual'");
        
        if ($actualizarRegistros) {
            $data = array(
                'success' => true,
                'message' => 'Se actualizó el campo textonoticia en los registros coincidentes.'
            );
        } else {
            $data = array(
                'success' => false,
                'message' => 'Error al actualizar los registros.'
            );
        }
    } else {
        // Se cargaron imágenes, realiza la inserción de imágenes
        foreach ($imagenes['tmp_name'] as $key => $rutaImg) {
            $nombreImg = $imagenes['name'][$key];
            
            move_uploaded_file($rutaImg, '../imgusuario/' . $nombreImg);

            $insertarImagenes = $conexion->query("INSERT INTO carruselnoticias (rutaimagen, textonoticia) 
            VALUES ('$nombreImg', '$texto')");
        }

        $data = array(
            'success' => true,
            'message' => 'Se insertaron imágenes y se actualizó el campo textonoticia.'
        );
    }

    echo json_encode($data);
}
?>
