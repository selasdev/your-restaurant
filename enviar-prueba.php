<?php
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];

$body = "Nombre: " . $nombre .  "<br>Correo: " . $correo . "<br>Telefono: " . $telefono . "<br>Mensaje: " . $mensaje;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'correo';  // SMTP username
    $mail->Password = 'contra';                       // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('correo', 'Correo de formulario');
    $mail->addAddress('destino');          // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Se ha enviado un mensaje desde el formulario.';
    $mail->Body    = $body;
    $mail->CharSet = 'UTF-8';

    $mail->send();
    echo '<script>
            alert("El mensaje se envió correctamente");
            window.history.go(-1);
            </script>';
} catch (Exception $e) {
    echo 'Hubo un error al enviar el mensaje. Error: ', $mail->ErrorInfo;
}