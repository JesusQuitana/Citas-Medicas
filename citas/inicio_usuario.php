<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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
	}
?>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand "><div style="width: 100%; height: 100%; margin-left: 50px;"><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">Medi</span><span style="color: #85C4FF; font-size: 50px; font-weight: 400; word-wrap: break-word">S</span><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">alud</span></div></a>
		  	<button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav" style="margin-left: auto; margin-right: 100px; width: 20%;">
					<a href="citas_usuario.php" class="cerrar-sesion-inicio" style="padding-right: 6%">Citas</a>
					<a href="../cerrar.php" class="cerrar-sesion-inicio">Cerrar Sesion</a>
				</div>
		  	</div>
		</div>
	</nav>

	<div class="contenedor-doctor">
		<div class="doctor">
			<div class="doctor-img-1"></div>
			<div class="doctor-info">
				<h2>Medicina Interna</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="ficha_medicos/med-interna.php">Agendar Cita</a>
			</div>
		</div>

		<div class="doctor">
			<div class="doctor-img-2"></div>
			<div class="doctor-info">
				<h2>Traumatologia</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="ficha_medicos/med-traumat.php">Agendar Cita</a>
			</div>
		</div>

		<div class="doctor">
			<div class="doctor-img-3"></div>
			<div class="doctor-info">
				<h2>Cardiologia</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<a href="ficha_medicos/med-cardio.php">Agendar Cita</a>
			</div>
		</div>
	</div>

</body>
</html>