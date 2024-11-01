<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace a tu archivo CSS -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("registro-usuario").submit();
        }
    </script>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form id="registro-usuario" action="registroApi.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button class="g-recaptcha" 
        data-sitekey="6Le4Z2wqAAAAAMxTkOJWkBA9D7KmVIC_XSUqIpaG" 
        data-callback='onSubmit' 
        data-action='submit'>Registrarse</button>
    </form>

    <p>¿Ya tienes una cuenta? <a href="loginUsuario.php">Inicia sesión aquí</a></p> <!-- Enlace al login -->
</body>
</html>
