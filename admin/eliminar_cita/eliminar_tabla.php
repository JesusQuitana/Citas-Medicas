<?php

session_start();
	if(!isset($_SESSION["usuario"])) {
		header("location:../../index.html");
}

/**/
$usuario=$_SESSION["usuario"];
date_default_timezone_set('America/Caracas');
$dateF = date("Y-m-d");
$dateH = date("H:i:s");
$ingreso = "ELIMINAR CITA";
/**/

$id = $_GET['ID'];
$estatus="NO ACTIVA";

try {
	$conexion=new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql="UPDATE `citas` SET ESTATUS='$estatus' WHERE ID = '$id'";
	$consulta=$conexion->prepare($sql);
	$consulta->execute();
	
	if($consulta->rowCount()!=0) {
		$sql_auditoria="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario_audi, :fecha, :hora, :ingreso)";
		$consulta_auditoria=$conexion->prepare($sql_auditoria);
		
		$consulta_auditoria->bindValue(":usuario_audi", $usuario);
		$consulta_auditoria->bindValue(":fecha", $dateF);
		$consulta_auditoria->bindValue(":hora", $dateH);
		$consulta_auditoria->bindValue(":ingreso", $ingreso);
		
		$consulta_auditoria->execute();
		
		header("location:../inicio_admin.php");
	}
}
catch(Exception $e) {
	echo "ERROR: " . $e->getMessage();
}

$conexion=null;


?>