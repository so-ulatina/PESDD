<!DOCTYPE html>

<?php
use MongoDB\Driver\Session;
include ('../SecureLogin.php');

if (!$_SESSION){
    session_start();
}

$_SESSION['Nombre'];

?>


<html lang="en">

<head>

      <!-- Declaracion variables-->
    <?php
    $titulo = "Usuarios";
    $_SESSION['Categoria'] = $titulo;
        
    ?>

    <!-- Librearias y links-->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  
    <link href="../CSS/Style-General.css" rel="stylesheet"/>

    


</head>

<body >

      <header>
                <nav >
               
                    <ul>
               
                  <li class="logo"><img src="../Imagenes/Logo.jpg" /></li>
                  
                    <li > <h2 class="titulo"> Administrar <?php echo $titulo; ?> </h2></li>
     
                    <li class="logout"> 
                
 <?php

 switch ($_SESSION["Rol"]) {

     case "Administrador":

         ?> 
       <a  href="../Paginas/IndiceAdmin.php" class="last-link" ><h3><span class="material-symbols-outlined">home</span> Inicio</h3></a> 
        <?php
        break;
     case "Mantenimiento":

         ?> 
         <a  href="../Paginas/IndiceMant.php" class="last-link" ><h3><span class="material-symbols-outlined">home</span> Inicio</h3></a> 
        <?php
        break;
     case "Consultor":

         ?> 
       <a  href="../Paginas/IndiceConsultor.php" class="last-link" ><h3><span class="material-symbols-outlined">home</span> Inicio</h3></a> 
        <?php

        break;
     default:
         $fields = "Usuario no tiene un rol asignado";
         break;
 }

 ?> 

    <a class="last-link" href="../SecureLogOut.php" ><h3> <span class="material-symbols-outlined">logout</span>Cerrar Sesi&oacuten</h3></a>
</li>
                     



                </ul>
                </nav>
            </header>    
                  


    <div class="container">
    
  
          <!-- ----------------------------------Inicio de main , centro pagina---------------------------------- -->

        
    <main>
    




        <div class="tabla-centro">

            <div class="tabla">


               <div class="agregar-exportar-iconos">
   <a class="boton-Exportar" href="../Exportar.php"> <span class="material-symbols-outlined">ios_share </span></a>
   <button onclick="agregar()" class="show-popup-agregar" ><span class="material-symbols-outlined">add </span></button>
   </div>
               
                
                <form action="../SQLs/SQL-Usuarios.php" class="filtros" method="POST" >
                    <div class="filtrar1">
                           <p>Nombre: </p>
                       <input type="text" name="find1" />
                        
                     </div>

                 <div class="filtrar1">
                           <p>Correo: </p>
                       <input type="text" name="find2" />
                        
                     </div>
                     <div class="filtrar-undo-iconos">
                     <button  type="submit" name="submitf" ><span class="material-symbols-outlined">search</span></button>
                     <button  type="submit" name="submitundo" ><span class="material-symbols-outlined">undo</span></button>
                     </div>
                    

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
                 </form>

                
                
               
   <div class="tbl-scroll">  
   <table id="tabla" class = "table" cellspacing="0">
      <thead>
          <tr>
             <th>ID Usuario</th>
 <th>Nombre Usuario</th>  <!--Titulos de la tabla-->
  <th>Nombre</th>
  <th>Apellido 1</th>
  <th>Apellido 2</th>
  <th>Correo</th>
  <th>Rol</th>
  <th>Estado</th>
          <th >Acci&oacuten</th>
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
              $_SESSION['sql2'] = $sql;
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
<td  class="Correo">  <?php echo $row["Correo"]; ?> </td>
<td  class="Rol">  <?php echo $row["Rol"]; ?> </td>
<td  class="Estado">  <?php echo $row["Estado"]; ?> </td>

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

          
      
        
      
         
             

</div>

</main>


     <!-- ----------------------------------Fin de main , centro pagina---------------------------------- -->


              <!--  ----------------------- Inicio popup agregar ----------------------- -->


        <div class="popup-container-agregar">

            
         <!-- ----------------- Inicio Instrucciones --------------------- -->

         
        <div class="instrucciones">
       
            
            
             
                          <br /><br /><br />
         Instrucciones Generales:<br /><br />
         1-No dejar ningun campo en blanco.<br />
         2-Utilizar el estado tipo Activo o Inactivo solamente.<br />
         3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de Rol.<br />
         4-Por favor utilizar el formato de ejemplo@ulatina.net para el campo de Correo.<br />
         5-Por favor utilizar una Contrase&ntildea de al menos 10 caracteres.<br />
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
                <input type="password" class="form-control" name="Password" minlength="10" maxlength="255"  oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

             <!-- Input para Correo -->
            <div class="form-group">
                <a class="sub">Correo:</a>
                <input type="email" class="form-control" name="Correo" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>

            
              <!-- Input para Estado -->
            
            
             <div class="form-group">
                <a class="sub">Rol :</a>
            
                  <select type="text"  class="form-control"  name="Rol"  id="Rol" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Administrador</option>
                            <option  >Mantenimiento</option>
                            <option  >Consultor</option>
                  </select>

            </div>


                <!-- Input para Estado -->
            
            
             <div class="form-group">
                <a class="sub">Estado :</a>
            
                  <select type="text"  class="form-control"  name="Estado"  id="Estado" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Activo</option>
                            <option  >Inactivo</option>
                            <option  >Ausente</option>
                  </select>

            </div>



          <!-- Boton para Agregar  -->
            
                <div class="botonagregardiv">
                 <button  class="boton-agregar" type="submit" name="submita" value="Agregar" > Agregar</button>
                </div>
        </form>
                   
        
        




    </div>
                
                
              
      


     </div>





      <!--  ----------------------- Fin popup agregar ----------------------- -->
        




             <!--  ----------------------- Inicio popup editar ----------------------- -->


    <div class="popup-container-editar">


         <!-- ----------------- Inicio Instrucciones --------------------- -->

         
        <div class="instrucciones">
       
         
                      <br /><br /><br />
         Instrucciones Generales:<br /><br />
         1-No dejar ningun campo en blanco.<br />
         2-Utilizar el estado tipo Activo o Inactivo solamente.<br />
         3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de Rol.<br />
         4-Por favor utilizar el formato de ejemplo@ulatina.net para el campo de Correo.<br />
         5-Si se necesita cambiar la Contrase&ntildea por favor agregarla en el campo llamado Contrase&ntildea,si no se ocupa cambiar por favor dejar el campo en blanco.<br />
         6-Por favor utilizar una Contrase&ntildea de al menos 10 caracteres.<br />
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

             <!-- Input para Correo -->
            <div class="form-group">
                <a class="sub">Correo:</a>
                <input type="email" class="form-control" name="Correoe" id="Correoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
            </div>


             <!-- Input para Password -->
            <div class="form-group">
                <a class="sub">Contrase&ntildea:</a>
                <input type="password" class="form-control"  minlength="10" maxlength="255" name="Passworde" id="Passworde" oninput="setCustomValidity('')" />
            </div>


              <!-- Input para Rol -->
            
            
             <div class="form-group">
                <a class="sub">Rol :</a>
            
                  <select type="text"  class="form-control"  name="Role"  id="Role" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Administrador</option>
                            <option  >Mantenimiento</option>
                            <option  >Consultor</option>
                  </select>

            </div>
            
                <!-- Input para Estado -->
            
            
             <div class="form-group">
                <a class="sub">Estado :</a>
            
                  <select type="text"  class="form-control"  name="Estadoe"  id="Estadoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Activo</option>
                            <option  >Inactivo</option>
                            <option  >Ausente</option>
                  </select>

            </div>

            

             <!-- Boton para Actualizar  -->
            
                <div class="botonagregardiv">
                 <button  class="boton-editar" type="submit" name="submited" value="Actualizar" >Actualizar</button>
                </div>

        </form>
                   
        
        




    </div>
                
                
              
      


     </div>





      <!--  ----------------------- Fin popup Editar ----------------------- -->
        






          <!--  ----------------------- Inicio popup Eliminar ----------------------- -->


     <div class="popup-container-eliminar">

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

             <!-- Input para Correo -->
            <div class="form-group">
                <a class="sub">Correo:</a>
                <input   type="email" class="form-control" name="Correoel" id="Correoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Role -->
            <div class="form-group">
                <a class="sub">Rol:</a>
                <input   type="email" class="form-control" name="Rolel" id="Rolel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>
            
            
                <!-- Input para Estado -->
            
            
            <div class="form-group">
                <a class="sub">Estado:</a>
                <input   type="email" class="form-control" name="Estadoel" id="Estadoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>
            
 <!-- Boton para Eliminar  -->
            
               <div class="botonesEliminar">
                 <button  class="boton-editar" type="submit" name="submite" value="Actualizar" > eliminar</button>
                 <button  onclick="editarCerrar()" type="button"> Cerrar</button> 
                   </div>

        </form>
                   
        
        




    </div>
                
                
              
      


     </div>




      <!--  ----------------------- Fin popup Eliminar ----------------------- -->
        








       





    </div> <!-- Fin div Container-->


    <div class="separator"></div>
   

    <footer>

</footer>

    <!-- ------------ JavaScripts -----------------------  -->

   

    
 
  <script src="../JavaScripts/JavaScript-Usuarios.js"></script>

    

 

</body>






</html>

