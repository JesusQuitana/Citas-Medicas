<?php

session_start();
if(!isset($_SESSION["usuario"])) {
	header("location:../index.html");
}

/**/
$usuario=$_SESSION["usuario"];
date_default_timezone_set('America/Caracas');
$dateF = date("Y-m-d");
$dateH = date("H:i:s");
$ingreso = "EDITAR MEDICO";
/**/

$id= $_POST["id"];
$doctor = $_POST["doctor"];
$especialidad = $_POST["especialidad"];
$fecha_min = $_POST["date-min"];
$fecha_max = $_POST["date-max"];

try {
	$conexion = new PDO("mysql: host=localhost; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql="UPDATE `medicos_disponibles` SET `DOCTOR`=:doctor ,`ESPECIALIDAD`=:especialidad ,`FECHA MIN`=:fecha_min,`FECHA MAX`=:fecha_max WHERE ID =:id";
	$consulta=$conexion->prepare($sql);
	
	$consulta->bindValue(":id", $id);
	$consulta->bindValue(":doctor", $doctor);
	$consulta->bindValue(":especialidad", $especialidad);
	$consulta->bindValue(":fecha_min", $fecha_min);
	$consulta->bindValue(":fecha_max", $fecha_max);
	
	$consulta->execute();
	
	if($consulta->rowCount()!=0) {
		/*-----------------------------------------AUDITORIA DEL SISTEMA---------------------------------------------*/
		$sql_auditoria="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario_audi, :fecha, :hora, :ingreso)";
		$consulta_auditoria=$conexion->prepare($sql_auditoria);
		
		$consulta_auditoria->bindValue(":usuario_audi", $usuario);
		$consulta_auditoria->bindValue(":fecha", $dateF);
		$consulta_auditoria->bindValue(":hora", $dateH);
		$consulta_auditoria->bindValue(":ingreso", $ingreso);
		
		$consulta_auditoria->execute();
		
		header("location:../medicos.php");
		/*-----------------------------------------------------------------------------------------------------------*/
	}
	
	$conexion=null;
}
catch(Exception $e) {
	echo "ERROR: " . $e->getMessage();
}


?>