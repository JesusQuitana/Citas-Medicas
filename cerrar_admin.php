<?php

session_start();

$usuario_admin=$_SESSION["usuario_admin"];
date_default_timezone_set('America/Caracas');
$dateF=date("Y-m-d");
$dateH=date("H:i:s");
$accion="CERRAR";

$conexion= new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
$conexion->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*---------------------------------------------------------------------------------------------------------------*/
$sql_admin="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario_admin, :dateF, :dateH, :accion)";
$consulta_auditoria_admin=$conexion->prepare($sql_admin);

$consulta_auditoria_admin->bindValue(":usuario_admin", $usuario_admin);
$consulta_auditoria_admin->bindValue(":dateF", $dateF);
$consulta_auditoria_admin->bindValue(":dateH", $dateH);
$consulta_auditoria_admin->bindValue(":accion", $accion);

$consulta_auditoria_admin->execute();

session_destroy();

header("location:index.html")

?>