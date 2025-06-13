<?php
// Definir el encabezado
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Encabezado personalizado</title>
	<style>
        
	/* estilo.css */
.container {
    position: relative;
    width: 100%;
    height: 150px; /* Ajusta el alto del contenedor según tus necesidades */
}

.container img {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 80px; /* Ajusta el ancho de la imagen */
    height: auto; /* Mantén el aspecto de la imagen */
}

.container h1 {
    position: absolute;
    top: -5px;
    left: 100px;
}

		
		
    </style>
</head>

<body>

	<div class = "container">
	<img src = "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/LOGO_UNEG.jpg/270px-LOGO_UNEG.jpg">
    
	<h1>Universidad Nacional Experimental De Guayana<br>SERVICIO COMUNITARIO</h1>
	
	</div> 
</body>
</html>
