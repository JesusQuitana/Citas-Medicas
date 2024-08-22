<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
	<link rel="stylesheet" href="../src/css/interfaz.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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
				<div class="navbar-nav" style="margin-left: auto; width: 100%; justify-content: flex-end; margin-right: 100px;">
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="../medicos.php">Volver</a>
				</div>
		  	</div>
		</div>
	</nav>

<form action="add_medicosBD.php" method="post" class="add_medico_admin">
		<h3 class="titulo">Datos del Medico</h3>
	<div class="add_medico_admin-1">
		<label>Nombre del Medico</label><input type="text" name="doctor" placeholder="Nombre del médico"/>
		<label>Especialidad</label><select name="especialidad" class="espec">
		<option>Seleccione una Especialidad</option>
		<option>MEDICINA INTERNA</option>
		<option>TRAUMATOLOGIA</option>
		<option>CARDIOLOGIA</option>
		</select>
		<label class="desde_add">Desde</label><input type="date" class="agendar-fecha desde_add-1" name="date-min" placeholder="Fecha minima"/>
		<label class="hasta_add">Hasta</label><input type="date" class="agendar-fecha hasta_add-1" name="date-max" placeholder="Fecha máxima"/>
	</div>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
		<h3 class="titulo">Usuario del Medico</h3>
	<div class="add_medico_admin-2">
		<label>Cedula</label><div class="editar_med_admin-1"><select name="nacionalidad_medi">
		<option>V</option>
		<option>E</option>
		</select><input type="text" placeholder="Cedula" name="cedula_medi"/></div>
		<label>Telefono</label><div class="editar_med_admin-1"><select name="cod-area_medi">
		<option>0412</option>
		<option>0414</option>
		<option>0424</option>
		<option>0212</option>
		</select><label>-</label><input type="tel" placeholder="Telefono" name="telefono_medi"/></div>
		<label>Correo</label><input type="email" name="email_medi"/>
		<label>Usuario</label><input type="text" name="usuario_medi"/>
		<label>Password</label><input type="password" name="password_medi"/>
	</div>
	
	<div class="add_medico_enviar"><input type="submit" value="Registrar"></div>
</form>
	
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../../script/script.js"></script>
    <script src="../../script/script1.js"></script>
	<script src="../../script/script2.js"></script>
	<script src="../../script/script3.js"></script>
</body>