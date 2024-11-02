<?php
$servername = "localhost";
$username = "Ariel";
$password = "ivIqnedv@pcil_SC";
$dbname = "gestion_usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
