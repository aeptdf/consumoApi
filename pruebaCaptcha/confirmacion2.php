<?php
session_start();

// Verificamos si se envió el formulario y si el campo de confirmación está definido
if (isset($_POST['confirmacion'])) {
    $codigo_usuario = $_POST['confirmacion'];

    // Comparamos el código ingresado por el usuario con el generado y almacenado en la sesión
    if ($codigo_usuario == $_SESSION['codigos']) {
        echo "¡El código CAPTCHA es correcto!";
    } else {
        echo "Código incorrecto. Por favor, intente nuevamente.";
    }
} else {
    echo "No se ha enviado ningún código.";
}
?>
