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
                     <a href="#"><h3>Administrar</h3> </a> 
                    <ul class="dropdown">
                        <li><a  href="../Paginas/AdministrarModalidad.php"><h3> Modalidades</h3></a></li>
                       <li> <a  href="../Paginas/AdministrarFacultad.php"><h3> Facultades</h3></a></li>
                       <li> <a  href="../Paginas/AdministrarAdministrador.php"> <h3>Administrador</h3></a></li>
                       <li> <a  href="../Paginas/AdministrarCarrera.php"> <h3>Carrera</h3></a></li>
                      <li>  <a  href="../Paginas/AdministrarCertificado.php"> <h3>Certificado</h3></a></li>
                       <li> <a  href="../Paginas/AdministrarDocente.php"> <h3>Docente</h3></a></li>
                      <li>  <a  href="../Paginas/AdministrarSede.php"> <h3>Sede</h3></a></li>
                      <li>  <a  href="../Paginas/AdministrarCategoria.php"> <h3>Categoria</h3></a></li>
                      <li>  <a  href="../Paginas/AdministrarCuatrimestre.php"><h3> Cuatrimestre</h3></a></li>
                      <li>  <a  href="../Paginas/AdministrarCurso.php"> <h3>Curso</h3></a></li>
                       <li> <a  href="../Paginas/AdministrarCursosMatriculados.php"> <h3>Cursos Matriculados</h3></a></li>
                      <li><a  href="../Paginas/AdministrarNivelAcademico.php"> <h3>Nivel Acad&eacute;mico</h3></a></li>
                    </ul>
                    </li>
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

