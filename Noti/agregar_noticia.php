<?php 
  include_once '../config/config.php';  
  $query = "select * from noticias";
  $resultado = mysqli_query($cnx,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
	<style>
    body {
        background-color: transparent !important;
		
		
    }
</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h1 class="text-primary">Subir Noticia</h1>
				<form action="../Noti/subir_noticia.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="my-input">Seleccione una Imagen</label>
						<input id="my-input"  type="file" name="imagen">
					</div>
					<div class="form-group">
						<label for="my-input">Titulo de la Noticia</label>
						<input id="my-input" class="form-control" type="text" name="titulo">
					</div>
					<div class="form-group">
						<label for="my-input">Contenido de la Noticia</label>						
						<textarea id="noticia" class="form-control" name="contenido" rows="5"></textarea>
					</div>
					<div class="form-group">
						<label for="my-input">Fecha de la Noticia</label>
						<input id="my-input" class="form-control" type="date" name="fecha">
					</div>
					
					<?php if(isset($_SESSION['mensaje'])){ ?>
					<div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
						<strong><?php echo $_SESSION['mensaje']; ?></strong> 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php session_unset(); } ?>
					<input type="submit" value="Guardar" class="btn btn-primary" name="Guardar">
				</form>
			</div>		
		</div>

	</body>
</html>