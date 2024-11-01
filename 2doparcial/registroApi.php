<?php
include 'conexion.php'; // Archivo para la conexión a la base de datos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $token = bin2hex(random_bytes(50)); // Token único para verificación
    $estado_validacion = 1; // Estado "noVerificado" referenciado desde tu tabla "estados"

    // Verificar si el correo ya está registrado
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mensaje de error
        $message = "El correo ya está registrado.";
        echo $message; // Enviar como texto plano
    } else {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar el nuevo usuario con estado noVerificado
        $sql = "INSERT INTO usuarios (nombre, email, password, estado_validacion, token) 
                VALUES ('$nombre', '$email', '$hashed_password', '$estado_validacion', '$token')";

        if ($conn->query($sql) === TRUE) {
            // Enviar el correo de verificación con PHPMailer
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
                $mail->Subject = 'Confirma tu registro';
                $mail->Body = "Hola $nombre, <br> Por favor, verifica tu cuenta haciendo clic en el siguiente enlace: <a href='http://localhost/consumoApi/consumoApi/2doparcial/verificar.php?token=$token'>Confirmar cuenta</a>";

                // Enviar el correo
                $mail->send();

                // Mensaje de éxito
                echo "Usuario registrado con éxito. Revisa tu correo electrónico para validar la cuenta.";
            } catch (Exception $e) {
                // Mensaje de error en envío
                echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
            }
        } else {
            // Mensaje de error en la consulta
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Faltan datos en la solicitud."; // Mensaje en texto plano
}
?>
