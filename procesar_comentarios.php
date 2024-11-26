<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$database = "musica_base";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST['nombre']);
    $comment = sanitizeInput($_POST['comentario']);
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : null;

    $stmt = $conn->prepare("INSERT INTO comentarios (nombre, comentario, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $comment, $email);

    if ($stmt->execute()) {
        echo "Comentario enviado exitosamente.";
    } else {
        echo "Error al enviar el comentario: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();

header("Location: comentarios.html");
exit();
?>
