<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$privilegio = '';
include_once '../config/config.php';

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    try {
        $stmt = $cnx->prepare("SELECT p.nombre_privilegio FROM Usuario_Privilegios up JOIN Privilegios p ON up.privilegio_id = p.id WHERE up.usuario_id = (SELECT id FROM Usuarios WHERE Usuario = ?)");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $privilegio = $row["nombre_privilegio"];
                echo "<h3>" . $row["nombre_privilegio"] . "</h3><br>";
            }
        } else {
            echo "No se encontraron privilegios para este usuario.";
        }

        $stmt->close();
        $cnx->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<h1>Invitado</h1>";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar-wrapper">
            <ul class="navbar-nav sidebar collapse d-lg-inline-flex flex-column flex-shrink-0">
                
				 <?php if (!($privilegio == 'Admin' || $privilegio == 'Webmaster' || $privilegio == 'Usuario')): ?>	
					<li class="nav-item active">
						<a class="nav-link" href="../frame/usuario.php">Accesar</a>
					</li>	
							
				
				<?php endif; ?>
				
				
				
						
			
				<li class="develop">
					<a class="nav-link" href="#">Formularios</a>
					<ul class="ul-second">                          
						<li><a href="../documentos/carta de presentacion.docx">Carta de presentacion</a></li>
                        <li><a href="../documentos/ANTEPROYECTO.docx">Anteproyecto</a></li>
						<li><a href="../documentos/propuesta de plan de trabajo.docx">Propuesta de plan de trabajo</a></li>
						<li><a href="../documentos/Registro  de Asesoría Académico.docx">/Registro  de Asesoría Académico</a></li>
						<li><a href="../documentos/REPORTE DE ACTIVIDADES.docx">Reporte de actividades</a></li>
						<li><a href="../documentos/SEGUIMIENTO DEL PLAN DE ACCIÓN.docx">Seguimiento del plan de accion</a></li>
						<li><a href="../documentos/EVALUACIÒN AL  ESTUDIANTE.docx">Evaluacion del estudiante</a></li>
						<li><a href="../documentos/CONSTANCIA DE CULMINACIÓN DEL SERVICIO COMUNITARIO.docx">Constancia de culminacion</a></li>
					</ul>
				</li>     
				
				<li class="develop">
					<a class="nav-link" href="#">Reglamentos y Leyes</a>
					<ul class="ul-second">                          
						<li><a href="../documentos/Ley_del_servicio_comunitario.pdf">Ley del servicio comunitario</a></li>
                        <li><a href="../documentos/reglamento_uneg_2_.pdf">Reglamento UNEG</a></li>
						
					</ul>
				</li>
				
				<li class="develop">
                        <a class="nav-link" href="#">Acerca de</a>
                        <ul class="ul-second">                                                     
							<li><a href="../frame/nosotros1.php">nosotros</a></li>							
                            <li><a href="../frame/nosotros2.php">objetivos</a></li>	
							<li><a href="../frame/nosotros3.php">mision y vision</a></li>								
                        </ul>
                    </li>  
				
					<?php if ($privilegio == 'Webmaster'): ?>
										
					<li class="develop">
                        <a class="nav-link" href="#">Usuarios</a>
                        <ul class="ul-second">                                                     
							<li><a href="../frame/UsuarioRegistro.php">Registrar</a></li>							
                            <li><a href="../frame/UsuarioVer.php">Listar</a></li>							
                        </ul>
                    </li>         
										
					
					
				<?php endif; ?>  
			
				<?php if ($privilegio == 'Admin' || $privilegio == 'Webmaster'): ?>
					<li class="develop">
					    <a class="nav-link" href="#">Noticias</a>
                        <ul class="ul-second">							
                            <li><a href="../frame/noticia.php">Agregar Noticia</a></li> 
							<li><a href="../frame/noticiaver.php">Listar Noticia</a></li> 
                        </ul>
                    </li>
															
					<li class="nav-item active">
						<a class="nav-link" href="../Usuarios/logout.php">Salir</a>
					</li>	        
					
                <?php endif; ?>
				
				<?php if ($privilegio == 'Usuario'): ?>
				
				<li class="nav-item active">
					<a class="nav-link" href="../frame/Chatbot.php">Chatbot</a>
				</li>
																				
					<li class="nav-item active">
						<a class="nav-link" href="../Usuarios/logout.php">Salir</a>
					</li>	   
					
					
                <?php endif; ?>
				
				              
                
            </ul>
        </nav>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Función para mostrar/ocultar el menú lateral
        $('#sidebar-wrapper').on('click', function() {
            $(this).toggleClass('toggled');
        });

        // Función para mostrar/ocultar submenús
        $('.nav-link').on('click', function() {
            $(this).siblings('.submenu').toggle();
        });
    });
</script>
</body>
</html>
