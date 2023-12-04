<?php
require_once 'Conexion.php';

$response = array('error' => '', 'success' => '');

function handleDuplicate($nombre, $numero) {
    global $response;
    $response['error'] .= "El nombre ($nombre) o número de ambiente ($numero) ya existen en la base de datos.\n";
}

if (isset($_POST['guardarDatosAmbientes'])) {
    if ($_FILES["csvfile"]["error"] == UPLOAD_ERR_OK) {
        $file = $_FILES["csvfile"]["tmp_name"];

        $handle = fopen($file, "r");
        if ($handle !== FALSE) {
            $imagen = 'img/ambiente.jpg';
            $imagen = basename($imagen);

            $nombrerepetidos = array();
            $numeroambienteRepetidos = array();

            $sql = "INSERT INTO ambiente (nombre_ambiente, piso_ambiente, numero_ambiente, img) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            if ($stmt) {
                fgetcsv($handle, 1000, ";");

                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    // Verificar que todos los campos no estén vacíos
                    if (empty($data[0]) || empty($data[1]) || empty($data[2]) || empty($data[3]) || empty($data[4]) || empty($data[5]) || empty($data[6]) || empty($data[7])) {
                        $response['error'] = 'Todos los campos deben estar llenos.';
                        break; // Detener la importación si falta algún campo
                    }

                    $nombre_ambiente = $data[0];
                    $piso_ambiente = (int)$data[1];
                    $numero_ambiente = (int)$data[2];
                    $silla = (int)$data[3];
                    $mesa = (int)$data[4];
                    $tv = (int)$data[5];
                    $aire_acondicionado = (int)$data[6];
                    $computador = (int)$data[7];

                    $sql_check_duplicate = "SELECT COUNT(*) AS count FROM ambiente WHERE nombre_ambiente = ? OR numero_ambiente = ?";
                    $stmt_check_duplicate = $conexion->prepare($sql_check_duplicate);
                    $stmt_check_duplicate->bind_param("si", $nombre_ambiente, $numero_ambiente);
                    $stmt_check_duplicate->execute();
                    $result_duplicate = $stmt_check_duplicate->get_result();

                    $row_duplicate = $result_duplicate->fetch_assoc();

                    if ($row_duplicate['count'] == 0) {
                        $stmt->bind_param("siis", $nombre_ambiente, $piso_ambiente, $numero_ambiente, $imagen);
                        if ($stmt->execute() === TRUE) {
                            $idambiente = $stmt->insert_id;
                            $inventario = "INSERT INTO inventario_ambiente (sillas, mesa, tv, aire_acondicionado, computador, idambiente) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt_inventario = $conexion->prepare($inventario);
                            $stmt_inventario->bind_param("iiiiii", $silla, $mesa, $tv, $aire_acondicionado, $computador, $idambiente);

                            if ($stmt_inventario->execute() !== TRUE) {
                                $response['error'] = 'Error al cargar datos';
                            } else {
                                $response['success'] = 'Importación exitosa';
                            }
                        } else {
                            $response['error'] = 'Error al cargar datos';
                        }
                    } else {
                        handleDuplicate($nombre_ambiente, $numero_ambiente);
                    }
                }
                fclose($handle);
            }

            if (!empty($nombrerepetidos)) {
                $response['error'] .= 'Los nombres ya existen en la BD: ' . implode(', ', $nombrerepetidos) . "\n";
            }
            if (!empty($numeroambienteRepetidos)) {
                $response['error'] .= 'Los ambientes ya existen en la BD: ' . implode(', ', $numeroambienteRepetidos);
            }
        } else {
            $response['error'] = 'Error al abrir el archivo CSV.';
        }
    } else {
        $response['error'] = 'Por favor, seleccione la plantilla predefinida (descargarla) y completa los campos antes de importar.';
    }
}
echo json_encode($response);

// Cerrar la conexión
$conexion->close();
?>

