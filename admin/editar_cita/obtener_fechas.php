<?php
// Conexión a la base de datos
try {
    $conexion=new PDO("mysql:host=localhost; dbname=usuarios_medicos", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Obtener la fecha disponible del doctor seleccionado (suponiendo que se extrae de la base de datos)
    $doctor = $_GET['doctor'];
    $sql = "SELECT `FECHA MIN` FROM `medicos_disponibles` WHERE `DOCTOR` = :doctor";
    $consulta=$conexion->prepare($sql);
    $consulta->bindValue(":doctor", $doctor);
    $consulta->execute();
    
    $fechaDisponible = $consulta->fetchColumn();
    
    echo $fechaDisponible;
}

catch(Exception $e) {
    echo "Error:" . $e->getMessage();
}
?>