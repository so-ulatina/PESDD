<!DOCTYPE html>

<?php
use MongoDB\Driver\Session;

include ('../SecureLogin.php');
$_SESSION['sql1'] = "";


$_SESSION['Nombre'];

?>


<html lang="en">

<head>

      <!-- Declaracion variables-->
    <?php
    $titulo = "Bienvenid@s";


    ?>

    <!-- Librearias y links-->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../CSS/Style-General.css" rel="stylesheet"/>

</head>

<body >
        <header>
                <nav >
               
                    <ul>
               
                  <li class="logo"><img src="../Imagenes/Logo.jpg" /></li>
                  
                    <li>
                     <a href="#"><h3>Reportes</h3> </a> 
                    <ul class="dropdown">
                        <li><a class="item" href="../Reportes/Reporte-CursosMatriculadosDocentes.php"><h3> Cursos por Docente</h3></a></li>
                    </ul>
                    </li>

                    <li class="logout"> 
                
                   <a class="last-link" href="../SecureLogOut.php" ><h3> <span class="material-symbols-outlined">logout</span>Cerrar Sesi&oacuten</h3></a>
                    </li>
                </ul>
                </nav>
            </header>    
                  

    
         <div class="indice">
        <div class="Indiceleft">

        </div>

        
        <div class="Indiceright">

          </div>
            </div>




       



    <!-- ------------ JavaScripts -----------------------  -->
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

</body>






</html>

