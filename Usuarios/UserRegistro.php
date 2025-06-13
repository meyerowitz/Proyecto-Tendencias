<?php
	session_start();
	require_once '../config/config.php'; // Asegúrate de tener tu archivo de configuración aquí
	// Comprobamos si el usuario está logrado
	if (!isset($_SESSION['usuario'])) 
		{
			// Si no está logrado, redirigimos al usuario a la página de inicio
			header("Location: ../frame/contenido.php");
			exit();
		}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: transparent;
        }
        .container {
			
            max-width: 500px;
            margin-top: 50px;
			margin-left: 150px;
			background-color: #f8f9fa;
			 padding: 30px;
			
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <form action="../Usuarios/UserAgregar.php" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>				
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="privilegio" class="form-label">Privilegio:</label>
                <select class="form-select" aria-label="Select privilege" name="privilegio" required>
                    <option value="">Seleccione un privilegio</option>
                    <?php
                    
                    $sql = "SELECT id, nombre_privilegio FROM Privilegios";
                    $result = $cnx->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"]. "'>" . $row["nombre_privilegio"]. "</option>";
                        }
                    } else {
                        echo "No se encontraron privilegios";
                    }
                    $cnx->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
