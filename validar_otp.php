<?php
session_start();

if ($_POST['otp'] == $_SESSION['otp']) {
    echo "OTP correcto. Bienvenido " . $_SESSION['usuario'];

    if ($_SESSION['rol'] == 'admin') {
        header('Location: admin_dashboard.php');
    } else if ($_SESSION['rol'] == 'editor') {
        header('Location: editor_dashboard.php');
    } else {
        header('Location: comentarios.html');
    }
} else {
    echo "OTP incorrecto.";
}
?>
