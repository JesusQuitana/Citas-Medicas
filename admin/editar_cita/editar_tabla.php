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
$ingreso = "EDITAR CITA";
/**/

$id= $_POST["id"];
$doctor = $_POST["doctor-edit"];
$especialidad = $_POST["especialidad-edit"];
$cita = $_POST["date-edit"];

try {
	$conexion=new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="UPDATE `citas` SET `CITAS`=:cita,`ESPECIALIDAD`=:especialidad,`DOCTOR`=:doctor WHERE ID =:id";
	
	$actualizar = $conexion->prepare($sql);
	$actualizar->bindValue(":id", $id);
	$actualizar->bindValue(":cita", $cita);
	$actualizar->bindValue(":especialidad", $especialidad);
	$actualizar->bindValue(":doctor", $doctor);
	
	$actualizar->execute();
	
	if($registros=$actualizar->rowCount()!=0) {
		/*--------------------------------------------------------------------------------------------------------------------*/
		$sql_auditoria="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario_audi, :fecha, :hora, :ingreso)";
		$consulta_auditoria=$conexion->prepare($sql_auditoria);
		
		$consulta_auditoria->bindValue(":usuario_audi", $usuario);
		$consulta_auditoria->bindValue(":fecha", $dateF);
		$consulta_auditoria->bindValue(":hora", $dateH);
		$consulta_auditoria->bindValue(":ingreso", $ingreso);
		
		$consulta_auditoria->execute();
		/*--------------------------------------------------------------------------------------------------------------------*/
		header("location:../inicio_admin.php");
		
	}
	else {
		echo "ERROR: NO SE ENCONTRO REGISTRO A MODIFICAR";
	}
}
catch(Exception $e) {
	"ERROR: " . $e->getMessage();
}


?>