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

$fileName = "Reporte_".$_SESSION["Categoria"]."_". date('Y-m-d') . ".xls";

// Titulos primer linea del Excel


switch  ($_SESSION["Categoria"]) {

    case "Modalidad":
    case "Facultad":
    case "Administrador":
    case "Certificado":
    case "Sede":
    case "Nivel Acad&eacutemico":
        $fields = array("Id", "Nombre", "Estado");
        break;
    Case "Carrera":
        $fields = array("Id Carrera","Nombre", "Id Facultad", "Id sede", "Estado");
        break;
    Case "Categoria":
        $fields = array("Id Categoria","Nombre", "Horas duracion desde", "Horas duracion hasta", "Estado");
        break;
    Case "Cuatrimestre":
        $fields = array("Id Cuatrimestre","Periodo","Año","Estado");
        break;
    case "Curso":
        $fields = array("Id Curso", "Nombre","Horas", "Id Modalidad", "Id certificado", "Id administrador","Id Categoría", "Estado");
        break;
    case "Cursos Matriculados":
        $fields = array("Id Curso Matriculado","Id cedula", "Id cuatrimestre", "Id curso", "Nota", "Estado");
        break;
    case "Docente":
        $fields = array("Id cedula", "Id Docente", "Id carrera", "Nombre", "Apellido1", "Apellido2", "Id_Nivel Académico", "Correo", "Celular", "Fecha Nacimiento", "Estado");
        break;
    case "Usuarios":
        $fields = array("Id Usuario","Nombre Usuario", "Nombre", "Apellido1", "Apellido2", "Correo", "Rol", "Estado");
        break;
    case "Cursos Matriculados por Docente":
        $fields = array("Facultad", "Carrera", "Docente", "Cedula", "Correo", "Sede", "Periodo", "Año", "Curso", "Modalidad", "Certificado", "Nota", "Estado");
        break;
    default :
        $fields = "Ocurrio un error";
        break;
}



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

    while ($row = $query->fetch_row()) {

        switch ($_SESSION["Categoria"]) {

            case "Modalidad":
            case "Facultad":
            case "Administrador":
            case "Certificado":
            case "Sede":
            case "Nivel Acad&eacutemico":
                $lineData = array($row[0], $row[1], $row[2]);
                break;
            case "Carrera":
            case "Categoria":
                $lineData = array($row[0], $row[1], $row[2], $row[3], $row[4]);
                break;
            case "Cursos Matriculados":
                $lineData = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                break;
            case "Cuatrimestre":
                $lineData = array($row[0], $row[1], $row[2], $row[3]);
                break;
            case "Curso":
                $lineData = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
                break;
            case "Docente":
                $lineData = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]);
                break;
            case "Usuarios":
                $lineData = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[6], $row[7], $row[8]);
                break;
            case "Cursos Matriculados por Docente":
                $Docente = $row[2];
                $Docente .= " ";
                $Docente .= $row[3];
                $Docente .= " ";
                $Docente .= $row[4];

                $lineData = array($row[0], $row[1], $Docente ,$row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14]);
                break;
            default:
                $lineData = "No se encontraron datos";
              
        }


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


