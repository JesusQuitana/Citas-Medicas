<?php

include "../variables.php";

$tipo="USUARIO";

try {
	$conexion=new PDO("mysql:host=localhost:3306; dbname=usuarios_medicos", "root", "");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="INSERT INTO `usuarios`(`NOMBRE`, `CEDULA`, `TELEFONO`, `CORREO`, `USUARIO`, `CLAVE`, `TIPO`) VALUES (:nombre, :cedula, :telefono, :email, :usuario, :clave, :tipo)";
	
	$consulta=$conexion->prepare($sql);
	$consulta->bindValue(":nombre", $nombre);
	$consulta->bindValue(":cedula", $cedula);
	$consulta->bindValue(":telefono", $telefono);
	$consulta->bindValue(":email", $email);
	$consulta->bindValue(":usuario", $usuario);
	$consulta->bindValue(":clave", $clave);
	$consulta->bindValue(":tipo", $tipo);
	
	$consulta->execute();
	
	if($registro=$consulta->rowCount()!=0) {
		header("location:../login/usuario/login.html");
	}
}
catch(Exception $e) {
	echo "Error: " . $e->getMessage();
}

$consulta=null;
$conexion=null;




?>