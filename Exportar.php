<?php
use MongoDB\BSON\Type;


session_start();

require_once "ConexionBaseDatos/Conexion.php"; 

// filter the excel data

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);

    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';


}

// Construir el nombre del archivo que se va a guardar

$fileName = "Reporte Usuarios" . date('Y-m-d') . ".xls";

$fields = array("Id_Usuario", "Nombre_Usuario", "Nombre");

//Desplegar la informacion de la primera fila del excel como titulo

$excelData = implode("\t", array_values($fields)) . "\n";

//Obtener la informacion de la base de datos


if (($_SESSION['sql1'])){

$query = $conn->query( $_SESSION['sql1']);


}else if($_SESSION['sql2']) {

    $query = $conn->query($_SESSION['sql2']);
}




if ($query->num_rows > 0) {

    // imprimir cada row de la base de datos despues del filtro

    while ($row = $query->fetch_assoc()) {

        $lineData = array($row['Id_Usuario'], $row['Nombre_Usuario'], $row['Nombre']);
        $excelData .= implode("\t", array_values($lineData)) . "\n";

    }



} else {
    $excelData .= 'No records found...' . "\n";
}

//creacion del archivo y su formato

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

//creacion del  Excel 

echo $excelData;


