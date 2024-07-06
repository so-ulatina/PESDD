<?php

$hostNombre="localhost";
$dbUsuario ="Admin_Desarrollo_Docente";
$dbPassword ="Desarrollo_2024";
$dbName= "desarrollo_docentes";
$conn = new mysqli($hostNombre,$dbUsuario,$dbPassword,$dbName);

if (!$conn){
	die("Error en conexion");
}


?>
