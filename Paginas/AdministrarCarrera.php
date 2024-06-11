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
    $titulo = "Carrera";
    
        
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
                

                <?php

                if($_SESSION["Role"] == "Admin"){
                  
                 ?>              
                    <a  href="../Paginas/IndiceAdmin.php" >
                
                   <h3> <span class="material-symbols-outlined">home</span>Inicio</h3>
                    
                </a>

                <?php

                }elseif ($_SESSION["Role"] == "Mant") {
                   
                ?>
                 
                 <a  href="../Paginas/IndiceMant.php" >
                
                   <h3> <span class="material-symbols-outlined">home</span>Inicio</h3>
                    
                </a>

                <?php

                }else {
                   ?> 
                 <a  href="../Paginas/IndiceUsuario.php" >
                
                   <h3> <span class="material-symbols-outlined">home</span>Inicio</h3>
                    
                </a>


                <?php
                }

                ?>




               

                

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



            <h2> Administrar <?php echo $titulo; ?> </h2>

            <div class="tabla">


               <div class="agregar-exportar-iconos">
                   
                       
                       <a href="../Exportar.php"> <span class="material-symbols-outlined">ios_share </span> Exportar </a>
                       
                       
                       <button onclick="agregar()" class="show-popup-agregar" ><span class="material-symbols-outlined">add </span>Agregar</button>
                       
                       
                   
                   </div>
               
                
                <form action="../SQLs/SQL-Carrera.php" class="filtros" method="POST" >
                    <div class="filtrar1">
                           <p> Filtrar por Nombre: </p>
                       <input type="text" name="find1" />
                        
                     </div>

                 
                    <button class="btn-filtrar" type="submit" name="submitf" ><span class="material-symbols-outlined">search</span></button>
                    <button class="btn-filtrar" type="submit" name="submitundo" ><span class="material-symbols-outlined">undo</span></button>


                 </form>


                    <!--  Inicio mensaje Respuesta Agregar a la base de datos   -->

                <?php
                if (isset($_SESSION['resultado']) && $_SESSION['resultado'] != '') {
                    
                    ?>
                    
                
                    <?php echo $_SESSION['resultado']; ?>     
                
                    <?php
                    unset($_SESSION['resultado']);
                }

                ?>
                
                <!--  Fin mensaje Respuesta Agregar a la base de datos   -->
                
                
               
   
   <table id="tabla" class = "table">
      <thead>
          <tr>
             <th>Id_Carrera</th>
          <th>Nombre</th>
              <th>Id Facultad</th>
              <th>Id sede </th>
              <th>Accion</th>

         </tr>


      </thead>
       
       
       <tbody>

          <?php
              
               require_once "../ConexionBaseDatos/Conexion.php";

          
               // Inicio Validar si hay un sql nuevo para buscar

               if($_SESSION['sql1']){
              $sql = $_SESSION['sql1'];

               }else {

              $sql = "SELECT * FROM Carrera";    // Si no hay un sql nuevo para buscar , entonces select *
              
               }

          // Fin Validar si hay un sql nuevo para buscar
              
               $result = mysqli_query($conn, $sql); //conexion con el sql

               if (!$result) {
                   die("Consulta a la base de datos fallo");  
               } else {
                   
                  
                   while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                
                  ?>

          
          <tr id = "row1">        
           
               
<td  class="Id_Carrera">  <?php echo $row["Id_Carrera"]; ?> </td>  
<td  class="Nombre">  <?php echo $row["Nombre"]; ?> </td>
<td  class="Id_Facultad">  <?php echo $row["Id_Facultad"]; ?> </td>
<td  class="Id_sede">  <?php echo $row["Id_sede"]; ?> </td>




               <td> 
                    <button  type = "button" value = "Editar" class = "boton-popup"  ><span class="material-symbols-outlined"> edit </span></button>
                    <button type = "button" value = "Eliminar" class = "boton-popup"  ><span class="material-symbols-outlined">delete</span></button>
               </td>

            
                 
             
         </tr>
         
              <?php



              }
          





          } // primer else
          ?>




      </tbody>
   </table>

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




        
              <!--  ----------------------- Inicio popup agregar ----------------------- -->


        <div class="popup-container-agregar">

            
         <!-- ----------------- Inicio Instrucciones --------------------- -->

         
        <div class="instrucciones">
       
             <img src="../Imagenes/Logo.png" id="logo" class="image-logo"/> 
            
             
                      <br /><br /><br />
                      Instrucciones Generales:<br /><br />
                      1-No dejar ningun campo en blanco.<br />
                      2-Password tiene que ser de al menos 8 caracteres.<br />
                      3-Utilizar el formato email@ulatina.net para el campo de correo.<br /><br /><br />
             <div>
              <button onclick="agregarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-agregar">




        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-Carrera.php" method="POST">
            
              
            <div class="form-group">
            <h1 name="titulo" class="titulo"> Agregar <?php echo $titulo; ?> </h1>
            </div>
            
          

            <!-- Input para Nombre -->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombre" id="Nombre" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

             <!-- Input para id Facultad -->
            
            
             <div class="form-group">
                <a class="sub">Id Facultad :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las facultades ----------   -->


                  <select type="text"  class="form-control"  name="Id_Facultad"  id="Id_Facultad" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Facultad";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option>  <?php echo $row["Id_Facultad"] , "-" , $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Facultades ----------   -->

                
            </div>



            <!-- Input para id Sede -->
            
            
             <div class="form-group">
                <a class="sub">Id Sede :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las Sedes ----------   -->


                  <select type="text"  class="form-control"  name="Id_sede"  id="Id_sede" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Sede";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option>  <?php echo $row["Id_sede"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Sede ----------   -->

                
            </div>


           

            <!-- Boton para Agregar  -->
            
                
                 <button  class="boton-agregar" type="submit" name="submita" value="Agregar" > Agregar</button>
                
        </form>
                   
        
        




    </div>
                
                
              
      


     </div>





      <!--  ----------------------- Fin popup agregar ----------------------- -->
        




             <!--  ----------------------- Inicio popup editar ----------------------- -->


    <div class="popup-container-editar">


         <!-- ----------------- Inicio Instrucciones --------------------- -->

         
        <div class="instrucciones">
       
             <img src="../Imagenes/Logo.png" id="logo" class="image-logo"/> 
            
              
                  
                      <br /><br /><br />
                      Instrucciones Generales:<br /><br />
                      1-No dejar ningun campo en blanco.<br />
                      2-Password tiene que ser de al menos 8 caracteres.<br />
                      3-Utilizar el formato email@ulatina.net para el campo de correo.<br /><br /><br />
             <div>
              <button onclick="editarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-editar">

         
        


        <form action="../SQLs/SQL-Carrera.php" method="POST">

            


          
            <div class="form-group">
            <h1 class="titulo">Editar <?php echo $titulo; ?></h1>
            </div>
            
          <!-- Input para Id_Carrera-->
            <div class="form-group">
                <a class="sub">Id Carrera:</a>
                
                <input type="text" class="form-control"  name="Id_Carrerae"  id="Id_Carrerae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre -->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombree" id="Nombree" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

         
            <!-- Input para id Facultad -->
            
            
             <div class="form-group">
                <a class="sub">Id Facultad :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las facultades ----------   -->


                  <select type="text"  class="form-control"  name="Id_Facultade"  id="Id_Facultade" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Facultad";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class=" <?php echo "Facultad-", $row["Id_Facultad"];?>" >  <?php echo $row["Id_Facultad"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Facultades ----------   -->

                
            </div>




            <!-- Input para id Sede -->
            
            
             <div class="form-group">
                <a class="sub">Id Sede :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las Sedes ----------   -->


                  <select type="text"  class="form-control"  name="Id_sedee"  id="Id_sedee" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Sede";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php  echo "Sede-", $row["Id_sede"];?>" >  <?php echo $row["Id_sede"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }


                 ?>

                  </select>

                 <!--  ----------  Fin Select para todas las Facultades ----------   -->

                </div>
            

            
            <!-- Boton para Actualizar  -->
            
                
                 <button  class="boton-editar" type="submit" name="submited" value="Actualizar" > Actualizar</button>
                
                

        </form>
                   
        
        




    </div>
                
                
              
      


     </div>





      <!--  ----------------------- Fin popup Editar ----------------------- -->
        






          <!--  ----------------------- Inicio popup Eliminar ----------------------- -->


     <div class="popup-container-eliminar">


         <!-- ----------------- Inicio Instrucciones --------------------- -->

         
        <div class="instrucciones">
       
             <img src="../Imagenes/Logo.png" id="logo" class="image-logo"/> 
            
              
                  
                      <br /><br /><br />
                      Instrucciones Generales:<br /><br />
                      1-No dejar ningun campo en blanco.<br />
                      2-Password tiene que ser de al menos 8 caracteres.<br />
                      3-Utilizar el formato email@ulatina.net para el campo de correo.<br /><br /><br />
             <div>
              <button onclick="editarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-eliminar">

         
        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-Carrera.php" method="POST">

            
            <div class="form-group">
            <h1 class="titulo">Eliminar <?php echo $titulo; ?></h1>
            </div>
            
            <!-- Input para Id_Carrera-->
            <div class="form-group">
                <a class="sub">Id Carrera:</a>
                
                <input type="text" class="form-control"  name="Id_Carrerael"  id="Id_Carrerael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre -->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombreel" id="Nombreel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Id_Facultad-->
            <div class="form-group">
                <a class="sub">Id Facultad:</a>
                
                <input type="text" class="form-control" name="Id_Facultadel" id="Id_Facultadel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Id_sede -->
            <div class="form-group">
                <a class="sub">Id sede:</a>
                
                <input type="text" class="form-control" name="Id_sedeel" id="Id_sedeel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            

            <!-- Boton para Eliminar  -->
            
                
                 <button  class="boton-editar" type="submit" name="submite" value="Actualizar" > eliminar</button>
                
                

        </form>
                   
        
        




    </div>
                
                
              
      


     </div>




      <!--  ----------------------- Fin popup Eliminar ----------------------- -->
        








       





    </div> <!-- Fin div Container-->


   

    <!-- ------------ JavaScripts -----------------------  -->

   

    
 
  <script src="../JavaScripts/JavaScript-Carrera.js"></script>

    

 

</body>






</html>

