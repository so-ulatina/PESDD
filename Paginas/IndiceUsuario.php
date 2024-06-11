<!DOCTYPE html>

<?php
use MongoDB\Driver\Session;
include ('../SecureLogin.php');



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
    
    <link href="../CSS/Style-General.css" rel="stylesheet"/>

    


</head>

<body >

    


    <div class="container">
    
     <!-- ----------------------------------Inicio de aside , barra iquierda ---------------------------------- -->
    <div class="sidebar-global">
        
   
        <aside>
            
            <div class="top">

                  <div class="logo">
                  <img src="../Imagenes/Logo.png" />
                  </div>

             </div>


            <div class="sidebar">
                
                   
                 <div id="Reportes" class="item">

                <a href="#" >
                
                   <h3> <span class="material-symbols-outlined">summarize</span>Reportes <span class="material-symbols-outlined">keyboard_arrow_down</span> </h3>
                    
                
                </a>
                
                    <div class="sub-menu">
                        <a class="item" href="#"> Docentes</a>
                        <a class="item" href="#"> Facultades</a>
                    </div>

                 </div>  



                <a  href="#" >
                
                   <h3> <span class="material-symbols-outlined">info</span>Acerca</h3>
                    
                
                </a>

                <a  href="#" >
                
                   <h3> <span class="material-symbols-outlined">contacts</span> Contacto</h3>
                   
                
                </a>


                 
                 <a class="last-link" href="../SecureLogOut.php" >
                
                   <h3> <span class="material-symbols-outlined">logout</span>Cerrar Sesion</h3>
                    
                
                </a>



            </div>

        </aside>
    
   
    </div>
     <!-- ----------------------------------Fin de aside , barra iquierda ---------------------------------- -->

          <!-- ----------------------------------Inicio de main , centro pagina---------------------------------- -->

        
    <main>
    


        
            <div class="date">
                <p id="date-container"></p>
            </div>





        <div class="tabla-centro">



            <h2>  <?php echo $titulo; ?> </h2>





            <div class="Centro">


   
             </div>

          
      
        
      
         
             

</div>

</main>


     <!-- ----------------------------------Fin de main , centro pagina---------------------------------- -->



        <!-- ----------------------------------Inicio Top derecha---------------------------------- -->

        <div class="right">



            <div class="top">

                <div class="perfil">
                    
                    <div class="info">
                        <p> Hola , <b> <?php echo $_SESSION['Nombre']; ?> </b></p>
                        
                    </div>
                

                
                <div class="perfil-foto">
                    <span class="material-symbols-outlined">account_circle</span>
                </div>
                
                </div>


            </div>







        </div>


        <!-- ----------------------------------Fin Top derecha---------------------------------- -->




    </div> <!-- Fin div Container-->


   

    <!-- ------------ JavaScripts -----------------------  -->

   

 

</body>






</html>

