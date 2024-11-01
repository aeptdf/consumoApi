<?php
session_start();
include 'conexion.php'; // Archivo para la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Verificar que se hayan proporcionado ambos campos
    if (empty($email) || empty($password)) {
        header("Location: loginUsuario.php?message=Por%20favor,%20complete%20todos%20los%20campos.");
        exit;
    }

    // Consultar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        header("Location: loginUsuario.php?message=No%20se%20encontró%20un%20usuario%20con%20ese%20correo%20electrónico.");
        exit;
    } else {
        $user = $result->fetch_assoc();

        // Verificar si el usuario está verificado
        if ($user['estado_validacion'] != 2) { // 2 indica "verificado"
            header("Location: loginUsuario.php?message=Su%20cuenta%20no%20está%20verificada.%20Por%20favor,%20verifique%20su%20correo%20electrónico.");
            exit();
        }

        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Suponiendo que 'id' es el campo de ID del usuario
            header("Location: loginUsuario.php?status=success");
            exit();
        } else {
            header("Location: loginUsuario.php?message=Contraseña%20incorrecta.");
            exit();
        }
    }
} else {
    header("Location: loginUsuario.php?message=Método%20de%20solicitud%20no%20permitido.");
    exit();
}
?>
