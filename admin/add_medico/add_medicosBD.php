<?php

$cedula_medi=$_POST["nacionalidad_medi"] . $_POST["cedula_medi"];
$telefono_medi=$_POST["cod-area_medi"] . $_POST["telefono_medi"];
$email_medi=$_POST["email_medi"];
$usuario_medi=$_POST["usuario_medi"];
$password_medi=$_POST["password_medi"];

session_start();
if(!isset($_SESSION["usuario"])) {
	header("location:../index.html");
}

/**/
$usuario=$_SESSION["usuario"];
date_default_timezone_set('America/Caracas');
$dateF = date("Y-m-d");
$dateH = date("H:i:s");
$ingreso = "ANADIR MEDICO";
/**/

$doctor = $_POST["doctor"];
$especialidad = $_POST["especialidad"];
$fecha_min = $_POST["date-min"];
$fecha_max = $_POST["date-max"];

$tipo = "MEDICO";

try {
	
	$conexion = new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="INSERT INTO `medicos_disponibles`(`DOCTOR`, `ESPECIALIDAD`, `FECHA MIN`, `FECHA MAX`) VALUES (:doctor, :especialidad, :fecha_min, :fecha_max)";
	
	$consulta=$conexion->prepare($sql);
	
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
		
		/*-----------------------------------------------------------------------------------------------------------*/
		$sql_user_medico="INSERT INTO `usuarios` (CEDULA, NOMBRE, TELEFONO, CORREO, USUARIO, CLAVE, TIPO) VALUES (:cedula_medico, :nombre_medico, :telf_medi, :email_medi, :user_medico, :password_medico, :tipo)";
		$consulta_user_medico=$conexion->prepare($sql_user_medico);
		
		$consulta_user_medico->bindValue(":cedula_medico", $cedula_medi);
		$consulta_user_medico->bindValue(":nombre_medico", $doctor);
		$consulta_user_medico->bindValue(":telf_medi", $telefono_medi);
		$consulta_user_medico->bindValue(":email_medi", $email_medi);
		$consulta_user_medico->bindValue(":user_medico", $usuario_medi);
		$consulta_user_medico->bindValue(":password_medico", $password_medi);
		$consulta_user_medico->bindValue(":tipo", $tipo);
		
		
		$consulta_user_medico->execute();
		
		header("location:../medicos.php");
	}
}
catch(Exepction $e) {
	echo "ERROR: " . $e->getMessage();
}

?>