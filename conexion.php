<?php

$servidor = "travelqori.com"; // Reemplaza con la dirección del servidor de la base de datos
$usuario = "travelqori_db_admin";
$contrasena = "contraseniadb";
$base_datos = "travelqori_contratos";

// Conexión
$conexion = new mysqli("localhost","root","","travelqori_contratos");
//$conexion = new mysqli($servidor,$usuario, $contrasena, $base_datos);

//Establecer la conexión con la base de datos. 
if ($conexion->connect_error) {
    die("Conexión a la base de datos fallida: " . $conexion->connect_error);
}


?>