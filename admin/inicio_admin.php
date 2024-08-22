<?php
$conexion=mysqli_connect("localhost", "root", "", "usuarios_medicos");
?>
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
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="medicos.php">Medicos</a>
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="usuarios.php">Usuarios</a>
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="../cerrar.php">Cerrar Sesion</a>
				</div>
		  	</div>
		</div>
	</nav>

    <section class="contenedor_admin">
    <?php
	$estatus="ACTIVA";
	
    $sql= "SELECT * FROM  citas WHERE ESTATUS='$estatus'";
    $result=mysqli_query($conexion,$sql);
    while($mostrar=mysqli_fetch_array($result)){
		
		if($_SESSION["usuario"]=="admin") {
			echo "<thead>
			<div class='citas_admin'>
				<div class='citas_admin_encabe'>
				<p>Fecha</p>
				<p>Especialidad</p>
				<p>Doctor</p>
				<p>Paciente</p>
				</div>

				<div class='citas_admin_datos'>
					<p>" . $mostrar['CITAS'] . "</p>
					<p>" . $mostrar['ESPECIALIDAD'] . "</p>
					<p>" . $mostrar['DOCTOR'] . "</td>
					<p>" . $mostrar['USUARIO_AGENDA'] . "</p>
					<div class='citas_admin_btn'>
						<a class='citas_admin_btn-1' href='eliminar_cita/eliminar_tabla.php?ID=" . $mostrar['ID'] . "'>Eliminar</a>
						<a class='citas_admin_btn-2' href='editar_cita/editar.php?ID=" . $mostrar['ID'] ."'>Editar</a>
						<a class='citas_admin_btn-3' href='consulta_cita.php?CEDULA=" . 
						$mostrar['CEDULA'] . "'>Ver</a>
					</div>
				</div>
			</div>";
		}
		else {
			header("location: ../medico/inicio_medico.php");
		}
	}
	?>
    </section>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
