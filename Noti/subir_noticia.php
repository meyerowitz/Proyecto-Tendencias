<?php
include_once '../config/config.php'; 

// Check if the 'imagenes' directory exists, create it if not
$dir_path = 'imagenes/';
if (!is_dir($dir_path)) 
{
    mkdir($dir_path, 0755, true);
}

if(isset($_POST['Guardar']))
{
    $imagen = $_FILES['imagen']['name'];
	$imagen1 = 'imagenes/' . basename($_FILES['imagen']['name']);
    $titulo = $_POST['titulo'];    
    $contenido = $_POST['contenido'];
    $fecha = $_POST['fecha'];

    if(isset($imagen) && $imagen != "")
	{
		$tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

		if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp'))))
		{
			$_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, webp';
			$_SESSION['tipo'] = 'danger';
		}
		else
		{
			$query = "INSERT INTO noticias(imagen,titulo,contenido,fecha) values('$imagen1','$titulo','$contenido','$fecha')";
			$resultado = mysqli_query($cnx,$query);
			if($resultado)
			{
				move_uploaded_file($temp,'imagenes/'.$imagen);   
				$_SESSION['mensaje'] = 'se ha subido correctamente';
				$_SESSION['tipo'] = 'success';
             
			}
			else
			{
				$_SESSION['mensaje'] = 'ocurrio un error en el servidor';
				$_SESSION['tipo'] = 'danger';
			}
		}
    }
}

// Add this line at the end of your script
header("Location: ../Noti/NoticiaListar.php");
exit();
?>
