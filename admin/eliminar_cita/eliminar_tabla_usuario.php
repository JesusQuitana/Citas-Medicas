<?php
$conexion=mysqli_connect("localhost", "root", "", "usuarios_medicos");
$id = $_GET['ID'];
$eliminar="DELETE FROM usuarios WHERE ID = '$id'";
$elimina = $conexion->query($eliminar);
header("location:usuarios.php");
$conexion->close();


?>