<?php
session_start();
include 'conexion.php'; // Archivo para la conexión a la base de datos

// Verificar el estado de inicio de sesión
$successMessage = '';
$errorMessage = isset($_GET['message']) ? $_GET['message'] : '';

if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $successMessage = "Inicio de sesión exitoso.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6Le4Z2wqAAAAAMxTkOJWkBA9D7KmVIC_XSUqIpaG"></script>
    <title>Iniciar Sesión</title>
    <script>
        // Función para mostrar el popup
        function showPopup(message) {
            alert(message);
        }

        // Mostrar el mensaje de error o éxito si existe
        window.onload = function() {
            <?php if ($errorMessage): ?>
                showPopup('<?php echo addslashes($errorMessage); ?>');
            <?php elseif ($successMessage): ?>
                showPopup('<?php echo addslashes($successMessage); ?>');
            <?php endif; ?>
        };
    </script>
        <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Le4Z2wqAAAAAMxTkOJWkBA9D7KmVIC_XSUqIpaG', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          });
        });
      }
    </script>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="loginApi.php" method="POST">
        <input type="email" name="email" placeholder="Ingresa tu correo electrónico" required>
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
        <button type="submit">Iniciar Sesión</button> <!-- Botón de inicio de sesión -->
    </form>

    <div class="login-links">
        <p><a href="registroUsuario.php" class="login-link">¿No tienes una cuenta? Regístrate aquí.</a></p>
        <p><a href="restablecerFormulario.html" class="login-link">¿Olvidaste tu contraseña? Restablece aquí.</a></p>
    </div>
</body>
</html>
