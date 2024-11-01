<?php
include 'conexion.php'; // Archivo para la conexión a la base de datos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Verificar que los datos estén disponibles
    if (isset($data['nombre'], $data['email'], $data['password'])) {
        $nombre = $data['nombre'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(50)); // Token único para verificación
        $estado_validacion = 1; // Estado "noVerificado" referenciado desde tu tabla "estados"

        // Verificar si el correo ya está registrado
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo json_encode(["message" => "El correo ya está registrado."]);
        } else {
            // Insertar el nuevo usuario con estado noVerificado
            $sql = "INSERT INTO usuarios (nombre, email, password, estado_validacion, token) 
                    VALUES ('$nombre', '$email', '$password', '$estado_validacion', '$token')";

            if ($conn->query($sql) === TRUE) {
                // Enviar el correo de verificación con PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor SMTP de Gmail
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'arielplante02@gmail.com';
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
                    echo json_encode(["message" => "Usuario registrado con éxito. Revisa tu correo electrónico para validar la cuenta."]);
                } catch (Exception $e) {
                    echo json_encode(["message" => "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}"]);
                }
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        }
    } else {
        echo json_encode(["message" => "Faltan datos en la solicitud."]);
    }
}
?>
