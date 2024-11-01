<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="loginApi.php">
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Iniciar Sesión</button>
    </form>

    <p>¿No tienes una cuenta? <a href="registroUsuario.php">Regístrate aquí</a></p> <!-- Enlace al registro -->
    <!-- Enlace para restablecer la contraseña -->
    <p>
        ¿Olvidaste tu contraseña? 
        <a href="restablecerFormulario.html">Haz clic aquí para restablecerla</a>
    </p>
</body>
</html>
