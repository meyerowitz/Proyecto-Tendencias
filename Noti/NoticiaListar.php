<?php

if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}

$privilegio = '';

include_once '../config/config.php';

 // Query to get all news articles
    $sql = "SELECT * FROM noticias ORDER BY id DESC LIMIT 15";
    $result1 = $cnx->query($sql);

if (isset($_SESSION['usuario'])) 
{
	$usuario = $_SESSION['usuario'];
	try 
		{
			$stmt = $cnx->prepare("SELECT p.nombre_privilegio FROM Usuario_Privilegios up JOIN Privilegios p ON up.privilegio_id = p.id WHERE up.usuario_id = (SELECT id FROM Usuarios WHERE Usuario = ?)");
			$stmt->bind_param("s", $usuario);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc()) 
					{
						$privilegio = $row["nombre_privilegio"];						
					}
				} 
				else 
				{
					echo "No se encontraron privilegios para este usuario.";
				}

			$stmt->close();			
		} 
		catch (Exception $e) 
		{
			echo "Error: " . $e->getMessage();
		}
}
else 
{
	echo "<h1>Invitado</h1>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500&display=swap" rel="stylesheet">
    <title>Sistema</title>
</head>
<body>
	
	<?php
    
    echo "<table>";
    echo "<caption>Últimas 15 Noticias</caption>";
    echo "<tr>";
    echo "<th>Imagen</th>";
    echo "<th>Título</th>";
    echo "<th>Contenido</th>";
    echo "<th>Fecha</th>";
	if ($privilegio == 'Webmaster' || $privilegio == 'Admin') 
	{
	echo "<th>Editar</th>";
    echo "<th>Eliminar</th>";
    }
	echo "</tr>";
	    
    if ($result1->num_rows > 0) {
        // Output data of each row
        while($row = $result1->fetch_assoc()) 
		{
            echo "<tr>";
            echo "<td><img src='" . $row["imagen"] . "' alt='Imagen de la noticia'></td>";
            echo "<td>" . $row["titulo"] . "</td>";
            echo "<td>" . substr($row["contenido"], 0, 200) . "...</td>";
            echo "<td>" . $row["fecha"] . "</td>";
			
			if ($privilegio == 'Webmaster' || $privilegio == 'Admin') 
			{
			 // Edit button
            echo "<td><a href='../noti/editar_noticia.php?id=" . $row['id'] . "' class='edit'>Edit</a></td>";
            
            // Delete button
            echo "<td><a href='../noti/Eliminar_noticia.php?id=" . $row['id'] . "'>Delete</a></td>";
            }
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