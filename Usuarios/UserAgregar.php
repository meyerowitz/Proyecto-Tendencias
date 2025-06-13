<?php
session_start();

// Conexión a la base de datos
require_once '../config/config.php'; // Asegúrate de tener tu archivo de configuración aquí

$usuario = $_POST['usuario'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$privilegio_id = $_POST['privilegio'];

// Insertar usuario en la base de datos
$sql = "INSERT INTO Usuarios (Usuario, password, email) VALUES (?, ?, ?)";
$stmt = $cnx->prepare($sql);
$stmt->bind_param("sss", $usuario, $password, $email);
$result = $stmt->execute();

if ($result) {
    // Obtener el ID del usuario recién registrado
    $last_id = $cnx->insert_id;
    
    // Registrar el privilegio del usuario
    $sql = "INSERT INTO Usuario_Privilegios (usuario_id, privilegio_id) VALUES (?, ?)";
    $stmt = $cnx->prepare($sql);
    $stmt->bind_param("ii", $last_id, $privilegio_id);
    $result = $stmt->execute();
    
    if ($result) {
        echo "Registro exitoso. El usuario ha sido creado.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al registrar el privilegio del usuario.";
    }
} else {
    echo "Error al registrar el usuario.";
}

$cnx->close();
?>
