<?php
session_start();
require_once "../ConexionBaseDatos/Conexion.php"; 



if (isset($_POST['submitf'])){

    $find1 = $_POST['find1'];
    $find2 = $_POST['find2'];


    if((!$find1) && ($find2)){

        $_SESSION['sql1'] = "SELECT * FROM usuarios WHERE Correo LIKE '%$find2%'";
        header("location: ../Paginas/AdministrarUsuarios.php");
    }

    if (($find1) && (!$find2)) {


        $_SESSION['sql1'] = "SELECT * FROM usuarios WHERE Nombre LIKE '%$find1%'";
        header("location: ../Paginas/AdministrarUsuarios.php");
    }


    if (($find1) && ($find2)) {
        $_SESSION['sql1'] = "SELECT * FROM usuarios WHERE Correo LIKE '%$find2%' and Nombre LIKE '%$find1%' ";
        header("location: ../Paginas/AdministrarUsuarios.php");
    }

    if ((!$find1) && (!$find2)) {
        header("location: ../Paginas/AdministrarUsuarios.php");
    }

}      

if (isset($_POST['submitundo'])){
    $_SESSION['sql1'] = "SELECT * FROM usuarios";
    header("location: ../Paginas/AdministrarUsuarios.php");
}




if (  (isset($_POST['submita'])) || (isset($_POST['submited'])) || (isset($_POST['submite'])) ) {
    $errors = array();

    
    


    if (isset($_POST['submita'])) {

        $accion = "Agregar";

        
        $Nombre_Usuario = $_POST['Nombre_Usuario'];
        $Nombre = $_POST['Nombre'];
        $Apellido1 = $_POST['Apellido1'];
        $Apellido2 = $_POST['Apellido2'];
        $Password = $_POST['Password'];
        $Correo = $_POST['Correo'];
       $Role = $_POST['Rol'];
        $Estado = $_POST['Estado'];


    }

    if (isset($_POST['submited'])) {

        $accion = "Editar";


        $id_Usuario = $_POST['Id_Usuarioe'];
        $Nombre_Usuario = $_POST['Nombre_Usuarioe'];
        $Nombre = $_POST['Nombree'];
        $Apellido1 = $_POST['Apellido1e'];
        $Apellido2 = $_POST['Apellido2e'];
        $Password = $_POST['Passworde'];
        $Correo = $_POST['Correoe'];
        $Role = $_POST['Role'];
        $Estado = $_POST['Estadoe'];

    }

    if (isset($_POST['submite'])) {

        $accion = "Eliminar";

        $id_Usuario = $_POST['Id_Usuarioel'];
        
        $Correo = $_POST['Correoel'];


    }



    $sql = "SELECT * FROM usuarios WHERE Correo = '$Correo'";
    $resultado = mysqli_query($conn, $sql);
    $usuario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    $rowCount = mysqli_num_rows($resultado); //Obtener las lineas obtenidas de la base de datos con el resultado obtenido despues del filtro
   


    //Validacion que la lineas obtenidas sean mayor a 0,lo cual significa que si se encontro una linea con el mismo correo 

    if ($rowCount > 0) {
        array_push($errors, 'Ya existe un usuario con el correo ingresado,por favor utilizar un correo diferente');
    }


    if (count($errors) <= 0) {



        if ($accion == 'Agregar') {


            // Agregar datos del nuevo usuario a la base de datos 


            // Codificar Password

            $password_hash = password_hash($Password, PASSWORD_BCRYPT);





            $sql = "INSERT INTO usuarios (Nombre_Usuario,Nombre,Apellido1,Apellido2,Password,Correo,Rol,Estado) VALUES (?,?,?,?,?,?,?,?) ";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);


            if ($prepareStmt) {



                mysqli_stmt_bind_param($stmt, "ssssssss", $Nombre_Usuario, $Nombre, $Apellido1, $Apellido2, $password_hash, $Correo, $Role, $Estado);
                mysqli_stmt_execute($stmt);



            } // fin de if ($prepareStmt) 
            else { // else de if ($prepareStmt)
                die('Algo salio mal');

            } //fin else de if ($prepareStmt)


            if ($stmt->errno == 0) {
                $_SESSION['resultado'] = "<div class='mensaje-sql-exitoso'><h1> Acci&oacuten realizada stisfactoriamente</h1></div>";
                header("location: ../Paginas/AdministrarUsuarios.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acci&oacuten,intente de nuevo</h1></div>";
                header("location: ../Paginas/AdministrarUsuarios.php");
            }

        } // fin agregar





    }  // fin de if(count($errors)>0){
    else {


        if ($accion == 'Agregar'){

            $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un usuario con el correo ingresado </h1></div>";
            header("location: ../Paginas/AdministrarUsuarios.php");
        }




        if ($accion == 'Editar') {

            // Agregar datos del nuevo usuario a la base de datos 


            // Codificar Password


            if ((password_verify($Password, $usuario["Password"])) || ($Password == $usuario["Password"])) {


                $sql = " UPDATE `usuarios` SET `Nombre_Usuario` = '$Nombre_Usuario',`Nombre` = '$Nombre' , `Apellido1` = '$Apellido1' , `Apellido2` = '$Apellido2' ,`Correo` = '$Correo' ,`Rol` = '$Role' ,`Estado` = '$Estado' WHERE `usuarios`.`Id_Usuario` = $id_Usuario";

            }else {


                $password_hash = password_hash($Password, PASSWORD_BCRYPT);


                $sql = " UPDATE `usuarios` SET `Nombre_Usuario` = '$Nombre_Usuario',`Nombre` = '$Nombre' , `Apellido1` = '$Apellido1' , `Apellido2` = '$Apellido2' ,`Password` = '$password_hash' ,`Correo` = '$Correo' ,`Rol` = '$Role' ,`Estado` = '$Estado' WHERE `usuarios`.`Id_Usuario` = $id_Usuario";

            }
            
            
          

            

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
                header("location: ../Paginas/AdministrarUsuarios.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al realizar la acci&oacuten,intente de nuevo</h1></div>";  //Error al realizar el sql
                header("location: ../Paginas/AdministrarUsuarios.php");
            }

        } else {

            if ($accion == 'Editar') {

                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Ya existe un registro con la informaci&oacuten ingresada</h1></div>"; // Validacion con row 2 que contiene si ha una entrada con la misma informacion
                header("location: ../Paginas/AdministrarUsuarios.php");
            }

        } // Fin Editar


     


        if ($accion == 'Eliminar') {

            // Agregar datos del nuevo usuario a la base de datos 


            // Codificar Password

            $password_hash = password_hash($Password, PASSWORD_BCRYPT);

            

            $sql = "DELETE FROM usuarios WHERE Id_Usuario = $id_Usuario";
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
                header("location: ../Paginas/AdministrarUsuarios.php");
            } else {
                $_SESSION['resultado'] = "<div class='mensaje-sql-error'><h1> Se genero un error al ingresar la informaci&oacuten,intente de nuevo</h1></div>";
                header("location: ../Paginas/AdministrarUsuarios.php");
            }








        }/// Fin Eliminar








    } /// fin else 


   


}







