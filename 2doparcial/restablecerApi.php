<?php
include 'conexion.php'; // Archivo para la conexión a la base de datos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $token = bin2hex(random_bytes(50)); // Generar un token único para el restablecimiento

    // Verificar si el correo existe
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Mensaje de error si el correo no está registrado
        echo "El correo no está registrado.";
    } else {
        // Actualizar el token en la base de datos para el usuario correspondiente
        $sql = "UPDATE usuarios SET token='$token' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            // Enviar el correo de restablecimiento con PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP de Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'arielplante02@gmail.com'; // Cambia esto por tu correo
                $mail->Password = 'ubnv fktt uqis pnhv'; // Contraseña de aplicación o clave específica
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Configuración del correo
                $mail->setFrom('arielplante02@gmail.com', 'WachinDeRulos');
                $mail->addAddress($email);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Restablecer contraseña';
                $mail->Body = "Para restablecer tu contraseña, haz clic en el siguiente enlace: <a href='http://localhost/consumoApi/consumoApi/2doparcial/restablecerPass.php?token=$token'>Restablecer contraseña</a>";

                // Enviar el correo
                $mail->send();

                // Mensaje de éxito
                echo "Se ha enviado un enlace para restablecer tu contraseña a tu correo electrónico.";
            } catch (Exception $e) {
                // Mensaje de error en envío
                echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
            }
        } else {
            // Mensaje de error en la actualización
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Faltan datos en la solicitud."; // Mensaje en texto plano
}
?>
