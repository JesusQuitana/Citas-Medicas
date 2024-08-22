<?php
$conexion=mysqli_connect("localhost", "root", "", "usuarios_medicos");

?>

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
    $session_usuario=$_SESSION["usuario"];
?>

	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand "><div style="width: 100%; height: 100%; margin-left: 50px;"><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">Medi</span><span style="color: #85C4FF; font-size: 50px; font-weight: 400; word-wrap: break-word">S</span><span style="color: black; font-size: 50px; font-weight: 400; word-wrap: break-word">alud</span></div></a>
		  	<button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav" style="margin-left: auto; margin-right: 100px; width: 20%;">
					<a href="../citas/inicio_usuario.php" class="cerrar-sesion-inicio" style="padding-right: 6%">Volver</a>
					<a href="../cerrar.php" class="cerrar-sesion-inicio" >Cerrar Sesion</a>
				</div>
		  	</div>
		</div>
	</nav>

    <div class="container" style="display: grid; place-items: center; padding-top: 1%">
    <?php
    $sql= "SELECT * FROM `citas` WHERE USUARIO_AGENDA = '$session_usuario'";
    $result=mysqli_query($conexion,$sql);
    while($mostrar=mysqli_fetch_array($result)){
		echo "
		<section class='citas_user'>
			<p>Fecha</p>
			<p>Especialidad</p>
			<p>Doctor</p>
			<p>Estatus</p>
			<p>Paciente</p>
			
			<p>" . $mostrar['CITAS'] . "</p>
			<p>" . $mostrar['ESPECIALIDAD'] . "</p>
			<p>" . $mostrar['DOCTOR'] . "</p>
			<p>" . $mostrar['ESTATUS'] . "</p>
			<p>" . $mostrar['USUARIO_AGENDA'] . "</p>
		</section>
		";
	}
	?>

    </div>
    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	<script src="../js/script5.js"></script>
</body>
</html>