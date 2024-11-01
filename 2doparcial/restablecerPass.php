<?php
date_default_timezone_set('America/Argentina/Buenos_Aires'); // Establecer la zona horaria
include 'conexion.php'; // Archivo para la conexión a la base de datos
session_start();

// Verificar si el token está presente en la URL
if (!isset($_GET['token'])) {
    echo "Token no válido.";
    exit();
}

$token = $_GET['token'];

// Verificar si el token existe en la base de datos
$sql = "SELECT * FROM usuarios WHERE token='$token'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Token no válido.";
    exit();
}

// Si el token es válido, proceder con el formulario de restablecimiento de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva_contraseña = $_POST['nueva_contraseña'] ?? '';
    
    // Encriptar la nueva contraseña
    $hashed_password = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
    
    // Generar un nuevo token
    $nuevo_token = bin2hex(random_bytes(50)); // Generar un nuevo token

    // Actualizar la contraseña y la fecha de modificación en la base de datos
    $fecha_modificacion = date("Y-m-d H:i:s"); // Fecha actual
    $sql = "UPDATE usuarios 
            SET password='$hashed_password', token='$nuevo_token', fecha_modificacion='$fecha_modificacion' 
            WHERE token='$token'";
    
    if ($conn->query($sql) === TRUE) {
        // Mostrar el popup después de restablecer la contraseña
        echo "<script>
                alert('Contraseña restablecida con éxito. Puedes iniciar sesión.');
                window.location.href = 'loginUsuario.php'; // Redirigir a login
              </script>";
        exit();
    } else {
        echo "Error al actualizar la contraseña: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h2>Restablecer Contraseña</h2>
    <form action="" method="POST">
        <input type="password" name="nueva_contraseña" placeholder="Ingresa tu nueva contraseña" required>
        <button type="submit">Restablecer Contraseña</button>  
    </form>
</body>
</html>
