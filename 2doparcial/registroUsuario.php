<?php
session_start();
$errorMessage = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro de Usuario</title>
    <script>
        // Función para mostrar el popup
        function showPopup(message) {
            alert(message);
        }

        // Mostrar el mensaje de error o éxito si existe
        window.onload = function() {
            <?php if ($errorMessage): ?>
                showPopup('<?php echo addslashes($errorMessage); ?>');
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="registroApi.php" method="POST">
        <input type="text" name="nombre" placeholder="Ingresa tu nombre" required>
        <input type="email" name="email" placeholder="Ingresa tu correo electrónico" required>
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
        <button type="submit">Registrarse</button> <!-- Botón de registro -->
    </form>

    <div class="login-links">
        <p>¿Ya tienes una cuenta?<a href="loginUsuario.php" class="login-link">Inicia sesión aquí.</a></p>
    </div>
</body>
</html>
