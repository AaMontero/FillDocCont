<?php

$conexion = mysqli_connect("localhost","root","","contratosdb");
//Establecer la conexión con la base de datos. 
if ($conexion->connect_error) {
    die("Conexión a la base de datos fallida: " . $conexion->connect_error);
}
?>