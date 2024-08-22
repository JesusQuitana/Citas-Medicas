<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale:1.0">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
	
	<link rel="preload" href="../src/css/bootstrap.min.css" as="style">
	<link rel="stylesheet" href="../src/css/bootstrap.min.css">
	
	<link rel="preload" href="../src/css/interfaz.css" as="style">
	<link rel="stylesheet" href="../src/css/interfaz.css">
	
	<link rel="preload" href="../src/css/normalize.css" as="style">
	<link rel="stylesheet" href="../src/css/normalize.css">
	
	<link rel="preload" href="../src/css/styles.css" as="style">
	<link rel="stylesheet" href="../src/css/styles.css">
</head>

<body>

<?php

session_start();
if(!isset($_SESSION["usuario"])) {
	header("location:../index.html");
	return;
}
$especialidad_doctor="";
$fecha_cita=$_POST["date"];
$nombre_doctor=$_POST["doctor"];
$session_usuario=$_SESSION["usuario"];
$estatus="ACTIVA";

$accion="AGENDAR";
date_default_timezone_set('America/Caracas');
$dateF= date("Y-m-d");
$dateH= date("H:i:s");

try {
$conexion= new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
$conexion->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*------------------------------------------------------------------------------------------------------------*/

$sql_consulta_especialidad="SELECT `ESPECIALIDAD` FROM medicos_disponibles WHERE DOCTOR= :nombre_doctor";
$consulta_especialidad=$conexion->prepare($sql_consulta_especialidad);

$consulta_especialidad->bindValue(":nombre_doctor", $nombre_doctor);

$consulta_especialidad->execute();

$especialidad=$consulta_especialidad->fetch(PDO::FETCH_ASSOC);

$especialidad_doctor=$especialidad["ESPECIALIDAD"];

/*----------------------------------------------------------------------------------------------------------*/

$sql_datos="SELECT * FROM usuarios WHERE USUARIO=:usuario";
$consulta_datos=$conexion->prepare($sql_datos);

$consulta_datos->bindValue(":usuario", $session_usuario);

$consulta_datos->execute();

while ($registros=$consulta_datos->fetch(PDO::FETCH_ASSOC)) {
	$registros_nombre=$registros["NOMBRE"];
	$registros_cedula=$registros["CEDULA"];
	$registros_telefono=$registros["TELEFONO"];
	$registros_email=$registros["CORREO"];
}

/*------------------------------------------------------------------------------------------------------------*/

$sql_insertar="INSERT INTO citas (CITAS, ESPECIALIDAD, DOCTOR, USUARIO_AGENDA, ESTATUS, CEDULA) VALUES (:fecha, :especialidad, :nombre_doctor, :usuario_agenda, :estatus, :cedula_pac)";
$consulta_insertar=$conexion->prepare($sql_insertar);

$consulta_insertar->bindValue(":fecha", $fecha_cita);
$consulta_insertar->bindValue(":nombre_doctor", $nombre_doctor);
$consulta_insertar->bindValue(":especialidad", $especialidad_doctor);
$consulta_insertar->bindValue(":usuario_agenda", $session_usuario);
$consulta_insertar->bindValue(":estatus", $estatus);
$consulta_insertar->bindValue(":cedula_pac", $registros_cedula);

$consulta_insertar->execute();

/*------------------------------------------------------------------------------------------------------------*/
$sql_datos_cita="SELECT * FROM citas WHERE CITAS=:cita_fecha";
$consulta_datos_cita=$conexion->prepare($sql_datos_cita);

$consulta_datos_cita->bindValue(":cita_fecha", $fecha_cita);

$consulta_datos_cita->execute();

while ($registros_cita=$consulta_datos_cita->fetch(PDO::FETCH_ASSOC)) {
	$registros_cita_nro=$registros_cita["ID"];
}

/*--------------------------------------------------------------------------------------------------------------*/
$sql_auditoria="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario, :dateF, :dateH, :accion)";
$consulta_auditoria=$conexion->prepare($sql_auditoria);

$consulta_auditoria->bindValue(":usuario", $session_usuario);
$consulta_auditoria->bindValue(":dateF", $dateF);
$consulta_auditoria->bindValue(":dateH", $dateH);
$consulta_auditoria->bindValue(":accion", $accion);

$consulta_auditoria->execute();

echo '

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand " href="#"><div style="width: 100%; height: 100%; margin-left: 50px;"><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">Medi</span><span style="color: #85C4FF; font-size: 50px; font-weight: 400; word-wrap: break-word">S</span><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">alud</span></div></a>
		  	<button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav" style="margin-left: auto; width: 50%; display: flex; gap: 2rem">
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 40%; font-weight: bold;" href="inicio_usuario.php">Volver</a>
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style=" font-weight: bold;" href="../cerrar.php">Cerrar Sesion</a>
				</div>
		  	</div>
		</div>
	</nav>

<section class="contenedor-comprobante">
	<div class="comprobante-doctor">
		<img src="../src/img/doctor3.webp" class="comprobante-img-doctor"/>
		<div class="comprobante-doctor-1">
			<h3 class="comprobante-titulo">Medi<span>S</span>alud</h3>
			<p class="comprobante-nombre-doctor"><span>Dr(a): </span>' . $nombre_doctor . '</p>
			<p class="comprobante-especialidad-doctor"><span>Especialidad: </span>' . $especialidad_doctor . '</p>
			<p class="comprobante-nro-recibo"><span>Nro de Recibo: </span>' . $registros_cita_nro . '</p>
		</div>
	</div>
	<div class="comprobante-paciente">
		<div class="comprobante-paciente-1">
			<p><span>Nombre del Paciente: </span>' . $registros_nombre . '</p>
			<p><span>Fecha de la Cita:</span> '. $fecha_cita . '</p>
		</div>
		<div class="comprobante-paciente-2">
			<p><span>Cedula: </span>' . $registros_cedula . '</p>
			<p><span>Telefono: </span>' . $registros_telefono . '</p>
			<p><span>Correo: </span>' . $registros_email . '</p>
		</div>
		<img src="../src/img/paciente.webp" class="comprobante-img-paciente"/>
	</div>
</section>
';


}
catch(Exception $e) {
	echo "Error:" . $e->getMessage();
}

$consulta_datos_cita=null;
$consulta_datos=null;
$consulta_insertar=null;
$conexion=null;
?>

</body>
</html>