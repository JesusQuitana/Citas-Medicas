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
                <a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="inicio_admin.php">Volver</a>
					<a class="nav-link-offset-2 link-underline link-underline-opacity-100"  style="margin-left: 3%; font-weight: bold;" href="../cerrar.php">Cerrar Sesion</a>
				</div>
		  	</div>
		</div>
	</nav>

    <div class="container" style="display: grid; place-items: center; padding-top: 1%">
    <?php
    $CI=$_GET['CEDULA'];
    $sql= "SELECT * FROM usuarios WHERE cedula = '$CI'";
    $result=mysqli_query($conexion,$sql);
    while($mostrar=mysqli_fetch_array($result)){
        ?>
                <thead>
                <table class="table table-secondary table-striped">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Telefono</th>
						<th scope="col">Correo</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
			<td><?php echo $mostrar['NOMBRE'] ?></td>
			<td><?php echo $mostrar['USUARIO'] ?></td>
			<td><?php echo $mostrar['CEDULA'] ?>
			<td><?php echo $mostrar['TELEFONO'] ?>
            <td><?php echo $mostrar['CORREO'] ?>
		</tr>
                </tbody>
                <?php 
	}
	 ?>
        </table>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
