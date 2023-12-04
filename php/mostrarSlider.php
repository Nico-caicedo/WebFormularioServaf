<?php
include('Conexion.php');

$response = array(); // Arreglo para almacenar la respuesta

$consultarCarrusel = $conexion->query("SELECT * FROM carruselnoticias");
if ($consultarCarrusel->num_rows > 0) {
    $imagenes = array(); // Arreglo para almacenar las imágenes
    while ($img = $consultarCarrusel->fetch_assoc()) {
        // Agregar la ruta de la imagen al arreglo de imágenes
        $imagenes[] = 'imgusuario/' . $img['rutaimagen'];
        $idImagenes[] = $img['idcarrusel'];
        
        // Establecer el texto de la noticia
        $response['textoNoticia'] = $img['textonoticia'];
       

    }
    $response['imagenes'] = $imagenes; // Agregar el arreglo de imágenes a la respuesta
    $response['id'] = $idImagenes; // Agregar el arreglo de imágenes a la respuesta
    $response['success'] = true;
} else {
    $response['success'] = false; // Si no se encuentran imágenes, establecer success en falso
}

// Convertir la respuesta a JSON y enviarla
echo json_encode($response);
?>
