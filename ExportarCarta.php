<?php
use MongoDB\BSON\Type;


session_start();

require_once "ConexionBaseDatos/Conexion.php";

// filter the excel data

$lineData = "";
$excelData = "";
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);

    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';


}

// Construir el nombre del archivo que se va a guardar

$fileName = "Plantilla_" . $_SESSION["Categoria"] . "_" . date('Y-m-d') . ".xls";


//Obtener la informacion de la base de datos


if (($_SESSION['sql1'])) {

    $query = $conn->query($_SESSION['sql1']);


} else if ($_SESSION['sql2']) {

    $query = $conn->query($_SESSION['sql2']);
}




if ($query->num_rows > 0) {

    // imprimir cada row de la base de datos despues del filtro

    while ($row = $query->fetch_row()) {

        if (!$lineData){
            $Docente = $row[2] . " " . $row[3] . " " . $row[4];
            
            $lineData = array("Hace contar que " . $Docente . " cédula " . $row[5] . " de la carrera(s) " . $row[1] . ", facultad " . $row[0] . " se ha capacitado en los siguientes cursos:" . "\n");

            $excelData .= implode("\t", array_values($lineData)) . "\n";

            $lineData = array("Certificado", "Periodo", "Año", "Codigo Curso", "Curso", "Modalidad", "Nota", "Cantidad Horas");

            $excelData .= implode("\t", array_values($lineData)) . "\n";


            $lineData = array($row[12], $row[8], $row[16], $row[15], $row[10], $row[11], $row[13] , $row[17]);
            $excelData .= implode("\t", array_values($lineData)) . "\n";

        }else {
            $lineData = array($row[12], $row[8], $row[16], $row[15], $row[10], $row[11], $row[13], $row[17]);
            $excelData .= implode("\t", array_values($lineData)) . "\n";
        }

        
        
        

    }



} else {
    $excelData .= 'No records found...' . "\n";
}

//creacion del archivo y su formato

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

//creacion del  Excel 

echo $excelData;


