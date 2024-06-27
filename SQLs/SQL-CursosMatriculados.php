<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php";



if (isset($_POST['submitf'])) {

    $find1 = $_POST['find1'];
    $find2 = $_POST['find2'];


    if ((!$find1) && ($find2)) {

        $_SESSION['sql1'] = "SELECT * FROM Cursos_Matriculados WHERE Estado = '$find2'";
        header("location: ../Paginas/AdministrarCursosMatriculados.php");
    }

    if (($find1) && (!$find2)) {


        $_SESSION['sql1'] = "SELECT * FROM Cursos_Matriculados WHERE Id_cursos_matriculados  = '$find1'";
        header("location: ../Paginas/AdministrarCursosMatriculados.php");
    }


    if (($find1) && ($find2)) {
        $_SESSION['sql1'] = "SELECT * FROM Cursos_Matriculados WHERE Estado = '$find2' and Id_cursos_matriculados = '$find1' ";
        header("location: ../Paginas/AdministrarCursosMatriculados.php");
    }

    if ((!$find1) && (!$find2)) {
        header("location: ../Paginas/AdministrarCursosMatriculados.php");
    }

}


if (isset($_POST['submitundo'])){
    $_SESSION['sql1'] = "SELECT * FROM Cursos_Matriculados";
    header("location: ../Paginas/AdministrarCursosMatriculados.php");
}




if (  (isset($_POST['submita'])) || (isset($_POST['submited'])) || (isset($_POST['submite'])) ) {
    $errors = array();

    
    


    if (isset($_POST['submita'])) {

        $accion = "Agregar";


        // Obtener el ID cedula seleccionada en el select

        $Idcedula = trim(explode("-", $_POST['Id_Cedula'])[0]);
        $Idcuatrimestre = trim(explode("-", $_POST['Id_Cuatrimestre'])[0]);
        $Idcurso = trim(explode("-", $_POST['Id_Curso'])[0]);
        $Nota = $_POST['Nota'];
        $Estado = $_POST['Estado'];



    }

    if (isset($_POST['submited'])) {

        $accion = "Editar";


        $Idcursos_matriculados = $_POST['Id_cursos_matriculadose'];
        $Idcedula = trim(explode("-", $_POST['Id_Cedula'])[0]);
        $Idcuatrimestre = trim(explode("-", $_POST['Id_Cuatrimestre'])[0]);
        $Idcurso = trim(explode("-", $_POST['Id_Curso'])[0]);
        $Nota = $_POST['Notae'];
        $Estado = $_POST['Estadoe'];


    }

    if (isset($_POST['submite'])) {

        $accion = "Eliminar";

        $Idcursos_matriculados = $_POST['Id_cursos_matriculadosel'];
        $Idcedula = $_POST['Id_cedulael'];
        $Idcuatrimestre = $_POST['Id_cuatrimestreel'];
        $Idcurso = $_POST['Id_cursoel'];
        $Nota = $_POST['Notael'];
        $Estado = $_POST['Estadoel'];
    }



    $sql = "SELECT * FROM Cursos_Matriculados WHERE Id_cursos_matriculados = '$Idcursos_matriculados'"; //Filtro con correo en la base de datos
    $resultado = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro


   


    //Validacion que la lineas obtenidas sean mayor a 0,lo cual significa que si se encontro una linea con el mismo correo 

    if ($rowCount > 0) {
        array_push($errors, 'Ya existe un registro con la informaci&oacuten igresada');
    }


    if (count($errors) <= 0) {



        if ($accion == 'Agregar') {



            $sql = "INSERT INTO Cursos_Matriculados  (Id_cedula,Id_cuatrimestre,Id_curso,Nota,Estado ) VALUES (?,?,?,?,?) ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {



                mysqli_stmt_bind_param($stmt,"sssss", $Idcedula, $Idcuatrimestre, $Idcurso, $Nota, $Estado);
                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)


            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acci&oacuten realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarCursosMatriculados.php");
            } else {
                if ($stmt->errno == 1062) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
                    header("location: ../Paginas/AdministrarCursosMatriculados.php");

                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarCursosMatriculados.php");

                }
            }

        } // fin agregar





    }  // fin de if(count($errors)>0){
    else {


        if ($accion == 'Agregar'){

            $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
            header("location: ../Paginas/AdministrarCursosMatriculados.php");
        }




        if ($accion == 'Editar') {
          

           

            $sql = " UPDATE `Cursos_Matriculados` SET `Id_cursos_matriculados` = '$Idcursos_matriculados',`Id_cedula` = '$Idcedula',`Id_cuatrimestre` = '$Idcuatrimestre',`Id_curso` = '$Idcurso',`Nota` = '$Nota',`Estado` = '$Estado' WHERE `Cursos_Matriculados`.`Id_cursos_matriculados` = $Idcursos_matriculados";

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
                header("location: ../Paginas/AdministrarCursosMatriculados.php");
            } else {
                if ($stmt->errno == 1062) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
                    header("location: ../Paginas/AdministrarCursosMatriculados.php");

                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarCursosMatriculados.php");

                }
            }

        } else {

            if ($accion == 'Editar') {

                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>"; // Validacion con row 2 que contiene si ha una entrada con la misma informacion
                header("location: ../Paginas/AdministrarCursosMatriculados.php");
            }


        }// Fin Editar


     


        if ($accion == 'Eliminar') {

            
           
         
            $sql = "DELETE FROM Cursos_Matriculados WHERE Id_cursos_matriculados = $Idcursos_matriculados";
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
                header("location: ../Paginas/AdministrarCursosMatriculados.php");


            } else {

                if ($stmt->errno == "1451") {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> No se puede borrar la entrada debido a que tiene relaci&oacuten a otro registro</h1></div>";
                    header("location: ../Paginas/AdministrarCursosMatriculados.php");
                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al ingresar la informaci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarCursosMatriculados.php");

                }
            }








        }/// Fin Eliminar








    } /// fin else 


   


}







