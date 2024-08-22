<?php

include "../../variables.php";
$usuario=$_POST["usuario"];

date_default_timezone_set('America/Caracas');
$dateF = date("Y-m-d");
$dateH = date("H:i:s");
$ingreso = "INGRESO";

try {
	$conexion=new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
	
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="SELECT * FROM medicos WHERE USUARIO= :usuario AND CLAVE= :clave";
	
	$consulta=$conexion->prepare($sql);
	
	$consulta->bindValue(":usuario", $usuario);
	$consulta->bindValue(":clave", $clave);
	
	$consulta->execute();
	
	if($registros=$consulta->rowCount()!=0) {
		session_start();
		$_SESSION["usuario"]=$_POST["usuario"];
		
		/*-----------------------------------------AUDITORIA DEL SISTEMA---------------------------------------------*/
		$sql_auditoria="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario_audi, :fecha, :hora, :ingreso)";
		$consulta_auditoria=$conexion->prepare($sql_auditoria);
		
		$consulta_auditoria->bindValue(":usuario_audi", $usuario);
		$consulta_auditoria->bindValue(":fecha", $dateF);
		$consulta_auditoria->bindValue(":hora", $dateH);
		$consulta_auditoria->bindValue(":ingreso", $ingreso);
		
		$consulta_auditoria->execute();
		/*-----------------------------------------------------------------------------------------------------------*/
		
		header("location:../../admin/inicio_medico.php");
	}
	else {
		header("location:login_admin.html");
	}
}
catch(Exception $e) {
	echo "Error: " . $e->getMessage();
}

$consulta_auditoria=null;
$consulta=null;
$conexion=null;

?>