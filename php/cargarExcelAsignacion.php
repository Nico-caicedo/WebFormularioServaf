<?php
include 'Conexion.php';

$response = array('error' => '', 'success' => '');

if (isset($_POST['guardarDatosAsignacion'])) {
    if ($_FILES["csvfile"]["error"] == UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES["csvfile"]["name"], PATHINFO_EXTENSION);

        if (strtolower($file_extension) === 'csv') {
            $file = $_FILES["csvfile"]["tmp_name"];
            $handle = fopen($file, "r");
            if ($handle !== FALSE) {
                $csvData = array();
                $stmt = $conexion->prepare("INSERT INTO asignacion (numero_ficha, formacion, motivo, fecha_inicio, fecha_fin, jornada, idusuario, idambiente, estado_ambiente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt) {
                    fgetcsv($handle, 1000, ";"); // Saltar la primera fila (encabezados)
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        //  Validaciones de datos
                        $numero_ficha = trim($data[0]);
                        $motivo = trim($data[1]);
                        $fecha_inicio_str = trim($data[2]);
                        $fecha_inicio = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $fecha_inicio_str)));
                        $fecha_fin_str = trim($data[3]);
                        $fecha_fin = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $fecha_fin_str)));
                        $jornada = trim($data[4]);
                        $documento = trim($data[5]);
                        $ambiente = trim($data[6]);
                        $estado_ambiente = 2;

                        // Realiza las validaciones
                        $dataKey = implode(', ', $data); // Crear una clave única para cada fila de datos
                        if ($numero_ficha == '' || $motivo == '' || $fecha_inicio_str == '' || $fecha_fin_str == '' || $jornada == '' || $documento == '' || $ambiente == '') {
                            $response['error'] = 'Existen campos vacíos, completa todos los campos en fila: ' . $dataKey;
                            break;
                        } elseif (count($data) != 7) {
                            $response['error'] = 'Número incorrecto de campos, no corresponde a la plantilla en fila: ' . $dataKey;
                            break;
                        } elseif (in_array($dataKey, $csvData)) {
                            $response['error'] = 'Datos ambiguos o repetidos en fila: ' . $dataKey;
                            break;
                        } elseif (!is_numeric($numero_ficha)) {
                            $response['error'] = 'El numero de ficha no debe contener letras o caracteres especiales en fila: ' . $dataKey;
                            break;
                        } elseif ($fecha_inicio === '1970-01-01 00:00:00') {
                            $response['error'] = 'Fecha de inicio incorrecta en fila ' . $dataKey;
                            break;
                        } elseif ($fecha_fin === '1970-01-01 00:00:00') {
                            $response['error'] = 'Fecha de fin incorrecta en fila ' . $dataKey;
                            break;
                        } elseif (!preg_match('/^\d{6,10}$/', $documento)) {
                            $response['error'] = 'El número de documento debe ser numérico y tener entre 6 y 10 dígitos en fila: ' . $dataKey;
                            break;
                        } elseif (!is_numeric($jornada) || strlen($jornada) !== 1 || ($jornada < 1 || $jornada > 3)) {
                            $response['error'] = 'El campo "jornada" debe ser un único número entre 1 y 3 en fila: ' . $dataKey;
                            break;
                        } elseif ($jornada == 1) {
                            $hora_inicio = date("H:i", strtotime(str_replace('/', '-', $fecha_inicio_str)));
                            $hora_fin = date("H:i", strtotime(str_replace('/', '-', $fecha_fin_str)));

                            if ($hora_inicio < "06:00" || $hora_fin > "12:00") {
                                $response['error'] = 'El horario para la jornada de mañana debe estar entre las 6:00 AM y las 12:00 PM en fila: ' . $dataKey;
                                break;
                            }
                        } elseif ($jornada == 2) {
                            $hora_inicio = date("H:i", strtotime(str_replace('/', '-', $fecha_inicio_str)));
                            $hora_fin = date("H:i", strtotime(str_replace('/', '-', $fecha_fin_str)));

                            if ($hora_inicio < "12:00" || $hora_fin > "18:00") {
                                $response['error'] = 'El horario para la jornada de tarde debe estar entre las 12:00 PM y las 6:00 PM en fila: ' . $dataKey;
                                break;
                            }
                        } elseif ($jornada == 3) {
                            $hora_inicio = date("H:i", strtotime(str_replace('/', '-', $fecha_inicio_str)));
                            $hora_fin = date("H:i", strtotime(str_replace('/', '-', $fecha_fin_str)));

                            if ($hora_inicio < "18:00" || $hora_fin > "22:00") {
                                $response['error'] = 'El horario para la jornada de noche debe estar entre las 6:00 PM y las 10:00 PM en fila: ' . $dataKey;
                                break;
                            }
                        }


                        // Validar si el número de ficha existe en la base de datos
                        $stmt_get_fichan_id = $conexion->prepare("SELECT * FROM programas WHERE ficha = ? ");
                        $stmt_get_fichan_id->bind_param("i", $numero_ficha);
                        $stmt_get_fichan_id->execute();
                        $result_fichan_id = $stmt_get_fichan_id->get_result();
                        if ($result_fichan_id->num_rows === 0) {
                            $response['error'] = 'Número de ficha no encontrado en fila: ' . $dataKey;
                            break;
                        } else {
                            $row_programa_id = $result_fichan_id->fetch_assoc();
                            $programa_id = $row_programa_id['ficha'];
                            $formacion = $row_programa_id['nombreprograma'];
                        }

                        // Obtener ID de la jornada
                        $stmt_get_jornada_id = $conexion->prepare("SELECT id_jornada FROM jornadas WHERE id_jornada = ?");
                        $stmt_get_jornada_id->bind_param("i", $jornada);
                        $stmt_get_jornada_id->execute();
                        $result_jornada_id = $stmt_get_jornada_id->get_result();
                        if ($result_jornada_id->num_rows === 0) {
                            $response['error'] = 'Jornada no encontrada en fila: ' . $dataKey;
                            break;
                        } else {
                            $row_jornada_id = $result_jornada_id->fetch_assoc();
                            $jornada_id = $row_jornada_id['id_jornada'];
                        }


                        // Obtener ID del usuario
                        $stmt_get_user_id = $conexion->prepare("SELECT idusuario FROM usuario WHERE documento = ?");
                        $stmt_get_user_id->bind_param("i", $documento);
                        $stmt_get_user_id->execute();
                        $result_user_id = $stmt_get_user_id->get_result();
                        if ($result_user_id->num_rows === 1) {
                            $row_user_id = $result_user_id->fetch_assoc();
                            $user_id = $row_user_id['idusuario'];
                        } else {
                            $response['error'] = 'Usuario no encontrado en fila: ' . $dataKey;
                            break;
                        }


                        $stmt_get_user_id = $conexion->prepare("SELECT idusuario FROM usuario WHERE documento = ?");
                        $stmt_get_user_id->bind_param("i", $documento);
                        $stmt_get_user_id->execute();
                        $result_user_id = $stmt_get_user_id->get_result();
                        if ($result_user_id->num_rows === 1) {
                            $row_user_id = $result_user_id->fetch_assoc();
                            $user_id = $row_user_id['idusuario'];
                        } else {
                            $response['error'] = 'Usuario no encontrado en fila: ' . $dataKey;
                            break;
                        }

                        // Obtener ID del ambiente
                        $stmt_get_ambiente_id = $conexion->prepare("SELECT idambiente FROM ambiente WHERE numero_ambiente = ?");
                        $stmt_get_ambiente_id->bind_param("i", $ambiente);
                        $stmt_get_ambiente_id->execute();
                        $result_ambiente_id = $stmt_get_ambiente_id->get_result();
                        if ($result_ambiente_id->num_rows === 0) {
                            $response['error'] = 'Ambiente no encontrado en fila: ' . $dataKey;
                            break;
                        } else {
                            $row_ambiente_id = $result_ambiente_id->fetch_assoc();
                            $ambiente_id = $row_ambiente_id['idambiente'];
                        }

                        // Verificar si ya existe un registro con el mismo ambiente, jornada y ficha
                        $stmt_check_duplicate = $conexion->prepare("SELECT COUNT(*) AS count FROM asignacion WHERE idambiente = ? AND jornada = ? AND numero_ficha = ?");
                        $stmt_check_duplicate->bind_param("iii", $ambiente_id, $jornada_id, $programa_id);
                        $stmt_check_duplicate->execute();
                        $result_duplicate = $stmt_check_duplicate->get_result();
                        $row_duplicate = $result_duplicate->fetch_assoc();
                        if ($row_duplicate['count'] > 0) {
                            $response['error'] = 'Ya existen registros con los mismos ambiente, jornada y ficha en fila: ' . $dataKey;
                        } else {
                            $stmt->bind_param("issssiiii", $numero_ficha, $formacion, $motivo, $fecha_inicio, $fecha_fin, $jornada_id, $user_id, $ambiente_id, $estado_ambiente);

                            if ($stmt->execute() !== TRUE) {
                                $response['error'] = 'Error al insertar datos en la base de datos: ' . $stmt->error;
                            } else {
                                $response['success'] = 'Importación exitosa';
                            }
                        }

                        // Agregar esta fila a los datos CSV
                        $csvData[] = $dataKey;
                    }

                    fclose($handle);
                }
            } else {
                $response['error'] = 'Error al abrir el archivo CSV.';
            }
        } else {
            $response['error'] = 'Por favor, seleccione un archivo CSV válido.';
        }
    } else {
        $response['error'] = 'Por favor, seleccione el archivo excel de "asignacion" antes de importar.';
    }
} else {
    $response['error'] = 'No se ha enviado la solicitud de importación.';
}

// Devolver la respuesta JSON con los resultados
header('Content-Type: application/json');
echo json_encode($response);
$conexion->close();
