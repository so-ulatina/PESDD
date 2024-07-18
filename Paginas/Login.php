

<!DOCTYPE html>

<?php
session_start();
$_SESSION['sql1'] = "";
?>


<html lang="en">

<!-- Inicio  Header de la pagina Login -->
<head >  

	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=chrome">
    
<!-- Librerias y links -->

    
	<link rel="stylesheet" href="../CSS/Style-Login.css" /> 

</head> 

<!-- Fin Header de la pagina Login -->


<!-- Inicio  body  de la pagina Login -->
<body>

	<header>
		
	</header>

	<!-- Inicio de pagina-->




    <div class="container" id="container">

 <div class="form-container bienvenidos">
       
             <form>
            
              <div >
                  
                  <h1 > Bienvenidos !!!</h1>
                  <p>Departamento Desarrollo Docente</p>
              </div>
                
                 <div class="image-logo">
                     <img src="../Imagenes/Logo.jpg" id="logo" /> 
                 </div>
               
                  <div >
                     <img src="../Imagenes/personajes.png" /> 
                 </div>
               
              </form>
                
           
	</div>


<div class="form-container iniciar-sesion">
 

<!-- Formulario para Login -->

<Form action="../SQLs/SQL-Login.php" method="post"> <!-- se declara post para que asi se ejecute al presionar el boton de submit -->

<div class="image-logo">
<img src="../Imagenes/Logo.jpg" id="logo" /> 
</div>

  <!--  Inicio mensaje datos incorrectos al hacer login   -->

                <?php
                if (isset($_SESSION['Error']) && $_SESSION['Error'] != '') {

                    ?>
                    
                
                    <?php echo $_SESSION['Error']; ?>     
                
                    <?php
                    unset($_SESSION['Error']);
                }

                ?>
                
               <!--  Inicio mensaje datos incorrectos al hacer login   -->



<h1 >Iniciar Sesi&oacuten <i class="bi bi-person-circle"></i></h1>

   


<div class="form-group"  >



<input type="email" placeholder="Correo" name="Correo" >  <!-- agregar campo de usuario para que acepte valores -->

</div>

<div class="form-group"  >
<input type="password" placeholder="Password" name="Password" >  <!-- agregar campo de password para que acepte valores -->
</div>

<div class="form-btn">

    <button class="boton" type="submit" value="Ingresar" name="login"  >Iniciar Sesi&oacuten</button>

</div>

</Form>

<!-- Fin Formulario para Login -->

</div>


<div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-bienvenidos-salir">
                    <h1>Bienvenidos !!! </h1>
                    <p>Sistema de administracion Departamento Desarrollo Docente</p>
                    <button class="btn-salir" id="Salir">Salir</button>
                </div>
                <div class="toggle-panel toggle-bienvenidos-iniciar-sesion">
                    <h1>Hola,</h1>
                    <p>Inicia Sesi&oacuten para poder utilizar el sistema. </p>
                    <button class="btn-iniciar-sesion" id="IniciarSesion1">Iniciar Sesi&oacuten</button>
                </div>
            </div>
        </div>

        


</div>	

    <div class="separator"></div>
   

    <footer>


               
              <div class="icons-sociales">
                <a class="a-iconos" href="#"> <i class="bi bi-facebook"></i></a>
                <a class="a-iconos" href="#"> <i class="bi bi-youtube"></i></a>
                <a class="a-iconos" href="#"> <i class="bi bi-twitter"></i></a>  
                <a class="a-iconos" href="#"> <i class="bi bi-instagram"></i></a>  
                <a class="a-iconos" href="#"> <i class="bi bi-linkedin"></i></a> 
                </div>


</footer>


    <script src="../JavaScripts/JavaScript-Login.js"></script>

</body>
<!-- Fin  body  de la pagina Login -->

</html>
