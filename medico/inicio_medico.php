<!DOCTYPE html>
<html lang="es">
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
	
	$user=$_SESSION["usuario"];
	$estatus="ACTIVA";
	
	try {
		$conexion=new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql="SELECT * FROM `usuarios` WHERE USUARIO= :user";
		$consulta=$conexion->prepare($sql);
		$consulta->bindValue(":user", $user);
		$consulta->execute();
		
		while ($registros=$consulta->fetch(PDO::FETCH_ASSOC)) {;
		$doctor=$registros["NOMBRE"];
		}
		
		if($consulta->rowCount()!=0) {
			
			$sql_citas="SELECT * FROM `citas` WHERE DOCTOR= :doctor AND ESTATUS=:estatus";
			$consulta_citas=$conexion->prepare($sql_citas);
			$consulta_citas->bindValue(":doctor", $doctor);
			$consulta_citas->bindValue(":estatus", $estatus);
			$consulta_citas->execute();
		}
	}
	catch(Exception $e) {
		echo "ERROR: " . $e->getMessage();
	}
?>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand " href="#"><div style="width: 100%; height: 100%; margin-left: 50px;"><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">Medi</span><span style="color: #85C4FF; font-size: 50px; font-weight: 400; word-wrap: break-word">S</span><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">alud</span></div></a>
		  	<button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav" style="margin-left: auto; width: 100%; justify-content: flex-end; margin-right: 50px;">
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="../cerrar.php">Cerrar Sesion</a>
				</div>
		  	</div>
		</div>
	</nav>
	
	<section>
		<?php
			while($registros_citas=$consulta_citas->fetch(PDO::FETCH_ASSOC)) {
				echo "<div class='citas_medico'>
				<p>Nro de Cita</p>
				<p>Fecha de la Cita</p>
				<p>Especialidad</p>
				<p>Paciente</p>
				<p>Estatus</p>
				<p>" . $registros_citas["ID"] . "</p>
				<p>" . $registros_citas["CITAS"] . "</p>
				<p>" . $registros_citas["ESPECIALIDAD"] . "</p>
				<p>" . $registros_citas["USUARIO_AGENDA"] . "</p>
				<p>" . $registros_citas["ESTATUS"] . "</p>
				<a class='eliminar_cita_medi' href='eliminar_cita_med.php?ID=" . $registros_citas["ID"] . "'>Eliminar</a>
				</div>";
			}
		?>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>