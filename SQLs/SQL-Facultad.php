<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php";



if (isset($_POST['submitf'])) {

    $find1 = $_POST['find1'];
    $find2 = $_POST['find2'];


    if ((!$find1) && ($find2)) {

        $_SESSION['sql1'] = "SELECT * FROM Facultad WHERE Estado = '$find2'";
        header("location: ../Paginas/AdministrarFacultad.php");
    }

    if (($find1) && (!$find2)) {


        $_SESSION['sql1'] = "SELECT * FROM Facultad WHERE Nombre LIKE '%$find1%'";
        header("location: ../Paginas/AdministrarFacultad.php");
    }


    if (($find1) && ($find2)) {
        $_SESSION['sql1'] = "SELECT * FROM Facultad WHERE Estado = '$find2' and Nombre LIKE '%$find1%' ";
        header("location: ../Paginas/AdministrarFacultad.php");
    }

    if ((!$find1) && (!$find2)) {
        header("location: ../Paginas/AdministrarFacultad.php");
    }

}


if (isset($_POST['submitundo'])){
    $_SESSION['sql1'] = "SELECT * FROM Facultad";
    header("location: ../Paginas/AdministrarFacultad.php");
}




if (  (isset($_POST['submita'])) || (isset($_POST['submited'])) || (isset($_POST['submite'])) ) {
    $errors = array();

    
    


    if (isset($_POST['submita'])) {

        $accion = "Agregar";

       
        $Nombre = $_POST['Nombre'];
        $Estado = $_POST['Estado'];




    }

    if (isset($_POST['submited'])) {

        $accion = "Editar";


        $Id_Facultad = $_POST['Id_Facultade'];
        $Nombre = $_POST['Nombree'];
        $Estado = $_POST['Estadoe'];

    }

    if (isset($_POST['submite'])) {

        $accion = "Eliminar";

        $Id_Facultad = $_POST['Id_Facultadel'];
        $Nombre = $_POST['Nombreel'];
        $Estado = $_POST['Estadoel'];

    }


    if (($accion == "Eliminar") || ($accion == "Editar")) {

        $sql = "SELECT * FROM Facultad WHERE Id_Facultad = '$Id_Facultad'"; //Filtro con correo en la base de datos
        $resultado = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro




    }else {

        $sql = "SELECT * FROM Facultad WHERE Nombre = '$Nombre'"; //Filtro con correo en la base de datos
        $resultado = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro


    }



    

    //Validacion que la lineas obtenidas sean mayor a 0,lo cual significa que si se encontro una linea con el mismo correo 

    if ($rowCount > 0) {
        array_push($errors, 'Ya existe un registro con la informaci&oacuten igresada');
    }


    if (count($errors) <= 0) {



        if ($accion == 'Agregar') {



            $sql = "INSERT INTO Facultad  (Nombre,Estado) VALUES (?,?) ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {



                mysqli_stmt_bind_param($stmt,"ss", $Nombre, $Estado );
                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)


            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acci&oacuten realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarFacultad.php");
            } else {
                if ($stmt->errno == 1062) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
                    header("location: ../Paginas/AdministrarFacultad.php");

                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la Acci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarFacultad.php");

                }
            }

        } // fin agregar





    }  // fin de if(count($errors)>0){
    else {


        if ($accion == 'Agregar'){

            $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
            header("location: ../Paginas/AdministrarFacultad.php");
        }




        if ($accion == 'Editar') {

            
            $sql = " UPDATE `Facultad` SET `Nombre` = '$Nombre',`Estado` = '$Estado' WHERE `Facultad`.`Id_Facultad` = $Id_Facultad";

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
                header("location: ../Paginas/AdministrarFacultad.php");
            } else {
                if ($stmt->errno == 1062) {
                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>";
                    header("location: ../Paginas/AdministrarFacultad.php");

                } else {


                    $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la Acci&oacuten,intente de nuevo</h1></div>";
                    header("location: ../Paginas/AdministrarFacultad.php");

                }
            }

        } else {

            if ($accion == 'Editar') {

                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>"; // Validacion con row 2 que contiene si ha una entrada con la misma informacion
                header("location: ../Paginas/AdministrarFacultad.php");
            }


        }// Fin Editar






        if ($accion == 'Eliminar') {


            //Validacion si hay dependencia 

            $sql1 = "SELECT * FROM Carrera WHERE Id_Facultad= '$Id_Facultad'"; //Filtro con correo en la base de datos
            $resultado = mysqli_query($conn, $sql1);
            $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro


            if ($rowCount > 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> No se puede borrar la entrada debido a que tiene relaci&oacuten a otro registro</h1></div>";
                header("location: ../Paginas/AdministrarFacultad.php");
            } else {



                $sql = "DELETE FROM Facultad WHERE Id_Facultad = $Id_Facultad";
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
                    header("location: ../Paginas/AdministrarFacultad.php");
                }




            }



        }/// Fin Eliminar









    } /// fin else 


   


}







