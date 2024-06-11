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
    $titulo = "Usuarios";
    
        
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
               
                
                <form action="../SQLs/SQL-Usuarios.php" class="filtros" method="POST" >
                    <div class="filtrar1">
                           <p> Filtrar por Id Usuario: </p>
                       <input type="text" name="find1" />
                        
                     </div>

                 <div class="filtrar2">
                           <p> Filtrar por Correo: </p>
                       <input type="text" name="find2" />
                        
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
             <th>ID Usuario</th>
 <th>Nombre Usuario</th>  <!--Titulos de la tabla-->
  <th>Nombre</th>
  <th>Apellido1</th>
  <th>Apellido2</th>
  <th>Password</th>
  <th>Correo</th>
  <th>Role_Admin</th>
  <th>Role_Mant</th>
  <th>Role_Usuario</th>
          <th >Accion</th>
         </tr>

      </thead>
       
       
       <tbody>

          <?php
              
               require_once "../ConexionBaseDatos/Conexion.php";

          
               // Inicio Validar si hay un sql nuevo para buscar

               if($_SESSION['sql1']){
              $sql = $_SESSION['sql1'];

               }else {

              $sql = "SELECT * FROM usuarios";    // Si no hay un sql nuevo para buscar , entonces select *
            
               }

          // Fin Validar si hay un sql nuevo para buscar
              
               $result = mysqli_query($conn, $sql); //conexion con el sql

               if (!$result) {
                   die("query Failed");  
               } else {
                   
                  
                   while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                
                  ?>

          
          <tr id = "row1">        
           
               
<td  class="Id_Usuario">  <?php echo $row["Id_Usuario"]; ?> </td>  
<td  class="Nombre_Usuario">  <?php echo $row["Nombre_Usuario"]; ?> </td>
<td class="Nombre" >  <?php echo $row["Nombre"]; ?> </td>
<td  class="Apellido1" >  <?php echo $row["Apellido1"]; ?> </td>
<td   class="Apellido2" >  <?php echo $row["Apellido2"]; ?> </td>
<td  class="Password" >  <?php echo $row["Password"]; ?> </td>
<td  class="Correo">  <?php echo $row["Correo"]; ?> </td>
<td  class="Role_Admin">  <?php echo $row["Role_Admin"]; ?> </td>
<td  class="Role_Mant">  <?php echo $row["Role_Mant"]; ?> </td>
<td  class="Role_Usuario">  <?php echo $row["Role_Usuario"]; ?> </td>

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


        <form action="../SQLs/SQL-Usuarios.php" method="POST">
            
              
            <div class="form-group">
            <h1 name="titulo" class="titulo"> Agregar <?php echo $titulo; ?> </h1>
            </div>
            
            <!-- Input para id Usuario-->
            <div class="form-group">
                <a class="sub">Id Usuario   </a>
                
                <input type="text" class="form-control"  name="Id_Usuario"  id="Id_Usuario" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre Usuario-->
            <div class="form-group">
                <a class="sub">Nombre Usuario:   </a>
                
                <input type="text" class="form-control" name="Nombre_Usuario" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Nombre -->
            <div class="form-group">
                <a class="sub">Nombre:</a>
                <input type="text" class="form-control" name="Nombre" oninput="setCustomValidity('')"  oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            <!-- Input para Apellido1 -->
            <div class="form-group">
                <a class="sub">Primer Apellido:</a>
                <input type="text" class="form-control" name="Apellido1" oninput="setCustomValidity('')"  oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            <!-- Input para Apellido2 -->
            <div class="form-group">
                <a class="sub">Segundo Apellido:</a>
                <input type="text" class="form-control" name="Apellido2" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            <!-- Input para Password -->
            <div class="form-group">
                <a class="sub">Contrase&ntildea:</a>
                <input type="password" class="form-control" name="Password" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

             <!-- Input para Correo -->
            <div class="form-group">
                <a class="sub">Correo:</a>
                <input type="email" class="form-control" name="Correo" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

              <!-- Input para role -->
            <div class="checkboxes">
                
                <input type="checkbox"  class="Roleel" name="Admin1" value="true" id="Admin1"/> <label> Administrador</label>
                <input type="checkbox" class="Roleel" name="Mant2" value="true" id="Mant2" /> <label> Mantenimiento</label>
                <input type="checkbox"  class="Roleel" name="usuario3" value="true" id="usuario3"/><label>Usuario</label>
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

         
        


        <form action="../SQLs/SQL-Usuarios.php" method="POST">

            


          
            <div class="form-group">
            <h1 class="titulo">Editar <?php echo $titulo; ?></h1>
            </div>
            
            <!-- Input para id Usuario-->
            <div class="form-group">
                <a class="sub">Id Usuario   </a>
                
                <input  type="text" class="form-control"  name="Id_Usuarioe" id="Id_Usuarioe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para Nombre Usuario-->

            <div class="form-group">
                <a class="sub">Nombre Usuario:</a>
                <input type="text" class="form-control" name="Nombre_Usuarioe" id="Nombre_Usuarioe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            <!-- Input para Nombre -->
            <div class="form-group">
                <a class="sub">Nombre:</a>
                <input type="text" class="form-control" name="Nombree" id="Nombree" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>



            <!-- Input para Apellido1 -->
            <div class="form-group">
                <a class="sub">Primer Apellido:</a>
                <input type="text" class="form-control" name="Apellido1e" id="Apellido1e" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Apellido2 -->
            <div class="form-group">
                <a class="sub">Segundo Apellido:</a>
                <input type="text" class="form-control" name="Apellido2e"  id="Apellido2e" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Password -->
            <div class="form-group">
                <a class="sub">Contrase&ntildea:</a>
                <input type="password" class="form-control" name="Passworde" id="Passworde" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

             <!-- Input para Correo -->
            <div class="form-group">
                <a class="sub">Correo:</a>
                <input type="email" class="form-control" name="Correoe" id="Correoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

              <!-- Input para role -->
            
                
                <div class="checkboxes">
                <input type="checkbox"  id="Admine1" name="Admine1" value="true"/> <label> Administrador</label>
                <input type="checkbox"   id="Mante2" name="Mante2" value="true"/> <label> Mantenimiento</label>
                <input type="checkbox"  id="usuarioe3" name="usuarioe3" value="true"/><label>Usuario</label>
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


        <form action="../SQLs/SQL-Usuarios.php" method="POST">

            
            <div class="form-group">
            <h1 class="titulo">Eliminar <?php echo $titulo; ?></h1>
            </div>
            
            <!-- Input para id Usuario-->
            <div class="form-group">
                <a class="sub">Id Usuario   </a>
                
                <input   type="text" class="form-control"  name="Id_Usuarioel" id="Id_Usuarioel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para Nombre Usuario-->

            <div class="form-group">
                <a class="sub">Nombre Usuario:</a>
                <input  type="text" class="form-control" name="Nombre_Usuarioel" id="Nombre_Usuarioel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            <!-- Input para Nombre -->
            <div class="form-group">
                <a class="sub">Nombre:</a>
                <input   type="text" class="form-control" name="Nombreel" id="Nombreel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>



            <!-- Input para Apellido1 -->
            <div class="form-group">
                <a class="sub">Primer Apellido:</a>
                <input   type="text" class="form-control" name="Apellido1el"  id="Apellido1el" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Apellido2 -->
            <div class="form-group">
                <a class="sub">Segundo Apellido:</a>
                <input   type="text" class="form-control" name="Apellido2el"   id="Apellido2el" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            <!-- Input para Password -->
            <div class="form-group">
                <a class="sub">Contrase&ntildea:</a>
                <input  type="password" class="form-control" name="Passwordel" id="Passwordel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required  />
            </div>

             <!-- Input para Correo -->
            <div class="form-group">
                <a class="sub">Correo:</a>
                <input   type="email" class="form-control" name="Correoel" id="Correoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para role -->
            
                <div class="checkboxes">
                <input disabled="disabled"  type="checkbox"  class="Roleel" id="Adminel1" name="Adminel1" value="Admine" /> <label> Administrador</label>
                <input disabled="disabled"  type="checkbox" class="Roleel" id="Mantel2" value="Mantel"/> <label> Mantenimiento</label>
                <input disabled="disabled"  type="checkbox"  class="Roleel" id="usuarioel3" value="usuarioel"/><label>Usuario</label>
                    </div>

            

            <!-- Boton para Eliminar  -->
            
                
                 <button  class="boton-editar" type="submit" name="submite" value="Actualizar" > eliminar</button>
                
                

        </form>
                   
        
        




    </div>
                
                
              
      


     </div>




      <!--  ----------------------- Fin popup Eliminar ----------------------- -->
        








       





    </div> <!-- Fin div Container-->


   

    <!-- ------------ JavaScripts -----------------------  -->

   

    
 
  <script src="../JavaScripts/JavaScript-Usuarios.js"></script>

    

 

</body>






</html>

