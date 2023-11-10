<?php

$servidor = "travelqori.com"; // Reemplaza con la dirección del servidor de la base de datos
//$usuario = "travelqori_db_admin";
$contrasena = "contraseniadb";
$base_datos = "travelqori_contratos";

// Conexión
$conexion = mysqli_connect($servidor,"travelqori_db_admin", $contrasena, $base_datos);
//$conexion = mysqli_connect("localhost","root","","contratosdb");

//Establecer la conexión con la base de datos. 
if ($conexion->connect_error) {
    die("Conexión a la base de datos fallida: " . $conexion->connect_error);
}


?>