<?php
session_start(); // Asegúrate de iniciar la sesión al principio

// Verifica si la sesión ya está abierta
if (isset($_SESSION['usuario'])) 
{
    header('Location: ../noti/NoticiaListar.php'); // Redirige al usuario a la página de índice
    exit;
}


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Acceder</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Inicio de Seccion</h1>			
			<form action="accesar.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>				
				<input type="text" name="usuario" placeholder="usuario"  id="usuario" required><br>
				
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Contraseña" id="password" required>				
				<input type="submit" value="Acceder">
			</form>
		</div>
	</body>
</html>