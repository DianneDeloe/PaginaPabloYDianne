<?php
session_start();
include 'conexion.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Validar las credenciales
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? AND contraseña = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['usuario'] = $user['nombre_usuario'];
    $_SESSION['rol'] = $user['rol'];

    // Generar OTP y almacenarlo en la sesión
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    // Simulación de envío de OTP (deberías enviar por correo o SMS en una implementación real)
    echo "OTP enviado: $otp"; // Esto es solo para mostrar en pantalla

    header("Location: verificar_otp.html");
} else {
    echo "Usuario o contraseña incorrectos.";
}

$stmt->close();
$conn->close();
?>
