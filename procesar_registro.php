<?php
include 'conexion.php';

$username = $_POST['username'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Validar si el usuario ya existe
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Este usuario ya existe.";
} else {
    // Registrar nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, contraseña, rol) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $rol);
    $stmt->execute();
    echo "Registro exitoso. Ahora puedes iniciar sesión.";
}

$stmt->close();
$conn->close();
?>
