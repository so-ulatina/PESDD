<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php"; 



if (isset($_POST['submitf'])){

    $find1 = $_POST['find1'];
   


    if($find1){

        $_SESSION['sql1'] = "SELECT * FROM Docente  WHERE Nombre LIKE '%$find1%'";
        header("location: ../Paginas/AdministrarDocente.php");
    }

   

}     


if (isset($_POST['submitundo'])){
    $_SESSION['sql1'] = "SELECT * FROM Docente";
    header("location: ../Paginas/AdministrarDocente.php");
}




if (  (isset($_POST['submita'])) || (isset($_POST['submited'])) || (isset($_POST['submite'])) ) {
    $errors = array();

    
    


    if (isset($_POST['submita'])) {

        $accion = "Agregar";

       $Id_cedula = $_POST['Id_cedula'];
       $Id_Docente = $_POST['Id_Docente'];
        $Id_carrera = trim(explode("-", $_POST['Id_Carrera'])[0]);
       
        $Nombre = $_POST['Nombre'];
        $Apellido1 = $_POST['Apellido1'];
        $Apellido2 = $_POST['Apellido2'];
        $Nivel_Academico = $_POST['Nivel_Academico'];
        $Correo= $_POST['Correo'];
        $Celular = $_POST['Celular'];
        $Fecha_Nacimiento = $_POST['Fecha_Nacimiento'];



    }

    if (isset($_POST['submited'])) {

        $accion = "Editar";

        $Id_cedula = $_POST['Id_cedulae'];
        $Id_Docente = $_POST['Id_Docentee'];
        $Id_carrera = trim(explode("-", $_POST['Id_Carrerae'])[0]);
        $Nombre = $_POST['Nombree'];
        $Apellido1 = $_POST['Apellido1e'];
        $Apellido2 = $_POST['Apellido2e'];
        $Nivel_Academico = $_POST['Nivel_Academicoe'];
        $Correo = $_POST['Correoe'];
        $Celular = $_POST['Celulare'];
        $Fecha_Nacimiento = $_POST['Fecha_Nacimientoe'];


    }

    if (isset($_POST['submite'])) {

        $accion = "Eliminar";

        $Id_cedula = $_POST['Id_cedulael'];
        $Id_Docente = $_POST['Id_Docenteel'];
        $Id_carrera = $_POST['Id_carrerael'];
        $Nombre = $_POST['Nombreel'];
        $Apellido1 = $_POST['Apellido1el'];
        $Apellido2 = $_POST['Apellido2el'];
        $Nivel_Academico = $_POST['Nivel_Academicoel'];
        $Correo = $_POST['Correoel'];
        $Celular = $_POST['Celularel'];
        $Fecha_Nacimiento = $_POST['Fecha_Nacimientoel'];


    }



    $sql = "SELECT * FROM Docente WHERE Id_cedula = '$Id_cedula'"; //Filtro con correo en la base de datos
    $resultado = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro


    $sql2 = "SELECT * FROM Docente WHERE Correo = '$Correo'"; //Filtro con correo en la base de datos
    $resultado2 = mysqli_query($conn, $sql2);
    $rowCount2 = mysqli_num_rows($resultado2); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro




    //Validacion que la lineas obtenidas sean mayor a 0,lo cual significa que si se encontro una linea con el mismo correo 

    if ($rowCount > 0) {
        array_push($errors, 'Ya existe un registro con la informacion igresada');
    }


    if (count($errors) <= 0) {



        if ($accion == 'Agregar') {



            $sql = "INSERT INTO Docente  (Id_cedula,Id_Docente,Id_carrera,Nombre,Apellido1,Apellido2,Nivel_Academico,Correo,Celular,Fecha_Nacimiento) VALUES (?,?,?,?,?,?,?,?,?,?) ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {



                mysqli_stmt_bind_param($stmt,"ssssssssss", $Id_cedula, $Id_Docente, $Id_carrera, $Nombre, $Apellido1, $Apellido2, $Nivel_Academico, $Correo, $Celular, $Fecha_Nacimiento);
                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)



            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acción realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarDocente.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acción,intente de nuevo</h1></div>";
                header("location: ../Paginas/AdministrarDocente.php");
            }

        } // fin agregar





    }  // fin de if(count($errors)>0){
    else {


        if ($accion == 'Agregar'){

            $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informacion ingresada</h1></div>";
            header("location: ../Paginas/AdministrarDocente.php");
        }




        if ($accion == 'Editar') {


            $sql = " UPDATE `Docente` SET `Id_cedula` = '$Id_cedula',`Id_Docente` = '$Id_Docente',`Id_carrera` = '$Id_carrera',`Nombre` = '$Nombre',`Apellido1` = '$Apellido1',`Apellido2` = '$Apellido2',`Nivel_Academico` = '$Nivel_Academico',`Correo` = '$Correo',`Celular` = '$Celular',`Fecha_Nacimiento` = '$Fecha_Nacimiento'  WHERE `Docente`.`Id_cedula` = $Id_cedula";


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
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acción realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarDocente.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acción,intente de nuevo</h1></div>";  //Error al realizar el sql
                header("location: ../Paginas/AdministrarDocente.php");
            }

        
        }// Fin Editar


     


        if ($accion == 'Eliminar') {

            
           
         
            $sql = "DELETE FROM Docente WHERE Id_cedula = $Id_cedula";
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


                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Accion realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarDocente.php");


            } else {

                if ($stmt->errno == "1451") {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> No se puede borrar la entrada debido a que tiene relacion a otro registro</h1></div>";
                    header("location: ../Paginas/AdministrarDocente.php");
                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al ingresar la informacion,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarDocente.php");

                }
            }








        }/// Fin Eliminar








    } /// fin else 


   


}







