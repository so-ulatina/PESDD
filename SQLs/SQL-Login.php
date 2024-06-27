<?php
session_start();
  require_once "../ConexionBaseDatos/Conexion.php"; // incluir el archivo php que tiene la conexion a la base de datos

if (isset($_POST["login"])) { // Se agrega submit para que asi cumpla la funcion del boton del form


    // Declaracion de variables

    $correo = $_POST['Correo'];
    $password = $_POST['Password'];



    require_once "../ConexionBaseDatos/Conexion.php"; // incluir el archivo php que tiene la conexion a la base de datos


    // Declaracion variables para validacion de usuario en la base de datos 

    $sql = "SELECT * FROM usuarios WHERE Correo = '$correo' and Estado = 'Activo'";
    $resultado = mysqli_query($conn, $sql);
    $usuario = mysqli_fetch_array($resultado, MYSQLI_ASSOC);





    //Validacion usuario existe en la base de datos

    if ($usuario) {


        if (password_verify($password, $usuario["Password"])) {

            // Iniciar sesion del usuario que ya hizo login


            $_SESSION['Correo'] = $usuario["Correo"];
            $_SESSION['Nombre'] = $usuario["Nombre"];

            // si el usuario ya hizo login,redireccionarlo al indice,sino redireccionarlo a login con un error


            if ($usuario["Rol"]== "Administrador") {

                $_SESSION["Rol"] = "Administrador"; 
                header("Location: ../Paginas/IndiceAdmin.php");
                die();

            }else if ($usuario["Rol"] == "Mantenimiento") {
                $_SESSION["Rol"] = "Mantenimiento" ;
                header("Location: ../Paginas/IndiceMant.php");
                die();

            }else {
                $_SESSION["Rol"] = "Consultor";
                header("Location: ../Paginas/IndiceConsultor.php");
                die();
            }



        } // fin de if ($password = $usuario["password"]){
        else {

            $_SESSION['Error'] = "<div class='errorLogin'id= 'error'> <h3>Password incorrecto</h3></div>";
            header("Location: ../Paginas/Login.php");

        }
    } else {
        $_SESSION['Error'] = "<div class='errorLogin'id= 'error'> <h3>Correo incorrecto o Usuario Inactivo</h3></div>";
        header("Location: ../Paginas/Login.php");


    }


} // Fin de if (isset($_POST["login"])) {
