<?php
session_start();
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

    // Validación de la contraseña
    if (strlen($password) < 8) {
        header("Location: registroUsuario.php?message=La%20contraseña%20debe%20tener%20al%20menos%208%20caracteres.");
        exit;
    }

    // Verificar si el correo ya está registrado
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mensaje de error
        header("Location: registroUsuario.php?message=El%20correo%20ya%20está%20registrado.");
        exit;
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
                header("Location: registroUsuario.php?message=Usuario%20registrado%20con%20éxito.%20Revisa%20tu%20correo%20electrónico%20para%20validar%20la%20cuenta.");
                exit();
            } catch (Exception $e) {
                // Mensaje de error en envío
                header("Location: registroUsuario.php?message=El%20mensaje%20no%20pudo%20ser%20enviado.%20Error:%20{$mail->ErrorInfo}");
                exit();
            }
        } else {
            // Mensaje de error en la consulta
            header("Location: registroUsuario.php?message=Error:%20" . $conn->error);
            exit();
        }
    }
} else {
    header("Location: registroUsuario.php?message=Faltan%20datos%20en%20la%20solicitud.");
    exit();
}
?>
