<?php
$ID=$_GET['ID'];
$estatus="NO ACTIVA";

try {
	$conexion = new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql="UPDATE `citas` SET `ESTATUS`=:estatus WHERE ID=:id";
	$consulta=$conexion->prepare($sql);
	$consulta->bindValue(":estatus", $estatus);
	$consulta->bindValue(":id", $ID);
	$consulta->execute();
	
	header("location:inicio_medico.php");

}
catch(Exception $e) {
	echo "ERROR: " . $e->getMessage();
}
?>