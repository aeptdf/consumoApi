<?php
include 'conexion.php'; // Archivo para la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Verificar que se hayan proporcionado ambos campos
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos."; // Mensaje en texto plano
        exit;
    }

    // Consultar si el usuario existe y está verificado
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        echo "No se encontró un usuario con ese correo electrónico.";
    } else {
        $user = $result->fetch_assoc();

        // Verificar si el usuario está verificado
        if ($user['estado_validacion'] != 2) { // 2 indica "verificado"
            echo "Su cuenta no está verificada. Por favor, verifique su correo electrónico.";
            exit;
        }

        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            echo "Inicio de sesión exitoso.";
            // Aquí puedes agregar la lógica para iniciar sesión al usuario
        } else {
            echo "Contraseña incorrecta.";
        }
    }
} else {
    echo "Método de solicitud no permitido."; // Mensaje en texto plano
}
?>
