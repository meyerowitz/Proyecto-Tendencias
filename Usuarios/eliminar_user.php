<?php
include_once '../config/config.php';

// Get the ID of the user to delete
$record_id = $_GET['id'];

// Delete related records from Usuario_Privilegios first
$sql_related = "DELETE FROM Usuario_Privilegios WHERE usuario_id = ?";
$stmt_related = mysqli_prepare($cnx, $sql_related);
mysqli_stmt_bind_param($stmt_related, "i", $record_id);
if (mysqli_stmt_execute($stmt_related)) {
    echo "<script>alert('Related records deleted successfully');</script>";
} else {
    echo "<script>alert('Error deleting related records');</script>";
}

// Now delete the user
$sql_delete = "DELETE FROM Usuarios WHERE id = ?";
$stmt_delete = mysqli_prepare($cnx, $sql_delete);
mysqli_stmt_bind_param($stmt_delete, "i", $record_id);

if (mysqli_stmt_execute($stmt_delete)) {
    echo "<script>alert('User deleted successfully'); window.location.href='UserLista.php';</script>";
} else {
    echo "<script>alert('Error deleting user');</script>";
}

// Close statements and connection
mysqli_stmt_close($stmt_delete);
mysqli_close($cnx);
?>
