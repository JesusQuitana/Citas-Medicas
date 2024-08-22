<?php

session_start();

$usuario=$_SESSION["usuario"];
date_default_timezone_set('America/Caracas');
$dateF=date("Y-m-d");
$dateH=date("H:i:s");
$accion="CERRAR";

$conexion= new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
$conexion->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*---------------------------------------------------------------------------------------------------------------*/
$sql="INSERT INTO `auditoria` (USUARIO, FECHA, HORA, ACCION) VALUES (:usuario, :dateF, :dateH, :accion)";
$consulta_auditoria=$conexion->prepare($sql);

$consulta_auditoria->bindValue(":usuario", $usuario);
$consulta_auditoria->bindValue(":dateF", $dateF);
$consulta_auditoria->bindValue(":dateH", $dateH);
$consulta_auditoria->bindValue(":accion", $accion);

$consulta_auditoria->execute();

/*---------------------------------------------------------------------------------------------------------------*/

session_destroy();

header("location:index.html")

?>