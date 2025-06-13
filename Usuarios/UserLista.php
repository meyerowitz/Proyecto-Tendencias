<?php
// Start the session if it hasn't started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) 
		{
			// Si no está logrado, redirigimos al usuario a la página de inicio
			header("Location: ../frame/contenido.php");
			exit();
		}

// Initialize privilege variable
$privilegio = '';

// Include configuration file
include_once '../config/config.php';

// Query to get all news articles
$sql = "SELECT id, Usuario, email FROM Usuarios";
$result1 = $cnx->query($sql);

// Check if user is authenticated
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    try {
        // Prepare and execute the query to get user privileges
        $stmt = $cnx->prepare("SELECT p.nombre_privilegio FROM Usuario_Privilegios up JOIN Privilegios p ON up.privilegio_id = p.id WHERE up.usuario_id = (SELECT id FROM Usuarios WHERE Usuario = ?)");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $privilegio = $row["nombre_privilegio"];
            }
        } else {
            echo "No se encontraron privilegios para este usuario.";
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Error al obtener los privilegios: " . $e->getMessage();
    }
} else {
    echo "<h1>Invitado</h1>";
}

// Output HTML content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../Usuarios/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500&display=swap" rel="stylesheet">
    <title>Sistema</title>
</head>
<body>
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Privilege</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
        // Fetch and display data from $result1
        while ($row = $result1->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['Usuario'] . "</td>";
            echo "<td>" . $privilegio . "</td>";
            
            // Edit button
			echo "<td><a href='editar_user.php?id=" . $row['id'] . "' class='btn btn-primary'>Mod</a></td>";
    
			// Delete button
			echo "<td><a href='eliminar_user.php?id=" . $row['id'] . "' class='btn btn-danger'>Eli</a></td>";
    
            echo "</tr>";
        }
        
        // Close the database connection
        $cnx->close();
        ?>
    </table>
</body>
</html>
