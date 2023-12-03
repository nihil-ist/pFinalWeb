<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si el captcha es correcto
    if (isset($_POST['captcha']) && $_POST['captcha'] === $_SESSION['captcha']) {
        // Captcha válido, proceder con la verificación del usuario (aquí deberías verificar el usuario y la contraseña)
        echo "Captcha válido. Usuario y contraseña verificados.";
    } else {
        // Captcha incorrecto, mostrar mensaje de error
        echo "Captcha incorrecto. Verifica e intenta de nuevo.";
    }

    // Limpiar el valor del captcha en la sesión
    unset($_SESSION['captcha']);
}
?>
