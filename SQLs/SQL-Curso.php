<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php";



if (isset($_POST['submitf'])) {

    $find1 = $_POST['find1'];
    $find2 = $_POST['find2'];


    if ((!$find1) && ($find2)) {

        $_SESSION['sql1'] = "SELECT * FROM Curso WHERE Estado = '$find2%'";
        header("location: ../Paginas/AdministrarCurso.php");
    }

    if (($find1) && (!$find2)) {


        $_SESSION['sql1'] = "SELECT * FROM Curso WHERE Nombre LIKE '%$find1%'";
        header("location: ../Paginas/AdministrarCurso.php");
    }


    if (($find1) && ($find2)) {
        $_SESSION['sql1'] = "SELECT * FROM Curso WHERE Estado = '$find2' and Nombre LIKE '%$find1%' ";
        header("location: ../Paginas/AdministrarCurso.php");
    }

    if ((!$find1) && (!$find2)) {
        header("location: ../Paginas/AdministrarCurso.php");
    }

}    


if (isset($_POST['submitundo'])){
    $_SESSION['sql1'] = "SELECT * FROM Curso";
    header("location: ../Paginas/AdministrarCurso.php");
}




if (  (isset($_POST['submita'])) || (isset($_POST['submited'])) || (isset($_POST['submite'])) ) {
    $errors = array();

    
    


    if (isset($_POST['submita'])) {

        $accion = "Agregar";

        $IdCurso = $_POST['Id_Curso'];
        $Nombre = $_POST['Nombre'];
        $Horas = $_POST['Horas'];
        $IdCategoria = trim(explode("-", $_POST['Id_Categoria'])[0]);
        $IdModalidad = trim(explode("-", $_POST['Id_Modalidad'])[0]);
        $Idcertificado = trim(explode("-", $_POST['Id_certificado'])[0]);
        $Idadministrador = trim(explode("-", $_POST['Id_administrador'])[0]);
        $Estado = $_POST['Estado'];

    }

    if (isset($_POST['submited'])) {

        $accion = "Editar";


        $IdCurso = $_POST['Id_Cursoe'];
        $Nombre = $_POST['Nombree'];
        $Horas = $_POST['Horase'];
        $IdCategoria = trim(explode("-", $_POST['Id_Categoriae'])[0]);
        $IdModalidad = trim(explode("-", $_POST['Id_Modalidade'])[0]);
        $Idcertificado = trim(explode("-", $_POST['Id_certificadoe'])[0]);
        $Idadministrador = trim(explode("-", $_POST['Id_administradore'])[0]);

        $Estado = $_POST['Estadoe'];

    }

    if (isset($_POST['submite'])) {

        $accion = "Eliminar";

        $IdCurso = $_POST['Id_Cursoel'];
        $Nombre = $_POST['Nombreel'];
        $Horas = $_POST['Horasel'];
        $IdCategoria = $_POST['Id_Categoriael'];
        $IdModalidad = $_POST['Id_Modalidadel'];
        $Idcertificado = $_POST['Id_certificadoel'];
        $Idadministrador = $_POST['Id_administradorel'];
        $Estado = $_POST['Estadoel'];
    }



    if (($accion == "Eliminar") || ($accion == "Editar")) {
    
    $sql = "SELECT * FROM Curso WHERE Id_Curso = '$IdCurso'"; //Filtro con correo en la base de datos
    $resultado = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro


    } else {

    $sql = "SELECT * FROM Curso WHERE Nombre = '$Nombre'"; //Filtro con correo en la base de datos
    $resultado = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro

    }


    //Validacion que la lineas obtenidas sean mayor a 0,lo cual significa que si se encontro una linea con el mismo correo 

    if ($rowCount > 0) {
        array_push($errors, 'Ya existe un registro con la informaci&oacuten igresada');
    }


    if (count($errors) <= 0) {



        if ($accion == 'Agregar') {



            $sql = "INSERT INTO Curso  (Id_Curso,Nombre,Horas,Id_Modalidad,Id_certificado,Id_administrador,Id_Categoria,Estado) VALUES (?,?,?,?,?,?,?,?) ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {



                mysqli_stmt_bind_param($stmt,"ssssssss",$IdCurso, $Nombre,$Horas, $IdModalidad, $Idcertificado, $Idadministrador, $IdCategoria, $Estado);
                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)



            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acci&oacuten realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarCurso.php");
            } else {
                if ($stmt->errno == 1062) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
                    header("location: ../Paginas/AdministrarCurso.php");

                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarCurso.php");

                }
            }

        } // fin agregar





    }  // fin de if(count($errors)>0){
    else {


        if ($accion == 'Agregar'){

            $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
            header("location: ../Paginas/AdministrarCurso.php");
        }




        if ($accion == 'Editar') {
          
            $sql = " UPDATE `Curso` SET `Id_Curso` = '$IdCurso',`Nombre` = '$Nombre',`Horas` = '$Horas',`Id_Categoria` = '$IdCategoria',`Id_Modalidad` = '$IdModalidad',`Id_certificado` = '$Idcertificado',`Id_administrador` = '$Idadministrador',`Estado` = '$Estado' WHERE `Curso`.`Id_Curso` = $IdCurso";

            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {

                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)

                echo mysqli_error($conn);
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)




            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acci&oacuten realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarCurso.php");
            } else {
                if ($stmt->errno == 1062) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
                    header("location: ../Paginas/AdministrarCurso.php");

                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarCurso.php");

                }
            }

        } else {

            if ($accion == 'Editar') {

                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>"; // Validacion con row 2 que contiene si ha una entrada con la misma informacion
                header("location: ../Paginas/AdministrarCurso.php");
            }


        }// Fin Editar





        if ($accion == 'Eliminar') {


            //Validacion si hay dependencia 

            $sql1 = "SELECT * FROM Cursos_Matriculados WHERE Id_Curso= '$IdCurso'"; //Filtro con correo en la base de datos
            $resultado = mysqli_query($conn, $sql1);
            $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro


            if ($rowCount > 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> No se puede borrar la entrada debido a que tiene relaci&oacuten a otro registro</h1></div>";
                header("location: ../Paginas/AdministrarCurso.php");
            } else {



                $sql = "DELETE FROM Curso WHERE Id_Curso = $IdCurso";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                if ($prepareStmt) {

                    mysqli_stmt_execute($stmt);

                } // fin de if ($prepareStmt) 
                else { // else de if ($prepareStmt)

                    echo mysqli_error($conn);
                    die('Algo salio mal');

                } //fin else de if ($prepareStmt)


                if ($stmt->errno == 0) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Informaci&oacuten Eliminada stisfactoriamente</h1></div>";
                    header("location: ../Paginas/AdministrarCurso.php");
                }




            }



        }/// Fin Eliminar








    } /// fin else 


   


}







