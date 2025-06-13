<?php 
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sistema_noticia";

	// Crear conexión
	$cnx = new mysqli($servername, $username, $password, $dbname);

	// Verificar conexión
	if ($cnx->connect_error) 
	{
		die("Conexión fallida: " . $cnx->connect_error);
	}
?>
