<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php";



if (isset($_POST['submitf'])) {

    $findFacultad = $_POST['findFacultad'];
    $findCarrera = $_POST['findCarrera'];
    $findDocente = $_POST['findDocente'];
    $findCedula = $_POST['findCedula'];
    $findCorreo = $_POST['findCorreo'];
    $findSede = $_POST['findSede'];
    $findPeriodo = $_POST['findPeriodo'];
    $findAno = $_POST['findAno'];
    $findCurso = $_POST['findCurso'];
    $findModalidad = $_POST['findModalidad'];
    $findCertificado = $_POST['findCertificado'];
    $findEstado = $_POST['findEstado'];
    $sqlfind1 = "SELECT fac.Nombre , ca.Nombre , doc.Nombre,doc.Apellido1,doc.Apellido2, doc.Id_cedula,doc.Correo,sed.Nombre ,cua.Periodo ,cua.Ano , cu.Nombre , modal.Descripcion,cert.Nombre , cm.Nota , cm.Estado,cu.Id_Curso,cua.ano,cu.Horas  FROM 
                       cursos_matriculados as cm INNER JOIN curso as cu ON cm.Id_curso  = cu.Id_Curso 
            INNER JOIN docente as doc ON cm.Id_cedula = doc.Id_cedula 
            INNER JOIN cuatrimestre as cua ON cm.Id_cuatrimestre = cua.Id_Cuatrimestre 
            INNER JOIN carrera as ca ON doc.Id_carrera = ca.Id_carrera
            INNER JOIN sede as sed on sed.Id_sede = ca.Id_sede
            INNER JOIN facultad as fac on fac.Id_Facultad =ca.Id_Facultad
            INNER JOIN modalidad as modal on modal.Id_modalidad = cu.Id_Modalidad
            INNER JOIN certificado as cert on cert.Id_certificado = cu.Id_certificado WHERE ";
    $sqlfind;

    if ($findFacultad) {

        if (!$sqlfind) {
            $sqlfind = " fac.Nombre  LIKE '%$findFacultad%'";
        } else {
            $sqlfind .= " and fac.Nombre  LIKE '%$findFacultad%'";
        }

    }

    if ($findCarrera) {

        if (!$sqlfind) {
            $sqlfind = " ca.Nombre  LIKE '%$findCarrera%'";
        } else {
            $sqlfind .= " and ca.Nombre  LIKE '%$findCarrera%'";
        }

    }

    if ($findDocente) {

        if (!$sqlfind) {
            $sqlfind = " doc.Nombre  LIKE '%$findDocente%'";
        } else {
            $sqlfind .=" and doc.Nombre  LIKE '%$findDocente%'";
        }

    }

    if ($findCedula) {

        if (!$sqlfind) {
            $sqlfind = " doc.Id_cedula  LIKE '%$findCedula%'";
        } else {
            $sqlfind .=  " and doc.Id_cedula  LIKE '%$findCedula%'";
        }

    }

    if ($findCorreo) {

        if (!$sqlfind) {
            $sqlfind = " doc.Correo  LIKE '%$findCorreo%'";
        } else {
            $sqlfind .=  " and doc.Correo  LIKE '%$findCorreo%'";
        }

    }


    if ($findSede) {

        if (!$sqlfind) {
            $sqlfind = " sed.Nombre  LIKE '%$findSede%'";
        } else {
            $sqlfind .=  " and sed.Nombre  LIKE '%$findSede%'";
        }

    }

    if ($findPeriodo) {

        if (!$sqlfind) {
            $sqlfind = " cua.Periodo  LIKE '%$findPeriodo%'";
        } else {
            $sqlfind .=  " and cua.Periodo  LIKE '%$findPeriodo%'";
        }

    }

    if ($findAno) {

        if (!$sqlfind) {
            $sqlfind = " cua.Ano  LIKE '%$findAno%'";
        } else {
            $sqlfind .=  " and cua.Ano  LIKE '%$findAno%'";
        }

    }

    if ($findCurso) {

        if (!$sqlfind) {
            $sqlfind = " cu.Nombre  LIKE '%$findCurso%'";
        } else {
            $sqlfind .=  " and cu.Nombre  LIKE '%$findCurso%'";
        }

    }

    if ($findModalidad) {

        if (!$sqlfind) {
            $sqlfind = " modal.Descripcion  LIKE '%$findModalidad%'";
        } else {
            $sqlfind .=  " and modal.Descripcion  LIKE '%$findModalidad%'";
        }

    }


    if ($findCertificado) {

        if (!$sqlfind) {
            $sqlfind = " cert.Nombre  LIKE '%$findCertificado%'";
        } else {
            $sqlfind .=  " and cert.Nombre  LIKE '%$findCertificado%'";
        }

    }

    if ($findEstado) {

        if (!$sqlfind) {
            $sqlfind = " cm.Estado  LIKE '%$findEstado%'";
        } else {
            $sqlfind .= " and cm.Estado  LIKE '%$findEstado%'";
        }

    }

    $sqlfind1 .= $sqlfind;

    $_SESSION['sql1'] = $sqlfind1;
    header("location: ../Reportes/Reporte-CursosMatriculadosDocentes.php");

}



if (isset($_POST['submitundo'])) {
    $_SESSION['sql1'] = "SELECT fac.Nombre , ca.Nombre , doc.Nombre,doc.Apellido1,doc.Apellido2, doc.Id_cedula,doc.Correo,sed.Nombre ,cua.Periodo ,cua.Ano , cu.Nombre , modal.Descripcion,cert.Nombre , cm.Nota , cm.Estado,cu.Id_Curso,cua.ano FROM 
                       cursos_matriculados as cm INNER JOIN curso as cu ON cm.Id_curso  = cu.Id_Curso 
            INNER JOIN docente as doc ON cm.Id_cedula = doc.Id_cedula 
            INNER JOIN cuatrimestre as cua ON cm.Id_cuatrimestre = cua.Id_Cuatrimestre 
            INNER JOIN carrera as ca ON doc.Id_carrera = ca.Id_carrera
            INNER JOIN sede as sed on sed.Id_sede = ca.Id_sede
            INNER JOIN facultad as fac on fac.Id_Facultad =ca.Id_Facultad
            INNER JOIN modalidad as modal on modal.Id_modalidad = cu.Id_Modalidad
            INNER JOIN certificado as cert on cert.Id_certificado = cu.Id_certificado;";
    header("location: ../Reportes/Reporte-CursosMatriculadosDocentes.php");
}