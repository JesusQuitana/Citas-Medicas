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
	
	<link rel="preload" href="../../src/css/bootstrap.min.css" as="style">
	<link rel="stylesheet" href="../../src/css/bootstrap.min.css">
	
	<link rel="preload" href="../../src/css/interfaz.css" as="style">
	<link rel="stylesheet" href="../../src/css/interfaz.css">
	
	<link rel="preload" href="../../src/css/normalize.css" as="style">
	<link rel="stylesheet" href="../../src/css/normalize.css">
	
	<link rel="preload" href="../../src/css/styles.css" as="style">
	<link rel="stylesheet" href="../../src/css/styles.css">
</head>

<body>

<?php
	session_start();
	if(!isset($_SESSION["usuario"])) {
		header("location:../../index.html");
	}
	
	$especialidad="TRAUMATOLOGIA";
	$doctorDispon=[];
	
	try {
	$conexion=new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="SELECT * FROM `medicos_disponibles` WHERE `ESPECIALIDAD`= :especialidad";
	$consulta=$conexion->prepare($sql);
	$consulta->bindValue(":especialidad", $especialidad);
	
	$consulta->execute();
	
	while($registrosDispon=$consulta->fetch(PDO::FETCH_ASSOC)) {
		$doctorDispon[]=$registrosDispon["DOCTOR"];
		}
	}
	catch(Exception $e) {
		echo "Error:" . $e->getMessage();
	}
	
?>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand "><div style="width: 100%; height: 100%; margin-left: 50px;"><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">Medi</span><span style="color: #85C4FF; font-size: 50px; font-weight: 400; word-wrap: break-word">S</span><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">alud</span></div></a>
		  	<button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav" style="margin-left: auto; margin-right: 100px; display: flex; gap: 25px; align-items: center;">
					<a href="../../cerrar.php" class="cerrar-sesion-inicio">Cerrar Sesion</a>
					<a class="volver-inicio" href="../inicio_usuario.php">Volver</a>
				</div>
		  	</div>
		</div>
	</nav>

	<section class="agendar_bg">
		<div class="contenedor-agendar">
			<form action="../agendar_citas.php" method="post" class="agendar">
				<div class="agendar-img"><img src="../../src/img/doctor4.webp" alt="internista"></div>
				<div class="agendar-info">
					<h2>Traumatologia</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
				<div class="agendar-citas">
					<h3>Fechas Disponibles</h3>
					<div class="agendar-citas-info">
						<label>Dr</label>
						<select name="doctor" id="doctorSelect">
						<option>Seleccione un Doctor</option>
							<?php 
							foreach($doctorDispon as $datos) {
								echo "<option>" . $datos . "</option>";
							};
							?>
						</select>
						<input type="date" name="date" class="agendar-fecha" id="fechaDisponible">
					</div>
				</div>
				<input type="submit" value="Agendar Cita" class="agendar-cita-enviar">
			</form>
		</div>
	</section>
	<script src="../../scriot/script.js"></script>
	<script src="../../script/script1.js"></script>
	<script src="../../script/script2.js"></script>
</body>
</html>