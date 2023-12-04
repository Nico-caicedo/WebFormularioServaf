<?php
include 'Conexion.php';

$response = array();

if (isset($_POST['crearAmbiente'])) {
    $nombreambiente = $_POST['nombreAmbiente'];
    $pisoambiente = $_POST['pisoAmbiente'];
    $numeroambiente = $_POST['numeroAmbiente'];
    $sillaambiente = $_POST['sillaAmbiente'];
    $mesaambiente = $_POST['mesaAmbiente'];
    $tvambiente = $_POST['tvAmbiente'];
    $aire_acondicionado = $_POST['aire_acondicionado'];
    $computadorambiente = $_POST['computadorAmbiente'];
    
    // Verificar que los campos no estén vacíos
    if (empty($nombreambiente) || empty($pisoambiente)) {
        $response['error'] = 'al menos debe tener el nombre y piso';
    } 
    // elseif ($pisoambiente <= 0 || $numeroambiente <= 0 || $sillaambiente <= 0 || $mesaambiente <= 0 || $tvambiente <= 0 || $aire_acondicionado <= 0 || $computadorambiente <= 0) {
    //     $response['error'] = 'Los campos no pueden ser cero o valores negativos.';
    // } 
    else {
        // Validar que las imágenes se hayan cargado correctamente
        if (isset($_FILES['imagen']) && isset($_FILES['imagenA'])) {
            $carpeta_destino = "../imgambientes/";

            // Procesar la imagen principal
            $nombre_archivo = $_FILES['imagen']['name'];
            $archivo_subido = $_FILES['imagen']['tmp_name'];
            $ruta_archivo = $carpeta_destino . $nombre_archivo;

            // Procesar la imagen Angular
            $nombreAngular = $_FILES['imagenA']['name'];
            $archivo_angular = $_FILES['imagenA']['tmp_name'];
            $ruta_angular = $carpeta_destino . $nombreAngular;

            if (move_uploaded_file($archivo_subido, $ruta_archivo) && move_uploaded_file($archivo_angular, $ruta_angular)) {
                // Imágenes cargadas con éxito
                $imagen = $ruta_archivo;
                $imagen = basename($imagen);
                $imagenA = $ruta_angular;
                $imagenA = basename($imagenA);

                $sql_existe = "SELECT * FROM ambiente WHERE nombre_ambiente = ? AND piso_ambiente = ? AND numero_ambiente = ?";
                $stmt = mysqli_prepare($conexion, $sql_existe);
                mysqli_stmt_bind_param($stmt, "sii", $nombreambiente, $pisoambiente, $numeroambiente);
                mysqli_stmt_execute($stmt);
                $resultado_ambiente = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($resultado_ambiente) === 0) {
                    if (!preg_match('/^[a-zA-Z\s]+$/', $nombreambiente)) {
                        $response['error'] = 'El nombre contiene caracteres no permitidos';
                    } else {
                        $sql_crear_ambiente = "INSERT INTO ambiente (nombre_ambiente, piso_ambiente, numero_ambiente, img , imgangular) VALUES (?, ?, ?, ? ,?)";
                        $stmt = mysqli_prepare($conexion, $sql_crear_ambiente);
                        mysqli_stmt_bind_param($stmt, "siiss", $nombreambiente, $pisoambiente, $numeroambiente, $imagen , $imagenA);
                        $ambiente_insertado = mysqli_stmt_execute($stmt);

                        if ($ambiente_insertado) {
                            $idambiente = mysqli_insert_id($conexion);

                            // Insertar inventario del ambiente en la tabla "inventario_ambiente"
                            $sql_insertar_inventario = "INSERT INTO inventario_ambiente (silla, mesa, tv, aire_acondicionado, computador, idambiente) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_prepare($conexion, $sql_insertar_inventario);
                            mysqli_stmt_bind_param($stmt, "iiiiii", $sillaambiente, $mesaambiente, $tvambiente, $aire_acondicionado, $computadorambiente, $idambiente);
                            $inventario_insertado = mysqli_stmt_execute($stmt);

                            if ($inventario_insertado) {
                                $response['success'] = 'El ambiente se creó satisfactoriamente.';
                            } else {
                                $response['error'] = 'Hubo un error al insertar el inventario del ambiente.';
                            }
                        } else {
                            $response['error'] = 'Hubo un error al crear el ambiente.';
                        }
                    }
                } else {
                    $response['error'] = 'El ambiente ya existe con el mismo nombre, piso y número.';
                }
            } else {
                $response['error'] = 'Ha ocurrido un error al guardar la imagen. Por favor, inténtelo de nuevo.';
            }
        } else {
            $response['error'] = 'Error al cargar la imagen. Por favor, inténtelo de nuevo.';
        }
    }
    $conexion->close();
    echo json_encode($response);
}
?>
