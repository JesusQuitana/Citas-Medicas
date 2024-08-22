<!DOCTYPE html>
<html lang="es">
<head>
	<title>Admin</title>
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

$conexion=new PDO("mysql: host=localhost; dbname=usuarios_medicos", "root", "");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql_extraerDatos="SELECT * FROM `medicos_disponibles`";

$consulta_extraerDatos=$conexion->prepare($sql_extraerDatos);
$consulta_extraerDatos->execute();

$registros_datos=$consulta_extraerDatos->fetchAll(PDO::FETCH_ASSOC);
$registros_datos_doctor=array_column($registros_datos, "DOCTOR");
$registros_datos_especialidad=array_column($registros_datos, "ESPECIALIDAD");

?>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand "><div style="width: 100%; height: 100%; margin-left: 50px;"><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">Medi</span><span style="color: #85C4FF; font-size: 50px; font-weight: 400; word-wrap: break-word">S</span><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">alud</span></div></a>
		  	<button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav" style="margin-left: auto; width: 100%; justify-content: flex-end; margin-right: 100px;">
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="../inicio_admin.php">Volver</a>
				</div>
		  	</div>
		</div>
	</nav>

<form action="editar_tabla.php" method="post" class="editar_cita_admin">
	<div class="editar_citas_admin-1">
		<label>Nro. de cita</label><select name="id">
		<option><?php echo $_GET['ID'];?></option>
		</select>
		
		<label>Doctor</label><select name="doctor-edit" id="doctorSelect">
		<option>Selecciona un Doctor</option>
		<?php
			forEach($registros_datos_doctor as $datos_doctor) {
				echo "<option>" . $datos_doctor . "</option>";
			}
		?>
		</select>
		
		<label>Especialidad</label>
		<input id="especialidadDisponible" name="especialidad-edit" readonly>
		
		<input type="date" name="date-edit" class="agendar-fecha" id="fechaDisponible">
		<div class="enviar_editar"><input type="submit" value="Editar"></a></div>
	</div>
</form>
	
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	<script src="../../script/script.js"></script>
	<script src="../../script/script1.js"></script>
	<script src="../../script/script2.js"></script>
	<script src="../../script/script3.js"></script>
	</body>
</html>