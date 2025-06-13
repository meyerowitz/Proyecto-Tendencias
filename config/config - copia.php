<?php 
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "rol";

	$conexion = new mysqli($host, $user, $password, $db);

	if($conexion->connect_error){
	echo "Falló la conexión a la base de datos " . $conexion->connect_error;
}
?>