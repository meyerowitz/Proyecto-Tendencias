<?php
session_start(); // Inicia una nueva sesión o reanuda la existente

require_once '../config/config.php'; // Asegúrate de tener tu archivo de configuración aquí

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Preparar y ejecutar la consulta SQL para buscar al usuario
$query = "SELECT * FROM Usuarios WHERE Usuario = ?";
$stmt = $cnx->prepare($query);
$stmt->bind_param('s', $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si el usuario existe, obtener su contraseña hasheada
    $row = $result->fetch_assoc();
    $password_hash = $row['password'];

    // Verificar la contraseña
    if (password_verify($password, $password_hash)) {
        // La contraseña es correcta, iniciar sesión
        $_SESSION['usuario'] = $usuario; // Guarda el nombre de usuario en la sesión
        header("Location: ../noti/NoticiaListar.php"); // Redirige al usuario a la página de dashboard
        exit;
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    echo "Usuario no encontrado.";
}

$stmt->close();
$cnx->close();

// Add this line at the end of your script
header("Location: login.php");
exit();
?>

