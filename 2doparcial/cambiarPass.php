<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nueva_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Actualizar contraseña en la base de datos
    $sql = "UPDATE usuarios SET password='$nueva_password', token=NULL WHERE token='$token'";
    if ($conn->query($sql) === TRUE) {
        echo "Contraseña actualizada con éxito.";
    } else {
        echo "Error al actualizar la contraseña.";
    }
}
?>
