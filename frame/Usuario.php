
<!-- index.html -->
<!DOCTYPE html>
<html lang="es">
<head>
		<meta charset="utf-8">
		<title>SISTEMA DE NOTICIAS</title>
		<link rel="stylesheet" href="../css/pstyle.css"> <!-- Enlaza el archivo CSS -->		
		<link rel="stylesheet" href="../css/mstyle.css"> <!-- Enlaza el archivo CSS -->		
	</head>
<body>

	<div id="cabecera">
			<p><iframe frameborder="0" src="encabezado.php" 
			style="border: 0px solid black;" scrolling="no" width="100%" 
			height="100">Tu navegador no permite iframes</iframe></p>
	</div>
	
	<div id="menu">
		<?php include 'menu.php'; ?>
	</div>
	
			
	
	
	<div id="contenido">
		<iframe frameborder="0" src="../usuarios/login.php" 
		style="border: 0px solid black;" scrolling="no" width="100%" 
		height="900">Tu navegador no permite iframes</iframe>
	</div>
	
<div id="lateral2">
		<p><iframe frameborder="0" src="../frame/lateral2.php" 
			style="border: 0px solid black;" scrolling="no" width="100%" 
			height="100">Tu navegador no permite iframes</iframe></p>
	</div>
	
		
	<div id="pie">
		<p><iframe frameborder="0" src="../frame/pie.php" 
			style="border: 0px solid black;" scrolling="no" width="100%" 
			height="200">Tu navegador no permite iframes</iframe></p>
	</div>
</body>
</html>
