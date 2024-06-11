<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php"; 



if (isset($_POST['submitf'])){

    $find1 = $_POST['find1'];
   


    if($find1){

        $_SESSION['sql1'] = "SELECT * FROM Carrera  WHERE Nombre LIKE '%$find1%'";
        header("location: ../Paginas/AdministrarCarrera.php");
    }

   

}     


if (isset($_POST['submitundo'])){
    $_SESSION['sql1'] = "SELECT * FROM Carrera";
    header("location: ../Paginas/AdministrarCarrera.php");
}




if (  (isset($_POST['submita'])) || (isset($_POST['submited'])) || (isset($_POST['submite'])) ) {
    $errors = array();

    
    


    if (isset($_POST['submita'])) {

        $accion = "Agregar";

       
        $Nombre = $_POST['Nombre'];

        $Id_Facultad = trim(explode("-", $_POST['Id_Facultad'])[0]);
        $Id_sede = trim(explode("-", $_POST['Id_sede'])[0]);
        

    }

    if (isset($_POST['submited'])) {

        $accion = "Editar";


        $Id_Carrera = $_POST['Id_Carrerae'];
        $Nombre = $_POST['Nombree'];
        $Id_Facultad = $_POST['Id_Facultade'];
        $Id_sede = $_POST['Id_sedee'];

    }

    if (isset($_POST['submite'])) {

        $accion = "Eliminar";

        $Id_Carrera = $_POST['Id_Carrerael'];
        $Nombre = $_POST['Nombreel'];

        $Id_Facultad = trim(explode("-", $_POST['Id_Facultadel'])[0]);
        $Id_sede = trim(explode("-", $_POST['Id_sedeel'])[0]);



    }

    

        $sql = "SELECT * FROM Carrera WHERE Id_Carrera = '$Id_Carrera'"; //Filtro con correo en la base de datos
        $resultado = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro

   

    //Validacion que la lineas obtenidas sean mayor a 0,lo cual significa que si se encontro una linea con el mismo correo 

    if ($rowCount > 0) {
        array_push($errors, 'Ya existe un registro con la informacion igresada');
    }


    if (count($errors) <= 0) {



        if ($accion == 'Agregar') {



            $sql = "INSERT INTO Carrera  (Nombre,Id_Facultad,Id_sede) VALUES (?,?,?) ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {



                mysqli_stmt_bind_param($stmt,"sss", $Nombre, $Id_Facultad, $Id_sede );
                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)



            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Informacion Ingresada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarCarrera.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al ingresar la informacion,intente de nuevo</h1></div>";
                header("location: ../Paginas/AdministrarCarrera.php");
            }

        } // fin agregar





    }  // fin de if(count($errors)>0){
    else {


        if ($accion == 'Agregar'){

            $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informacion ingresada</h1></div>";
            header("location: ../Paginas/AdministrarCarrera.php");
        }




        if ($accion == 'Editar') {

            
            $sql = " UPDATE `Carrera` SET `Nombre` = '$Nombre',`Id_Facultad` = '$Id_Facultad',`Id_sede` = '$Id_sede' WHERE `Carrera`.`Id_Carrera` = $Id_Carrera";

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
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Informacion actualizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarCarrera.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al ingresar la informacion,intente de nuevo</h1></div>";  //Error al realizar el sql
                header("location: ../Paginas/AdministrarCarrera.php");
            }

        } else {

            if ($accion == 'Editar') {

                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informacion ingresada</h1></div>"; // Validacion con row 2 que contiene si ha una entrada con la misma informacion
                header("location: ../Paginas/AdministrarCarrera.php");
            
            }


        }// Fin Editar


     


        if ($accion == 'Eliminar') {

            
           
         
            $sql = "DELETE FROM Carrera WHERE Id_Carrera = $Id_Carrera";
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
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Informacion Eliminada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarCarrera.php");
            } else {

                if ($stmt->errno == "1451") {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> No se puede borrar la entrada debido a que tiene relacion a otro registro</h1></div>";
                    header("location: ../Paginas/AdministrarCarrera.php");
                }else {

                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al ingresar la informacion,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarCarrera.php");

                }


            }
            








        }/// Fin Eliminar








    } /// fin else 


   


}







