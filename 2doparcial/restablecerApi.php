<?php
include 'conexion.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generar token único

    // Actualizar token en la base de datos
    $sql = "UPDATE usuarios SET token='$token' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        $url_reset = "http://localhost/cambiarPass.php?token=$token";
        mail($email, "Restablecer Contraseña", "Haga clic aquí para restablecer su contraseña: $url_reset");
        echo "Correo enviado con éxito.";
    } else {
        echo "Correo no encontrado.";
    }
}
?>
