<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluye los archivos necesarios de PHPMailer
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

require_once "Conexion.php";

date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");
$horaI = null;
$horaf = null;
$id_ambiente = isset($_POST["id_ambiente"]) ? intval($_POST["id_ambiente"]) : 0;
$fechaI = isset($_POST["datos"]["form-da-fechai"]) ? $_POST["datos"]["form-da-fechai"] : "";
$fechaf = isset($_POST["datos"]["form-da-fechaf"]) ? $_POST["datos"]["form-da-fechaf"] : "";
$motivo = isset($_POST["datos"]["form-da-motivo"]) ? $_POST["datos"]["form-da-motivo"] : "";
$formacion = null;
$ficha = null;
$estado_fecha = null;
$estado_hora = null;
$id_usuario = null;
$concuerdan = false;
$jornada = 1;

if (isset($_POST["datos"]["form-da-jornada"])) {
    if ($_POST["datos"]["form-da-jornada"] == 1) {
        $jornada = 1;
        $horaI = "06:00:00";
        $horaf = "12:00:00";
    } else if ($_POST["datos"]["form-da-jornada"] == 2) {
        $jornada = 2;
        $horaI = "12:00:00";
        $horaf = "18:00:00";
    } else if ($_POST["datos"]["form-da-jornada"] == 3) {
        $jornada = 3;
        $horaI = "18:00:00";
        $horaf = "22:00:00";
    }
} else {
    $horaI = isset($_POST["datos"]["form-da-horai"]) ? $_POST["datos"]["form-da-horai"] : "";
    $horaf = isset($_POST["datos"]["form-da-horaf"]) ? $_POST["datos"]["form-da-horaf"] : "";
}

if (isset($_POST["datos"]["form-da-nomF"])) {
    $formacion = isset($_POST["datos"]["form-da-nomF"]) ? $_POST["datos"]["form-da-nomF"] : "";
    $ficha = isset($_POST["datos"]["form-da-numF"]) ? intval($_POST["datos"]["form-da-numF"]) : 0;
} else {
    $formacion = "Reunion corta";
    $ficha = 1;
}

if ($_SESSION['rol'] == 1) {
    $id_usuario = isset($_POST["datos"]["form-da-usua"]) ? intval($_POST["datos"]["form-da-usua"]) : 0;
} else {
    $id_usuario = $_SESSION['id'];

    $resul = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$id_usuario'");

    if ($resul) {
        $usuarios = mysqli_fetch_assoc($resul);
        if ($usuarios["idestado"] == 2) {
            $estados = [
                "inac" => true,
                "res" => false
            ];

            echo json_encode($estados);
            exit();
        }
    }
}

$fechaI_times = strtotime($fechaI);
$horaI_times = strtotime($horaI);
$hora_alcanze1 = strtotime("05:00");
$hora_alcanze2 = strtotime("22:00");
$fechaF_times = strtotime($fechaf);
$horaF_times = strtotime($horaf);
$fecha_actual_timestamp = strtotime($fecha_actual);
$hora_actual_timestamp = strtotime($hora_actual);

if ($fechaF_times < $fechaI_times) {
    $estado_fecha = "nocon";
    $concuerdan = true;
}

if ($horaF_times < $horaI_times) {
    $estado_hora = "nocon";
    $concuerdan = true;
}

if ($concuerdan) {
    $estados = [
        "estado_fecha" => $estado_fecha,
        "estado_hora" => $estado_hora,
        "res" => false
    ];

    echo json_encode($estados);
    exit();
}

if ($fechaI_times < $fecha_actual_timestamp) {
    if ($horaI_times < $hora_actual_timestamp) {
        $estados = [
            "estado_fecha" => "ant",
            "estado_hora" => "ant",
            "res" => false
        ];

        echo json_encode($estados);
        exit();
    }
    $estados = [
        "estado_fecha" => "ant",
        "res" => false
    ];

    echo json_encode($estados);
    exit();
}

$fechaI_mas_un_trimestre = strtotime("+3 months", $fechaI_times);

if ($fechaF_times > $fechaI_mas_un_trimestre) {
    $estados = [
        "estado_fecha" => "fechamastri",
        "res" => false
    ];

    echo json_encode($estados);
    exit();
}

if ($horaI_times < $hora_alcanze1 || $horaF_times > $hora_alcanze2) {
    $estado_hora = "alc";

    $estados = [
        "estado_fecha" => $estado_fecha,
        "estado_hora" => $estado_hora,
        "res" => false
    ];

    echo json_encode($estados);
    exit();
}


$fechainicio_com = $fechaI . " " . $horaI;
$fechafin_com = $fechaf . " " . $horaf;

if ($_POST["editar_reser"] != null) {

    $estado_actuali = $_POST["editar_reser"];
    $id_reserva = $_POST["id_reserva"];

    $sql = "UPDATE asignacion SET numero_ficha=?, formacion=?, motivo=?, fecha_inicio=?, fecha_fin=?, jornada=?, idusuario=?, idambiente=?, estado_ambiente=? WHERE idsolicitud=?";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("issssiiiii", $ficha, $formacion, $motivo, $fechainicio_com, $fechafin_com, $jornada, $id_usuario, $id_ambiente, $estado_actuali, $id_reserva);

    if ($stmt->execute()) {
        $estados = [
            "editar_reser" => true,
            "res" => false
        ];

        echo json_encode($estados);
        exit();
    }
}

$res = mysqli_query($conexion, "SELECT * FROM asignacion WHERE idambiente = '$id_ambiente'");

if ($res) {
    while ($fila = mysqli_fetch_assoc($res)) {
        $fecha_inicio = $fila["fecha_inicio"];
        $fecha_fin = $fila["fecha_fin"];

        $parts_inicio = explode(" ", $fecha_inicio);
        $parts_fin = explode(" ", $fecha_fin);

        $fecha_inici = $parts_inicio[0];
        $hora_inicio = $parts_inicio[1];

        $fecha_fi = $parts_fin[0];
        $hora_fin = $parts_fin[1];

        $fecha_inicio_times = strtotime($fecha_inici);
        $fecha_fin_timestamp = strtotime($fecha_fi);
        $hora_inicio_timestamp = strtotime($hora_inicio);
        $hora_fin_timestamp = strtotime($hora_fin);
        $estado_ambiente = $fila["estado_ambiente"];

        if ($_SESSION['rol'] !== 1) {
            $usua = $fila["idusuario"];
            if ($usua == $id_usuario) {
                if ($fecha_inicio_times == $fechaI_times && $hora_inicio == $horaI_times) {
                    $estados = [
                        "estado_fecha" => "igualfechausua",
                        "res" => false
                    ];

                    echo json_encode($estados);
                    exit();
                }
            }
        }
        $id_reserva = $fila["idsolicitud"];
        $cumplirse = true;

        $resul5 = mysqli_query($conexion, "SELECT * FROM reporteactual_ambiente WHERE idreserva = '$id_reserva'");
        if (mysqli_num_rows($resul5) > 0) {
            while ($fila5 = mysqli_fetch_assoc($resul5)) {
                $fechaI_reporte_actu = new DateTime($fila5["fecha_inicio_reporte"]);
                $fechaF_reporte_actu = new DateTime($fila5["fecha_fin_reporte"]);
                while ($fechaI_reporte_actu <= $fechaF_reporte_actu) {
                    $fecha_actual_bd_times = strtotime($fechaI_reporte_actu->format("Y-m-d"));
                    if ($fechaI_times == $fecha_actual_bd_times) {
                        $cumplirse = false;
                    }
                    $fechaI_reporte_actu->add(new DateInterval('P1D'));
                }
            }
        }
        if ($cumplirse) {
            if ($fecha_inicio_times <= $fechaF_times && $fecha_fin_timestamp >= $fechaI_times) {
                if ($estado_ambiente == 2) {
                    $estado_fecha = "ocu";
                }
                if ($hora_inicio_timestamp < $horaF_times && $hora_fin_timestamp > $horaI_times) {
                    if ($estado_ambiente == 2) {
                        $estado_hora = "ocu";

                        $estados = [
                            "estado_fecha" => $estado_fecha,
                            "estado_hora" => $estado_hora,
                            "res" => false
                        ];

                        echo json_encode($estados);
                        exit();
                    }
                }
            }
        }
    }
}

$estado = 1;
$id_reserva = 0;

$sql = "INSERT INTO asignacion (numero_ficha, formacion, motivo, fecha_inicio, fecha_fin, jornada, idusuario, idambiente, estado_ambiente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param("issssiiii", $ficha, $formacion, $motivo, $fechainicio_com, $fechafin_com, $jornada, $id_usuario, $id_ambiente, $estado);

if ($stmt->execute()) {
    $estados = [
        "res" => true
    ];

    $id_reserva = mysqli_insert_id($conexion);

    $datos_reserva = null;
    $resul3 = mysqli_query($conexion, "SELECT * FROM asignacion INNER JOIN jornadas ON  asignacion.jornada = jornadas.id_jornada INNER JOIN usuario ON  asignacion.idusuario = usuario.idusuario INNER JOIN rol_usuario ON  usuario.idrol = rol_usuario.idrol INNER JOIN ambiente ON  asignacion.idambiente = ambiente.idambiente WHERE idsolicitud = '$id_reserva'");

    if ($resul3) {
        $datos_reserva = mysqli_fetch_assoc($resul3);
    }

    $parts_inicio = explode(" ", $datos_reserva["fecha_inicio"]);
    $parts_fin = explode(" ", $datos_reserva["fecha_fin"]);

    $fecha_inici = $parts_inicio[0];
    $hora_inicio = $parts_inicio[1];

    $fecha_fi = $parts_fin[0];
    $hora_fin = $parts_fin[1];
    $contenido_correo = null;

    if ($datos_reserva["numero_ficha"] == 1) {
        $contenido_correo = '
        <h2 style="color: rgb(95,99,104); border-bottom:1px solid; width: 100%; padding: 8px;">Informacion del ambiente a reservar</h2><br>
        <h3 style="color: rgb(95,99,104);">Nombre del ambiente: </h3><p>' . $datos_reserva["nombre_ambiente"] . '</p>
        <h3 style="color: rgb(95,99,104);">Numero del ambiente: </h3><p>' . $datos_reserva["numero_ambiente"] . '</p><br><br>
        <h2 style="color: rgb(95,99,104); border-bottom:1px solid; width: 100%; padding: 8px;">Información de la persona que realizo la reserva</h2><br>
        <h3 style="color: rgb(95,99,104);">Nombre: </h3><p>' . $datos_reserva["nombre_usuario"] . ' ' . $datos_reserva["apellido"] . '</p>
        <h3 style="color: rgb(95,99,104);">Numero de documento: </h3><p>' . $datos_reserva["documento"] . '</p>
        <h3 style="color: rgb(95,99,104);">Correo: </h3><p>' . $datos_reserva["correo"] . '</p>
        <h3 style="color: rgb(95,99,104);">Teléfono: </h3><p>' . $datos_reserva["telefono"] . '</p>
        <h3 style="color: rgb(95,99,104);">Tipo de rol: </h3><p>' . $datos_reserva["nombre_rol"] . '</p><br><br>
        <h2 style="color: rgb(95,99,104); border-bottom:1px solid; width: 100%; padding: 8px;">Informacion de la reserva</h2><br>
        <h3 style="color: rgb(95,99,104);">Tipo de reserva: </h3><p>Reunion corta</p>
        <h3 style="color: rgb(95,99,104);">Motivo: </h3><p>' . $datos_reserva["motivo"] . '</p>
        <h3 style="color: rgb(95,99,104);">Fecha: </h3><p>Fecha reservada del <b>' . $fecha_inici . '</b> hasta el <b>' . $fecha_fi . '</b></p>
        <h3 style="color: rgb(95,99,104);">Horas: </h3><p>De <b>' . $hora_inicio . '</b> hasta <b>' . $hora_fin . '</b></p><br>
        <div style="margin: auto; display: flex; align-items: center; justify-content: space-between; width:100%;">
        <a href="https://adso24.com/asignar/admin.php" style="background-color: #66bb6a; color: white; padding: 10px 15px; text-align: center; border-radius: 4px; cursor: pointer;">Aceptar Solicitud</a>
        <a href="https://adso24.com/asignar/admin.php" style="background-color: #ff5a5a;   margin-left: 50px; color: white; padding: 10px 15px; text-align: center; border-radius: 4px; cursor: pointer;">Rechazar Solicitud</a>
        </div>
        ';
    } else {
        $tipReserva = $datos_reserva["numero_ficha"];
        $contenido_correo = '
        <h2 style="color: rgb(95,99,104); border-bottom:1px solid; width: 100%; padding: 8px;">Informacion del ambiente a reservar</h2><br>
        <h3 style="color: rgb(95,99,104);">Nombre del ambiente: </h3><p>' . $datos_reserva["nombre_ambiente"] . '</p>
        <h3 style="color: rgb(95,99,104);">Numero del ambiente: </h3><p>' . $datos_reserva["numero_ambiente"] . '</p><br><br>
        <h2 style="color: rgb(95,99,104); border-bottom:1px solid; width: 100%; padding: 8px;">Información de la persona que realizo la reserva</h2><br>
        <h3 style="color: rgb(95,99,104);">Nombre: </h3><p>' . $datos_reserva["nombre_usuario"] . ' ' . $datos_reserva["apellido"] . '</p>
        <h3 style="color: rgb(95,99,104);">Numero de documento: </h3><p>' . $datos_reserva["documento"] . '</p>
        <h3 style="color: rgb(95,99,104);">Correo: </h3><p>' . $datos_reserva["correo"] . '</p>
        <h3 style="color: rgb(95,99,104);">Teléfono: </h3><p>' . $datos_reserva["telefono"] . '</p>
        <h3 style="color: rgb(95,99,104);">Tipo de rol: </h3><p>' . $datos_reserva["nombre_rol"] . '</p><br><br>
        <h2 style="color: rgb(95,99,104); border-bottom:1px solid; width: 100%; padding: 8px;">Informacion de la reserva</h2><br>
        <h3 style="color: rgb(95,99,104);">Tipo de reserva: </h3><p>Formación</p>
        <h3 style="color: rgb(95,99,104);">Motivo: </h3><p>' . $datos_reserva["motivo"] . '</p>
        <h3 style="color: rgb(95,99,104);">Ficha: </h3><p>' . $tipReserva . '</p>
        <h3 style="color: rgb(95,99,104);">Formación: </h3><p>' . $datos_reserva["formacion"] . '</p>
        <h3 style="color: rgb(95,99,104);">Jornada: </h3><p>' . $datos_reserva["jornada"] . '</p>
        <h3 style="color: rgb(95,99,104);">Fecha: </h3><p>Fecha reservada del <b>' . $fecha_inici . '</b> hasta el <b>' . $fecha_fi . '</b></p>
        <h3 style="color: rgb(95,99,104);">Horas: </h3><p>De <b>' . $hora_inicio . '</b> hasta <b>' . $hora_fin . '</b></p><br>
        <div style="margin: auto; display: flex; align-items: center; justify-content: space-between; width:100%;">
        <a href="https://adso24.com/asignar/admin.php" style="text-decoration: none; background-color: #66bb6a; color: white; padding: 10px 15px; text-align: center; border-radius: 4px; cursor: pointer;">Aceptar reserva</a>
        <a href="https://adso24.com/asignar/admin.php" style="text-decoration: none; background-color: #ff5a5a;   margin-left: 50px; color: white; padding: 10px 15px; text-align: center; border-radius: 4px; cursor: pointer;">Rechazar reserva</a>
        </div>
        ';
    }

    // Crea una instancia de PHPMailer; pasando `true` habilita las excepciones
    $mail = new PHPMailer(true);


    // Configuración del servidor SMTP y autenticación
    $mail->isSMTP(); // Utiliza el método SMTP para enviar el correo
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
    $mail->SMTPAuth = true; // Habilita la autenticación SMTP
    $mail->Username = 'asignaciondeambiente24@gmail.com'; // Nombre de usuario de la cuenta de Gmail para enviar correos
    $mail->Password = 'ciukiryyvcvqrsqt'; // Contraseña de la cuenta de Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilita la encriptación TLS implícita
    $mail->Port = 465; // Puerto TCP para conectar con el servidor SMTP

    // Configuración de los destinatarios y el contenido del correo
    $mail->setFrom('alexandercaicedosalgado@gmail.com', 'Sistema asignacion de ambientes'); // Dirección y nombre del remitente
    $mail->addAddress('alexandercaicedosalgado@gmail.com', ''); // Agrega un destinatario y, opcionalmente, un nombre
    $rempalze = $mail->addReplyTo('info@example.com', 'Information'); // Configura la dirección de respuesta del correo
    $mail->isHTML(true); // Habilita el formato HTML para el contenido del correo
    $mail->Subject = 'NUEVA RESERVA  AMBIENTE ' . $datos_reserva["numero_ambiente"]; // Asunto del correo


    // Contenido del correo en formato HTML (ejemplo de factura)
    $mail->Body = '' . $contenido_correo . '';



    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Cuerpo alternativo en texto plano para clientes que no admiten HTML

    // Envía el correo y manejo de excepciones
    $mail->send(); // Envía el correo


    echo json_encode($estados);
} else {
    echo "Error al insertar el registro: " . $stmt->error;
}

$stmt->close();
