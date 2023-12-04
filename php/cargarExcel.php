<?php
require_once 'Conexion.php';
// if ($conexion->connect_error) {
//     die("Error de conexión: " . $conexion->connect_error);
// }

if ($_FILES["csvfile"]["error"] == UPLOAD_ERR_OK) {
    $file = $_FILES["csvfile"]["tmp_name"];
    
    $handle = fopen($file, "r");
    if ($handle !== FALSE) {
           // Leer y descartar la primera línea (encabezados) del archivo CSV
           fgetcsv($handle, 1000, ";");
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $nombre = $conexion->real_escape_string($data[0]);
            $apellido = $conexion->real_escape_string($data[1]);

           
            $edad = (int)$data[2];
            
            $sql = "INSERT INTO usuario (nombre, apellido, edad) VALUES ('$nombre', '$apellido', $edad)";
            
            if ($conexion->query($sql) !== TRUE) {
                echo "Error al cargar datos: " . $conexion->error;
                break;
            }
        }
        
        fclose($handle);
        echo "<script>window.location.href='../index.php'</script>";
    } else {
        echo "Error al abrir el archivo CSV.";
    }
} else {
    echo "Error al subir el archivo.";
}

$conexion->close();

?>
