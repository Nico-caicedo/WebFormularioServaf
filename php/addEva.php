<?php
session_start();



include './Conexion.php';

$id_evaluacion = $_SESSION['id_evaluacion'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $documento = $_POST['documento'];
    $idDependencia = $_POST['dependencia'];
    $IdCargo = $_POST['IdCargo'];
    $Antiguedad = $_POST['Antiguedad'];
    $TiempoServicio = $_POST['TiempoServicio'];
    $iduser = $_POST['number999'];
    $IdEvaluado = $_POST['IdEvaluado'];
    $Estado = 1;
    $Val = array(
        $_POST['Val1'],
        $_POST['Val2'],
        $_POST['Val3'],
        $_POST['Val4'],
        $_POST['Val5'],
        $_POST['Val6'],
        $_POST['Vall7'],
        $_POST['Val8'],
        $_POST['Val9'],
        $_POST['Val10'],
        $_POST['Val11'],
        $_POST['Val12']
    );


    $Id = array(
        $_POST['P1'],
        $_POST['P2'],
        $_POST['P3'],
        $_POST['P4'],
        $_POST['P5'],
        $_POST['P6'],
        $_POST['P7'],
        $_POST['P8'],
        $_POST['P9'],
        $_POST['P10'],
        $_POST['P11'],
        $_POST['P12']
    );




    $insert = mysqli_prepare($conexion, "INSERT INTO calificacion (IdEvaluado, IdPregunta, IdEvaluacion, Calificacion, Estado) VALUES (?, ?, ?, ?, ?)");

    // Declarar las variables antes de usarlas en mysqli_stmt_bind_param
    $IdPregunta = 0;
    $Calificacion = 0;

    mysqli_stmt_bind_param($insert, "iiiii", $IdEvaluado, $IdPregunta, $id_evaluacion, $Calificacion, $Estado);

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

    $sql_update = "UPDATE evaluaciones
    SET Observacion1=?, Observacion2=?, Observacion3=?, Observacion4=?, Acuerdos=?, Capacitacion=? 
    WHERE IdEvaluacion = ?";


$Observacion1 = $_POST['Observacion1'];
$Observacion2 = $_POST['Observacion2'];
$Observacion3 = $_POST['Observacion3'];
$Observacion4 = $_POST['Observacion4'];
$Acuerdos = $_POST['Acuerdo'];
$Capacitacion = $_POST['Capacitacion'];

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql_update);

    // Vincular los parámetros
    $stmt->bind_param("ssssssi", $Observacion1, $Observacion2, $Observacion3, $Observacion4, $Acuerdos, $Capacitacion, $id_evaluacion);

    // Asignar valores a las variables

 
    // Ejecutar la consulta
    $stmt->execute();

    // Cerrar la declaración
    $stmt->close();

    // Asegúrate de que la conexión esté definida
    if (isset($conexion)) {
        // Corrige el nombre de la tabla y las columnas en la consulta SQL
        $update = mysqli_query($conexion, "UPDATE users SET Nombre1 = '$nombre1', Nombre2 = '$nombre2', Apellido1 = '$apellido1', 
            Apellido2 = '$apellido2', Document = '$documento', Antiguedad = '$Antiguedad', TiempoServicio = '$TiempoServicio' WHERE IdUser = '$iduser'");

        // Agrega manejo de errores
        if ($update) {
            // Actualización exitosa
            $response['message'] = 'Actualización exitosa';
        } else {
            // Error en la actualización
            $response['status'] = 'error';
            $response['message'] = 'Error en la actualización: ' . mysqli_error($conexion);
        }
    } else {
        // Error de conexión
        $response['status'] = 'error';
        $response['message'] = 'Error de conexión';
    }
}

// No está claro de dónde viene $response, pero lo dejo tal como está en tu código original
echo json_encode($response);
