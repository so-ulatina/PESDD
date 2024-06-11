<?php

$hostNombre="localhost";
$dbUsuario ="root";
$dbPassword ="";
$dbName= "Desarrollo_Docentes";
$conn = new mysqli($hostNombre,$dbUsuario,$dbPassword,$dbName);

if (!$conn){
	die("Error en conexion");
}


?>