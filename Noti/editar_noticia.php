<?php
include_once '../config/config.php';  

// Get the ID of the record to be updated
$record_id = $_GET['id'];

// Query to get the existing record data
$query = "SELECT * FROM noticias WHERE id = '$record_id'";
$resultado = mysqli_query($cnx, $query);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
} else {
    echo "Record not found";
    exit();
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($cnx, $_POST['titulo']);
    $contenido = mysqli_real_escape_string($cnx, $_POST['contenido']);
    $fecha = mysqli_real_escape_string($cnx, $_POST['fecha']);

    // Update query
    $update_query = "UPDATE noticias SET titulo = '$titulo', contenido = '$contenido', fecha = '$fecha' WHERE id = '$record_id'";
    
    if (mysqli_query($cnx, $update_query)) {
        echo "<script>alert('Noticia actualizada con éxito'); window.location.href='../noti/NoticiaListar.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar la noticia');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Modificar Noticia</title>
</head>
<body>
    <div class="container">
        <h1 class="text-primary">Modificar Noticia</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="titulo">Título de la Noticia</label>
                <input id="titulo" class="form-control" type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="contenido">Contenido de la Noticia</label>
                <textarea id="contenido" class="form-control" name="contenido" rows="5" required><?php echo $row['contenido']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de la Noticia</label>
                <input id="fecha" class="form-control" type="date" name="fecha" value="<?php echo date('Y-m-d', strtotime($row['fecha'])); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

    <?php if(isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_GET['error']; ?>
    </div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRAYjquKoyyTYohexKHEyrVSgCFKR9EcLEln3tBGxrW6HTIyd2xhSsKF0K3" crossorigin="anonymous"></script>
</body>
</html>
