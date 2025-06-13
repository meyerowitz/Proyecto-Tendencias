<?php
// La contraseña que deseas cifrar
$password = '11880258';
$password1 = '12345678';

// Genera el hash de la contraseña
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$hashedPassword1 = password_hash($password1, PASSWORD_BCRYPT);
// Imprime el hash generado para su uso posterior
echo $hashedPassword;
echo '<br><br>';
echo $hashedPassword1;
?>

