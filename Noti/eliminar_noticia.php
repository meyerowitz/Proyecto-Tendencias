<?php
include_once '../config/config.php';

// Obtener el ID de la noticia a eliminar
$record_id = $_GET['id'];

// Preparar la consulta SQL
$sql = "DELETE FROM noticias WHERE id = ?";

// Preparar la declaración de consulta
$stmt = mysqli_prepare($cnx, $sql);

// Enlazar los parámetros con la declaración preparada
mysqli_stmt_bind_param($stmt, "i", $record_id);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Noticia eliminada con éxito'); window.location.href='../noti/NoticiaListar.php';</script>";
} else {
    echo "<script>alert('Error al eliminar la noticia');</script>";
}

// Liberar la declaración y cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($cnx);
?>
