<?php
session_start(); // Asegúrate de iniciar la sesión al principio

// Verifica si la sesión ya está abierta
if (isset($_SESSION['usuario'])) 
{
    header('Location: ../noti/menu.php'); // Redirige al usuario a la página de índice
    exit;
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500&display=swap" rel="stylesheet">    
</head>
<body>
    	
	<header>
        <h1>Sistema de Noticias</h1>
		<p>Bienvenidos</p>		 
    </header>
	
	<nav>
	
        <p class="logo-danicodex">SISTEMAS DE NOTICIAS</p>
        <ul class="cont-ul">      
		<li class="nav-item active">
                <a class="nav-link" href="../">Inicio</a>
            </li>		
			
			<li class="nav-item active">
				<a class="nav-link" href="../chatbot/">Chatbot</a>
			</li>		
			
			<li class="develop">
                <a class="nav-link" href="#">Formularios</a>
                <ul class="ul-second">                          
						<li><a href="../inicio/alumnuevo.php">Nuevo</a></li>
                        <li><a href="../inicio/alumbuscar.php">Buscar</a></li>
                        <li><a href="../inicio/alumlistar.php">Listar</a></li>							
                </ul>
            </li>         
			
			<li class="nav-item active">
                <a class="nav-link" href="../Usuarios/login.php">Accesar</a>
            </li>		
		</ul>
    </nav>
    
    <?php
    // Connect to the database
    include_once '../config/config.php';

    // Query to get all news articles
    $sql = "SELECT * FROM noticias ORDER BY id DESC LIMIT 15";
    $result = $cnx->query($sql);

    echo "<table>";
    echo "<caption>Últimas 15 Noticias</caption>";
    echo "<tr>";
    echo "<th>Imagen</th>";
    echo "<th>Título</th>";
    echo "<th>Contenido</th>";
    echo "<th>Fecha</th>";
    echo "</tr>";
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . $row["imagen"] . "' alt='Imagen de la noticia'></td>";
            echo "<td>" . $row["titulo"] . "</td>";
            echo "<td>" . substr($row["contenido"], 0, 200) . "...</td>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay noticias disponibles.</td></tr>";
    }
    
    echo "</table>";

    // Close connection
    $cnx->close();
    ?>
</body>
</html>

