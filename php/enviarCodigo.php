<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluye los archivos necesarios de PHPMailer
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

// Crea una instancia de PHPMailer; pasando `true` habilita las excepciones
$mail = new PHPMailer(true);

// Configuración del servidor SMTP y autenticación
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilita la salida de depuración detallada del servidor
$mail->isSMTP(); // Utiliza el método SMTP para enviar el correo
$mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
$mail->SMTPAuth = true; // Habilita la autenticación SMTP
$mail->Username = 'asignaciondeambiente24@gmail.com'; // Nombre de usuario de la cuenta de Gmail para enviar correos
$mail->Password = 'ciukiryyvcvqrsqt'; // Contraseña de la cuenta de Gmail
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilita la encriptación TLS implícita
$mail->Port = 465; // Puerto TCP para conectar con el servidor SMTP

// Configuración de los destinatarios y el contenido del correo
$mail->setFrom($correo, 'Recuperacion'); // Dirección y nombre del remitente
$mail->addAddress($correo, ''); // Agrega un destinatario y, opcionalmente, un nombre
$mail->addReplyTo('info@example.com', 'Information'); // Configura la dirección de respuesta del correo
$mail->isHTML(true); // Habilita el formato HTML para el contenido del correo
$mail->Subject = 'RECUPERACION DE CUENTA'; // Asunto del correo

$mail->Body = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Cuenta</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: Arial, sans-serif; height: 15rem; width: 100vw; display: flex; justify-content: center; align-items: center;">

<div class="card" style="width: 80%; max-width: 400px; background-color: #f0f2f5; border-radius: 10px; overflow: hidden; text-align: center;">
    <img src="https://www.sena.edu.co/Style%20Library/alayout/images/logoSena.png" alt="Logo SENAI" style="width: 7rem; height: 7rem; object-fit: cover; margin-top: 20px;">
    <div style="padding: 20px;">
        <p style="color: #363636; font-weight: bold; margin: 0;">Tu código de verificación</p>
        <b style="font-size: 24px;">' . $codigoGenerado . '</b>
    </div>
</div>

</body>
</html>
';

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Cuerpo alternativo en texto plano para clientes que no admiten HTML

// Envía el correo y manejo de excepciones
$mail->send(); // Envía el correo
?>