<?php
include 'conexion.php'; // Conectar a la base de datos

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "UPDATE usuarios SET estado_validacion = 2 WHERE token='$token'";
    if ($conn->query($sql) === TRUE) {
        echo "Cuenta verificada correctamente.";
    } else {
        echo "Token inválido o cuenta ya verificada.";
    }
}
?>
