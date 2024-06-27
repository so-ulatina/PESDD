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
    $titulo = "Categoria";
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

               
                
                 <form action="../SQLs/SQL-Categoria.php" class="filtros" method="POST" >
                    <div class="filtrar1">
                           <p>Nombre: </p>
                       <input type="text" name="find1" />
                        
                     </div>

                    <div class="filtrar1">
                           <p>Estado: </p>
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
             <th>Id categor&Iacutea</th>
          <th>Nombre</th>
              <th>Horas Duraci&oacuten desde :</th>
              <th>Horas Duraci&oacuten hasta:</th>
              <th>Estado</th>
              <th>Acci&oacuten</th>
         </tr>

      </thead>
       
       
       <tbody>

          <?php
              
               require_once "../ConexionBaseDatos/Conexion.php";

          
               // Inicio Validar si hay un sql nuevo para buscar

               if($_SESSION['sql1']){
              $sql = $_SESSION['sql1'];
             
               }else {

              $sql = "SELECT * FROM Categoria";    // Si no hay un sql nuevo para buscar , entonces select *
              $_SESSION['sql2'] = $sql;
               }

          // Fin Validar si hay un sql nuevo para buscar
              
               $result = mysqli_query($conn, $sql); //conexion con el sql

               if (!$result) {
                   die("Consulta a la base de datos fallo");  
               } else {
                   
                  
                   while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                
                  ?>

          
          <tr id = "row1">        
           
               
<td  class="Id_categoria">  <?php echo $row["Id_categoria"]; ?> </td>  
<td  class="Nombre">  <?php echo $row["Nombre"]; ?> </td>
<td  class="Horas_duracion_desde">  <?php echo $row["Horas_duracion_desde"]; ?> </td>
<td  class="Horas_duracion_hasta">  <?php echo $row["Horas_duracion_hasta"]; ?> </td>
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
                      3-Utilizar solamente caracteres de tipo num&eacuterico en los campos de Horas duracion desde y hasta.<br />
                      
             <div>
              <button onclick="agregarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-agregar">




        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-Categoria.php" method="POST">
            
              
            <div class="form-group">
            <h1 name="titulo" class="titulo"> Agregar <?php echo $titulo; ?> </h1>
            </div>
            
            

            <!-- Input para Nombre-->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombre" id="Nombre" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Horas Duracion desde-->
            <div class="form-group">
                <a class="sub">Horas Duraci&oacuten desde:</a>
                
                <input type="number" class="form-control" name="Horas_duracion_desde" id="Horas_duracion_desde" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


               <!-- Input para Horas Duracion hasta-->
            <div class="form-group">
                <a class="sub">Horas Duraci&oacuten hasta:</a>
                
                <input type="number" class="form-control" name="Horas_duracion_hasta" id="Horas_duracion_hasta" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

           
                <!-- Input para Estado -->
            
            
             <div class="form-group">
                <a class="sub">Estado :</a>
            
                  <select type="text"  class="form-control"  name="Estado"  id="Estado" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Activo</option>
                            <option  >Inactivo</option>
                         
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
                      3-Utilizar solamente caracteres de tipo num&eacuterico en los campos de Horas duracion desde y hasta.<br />
             <div>
              <button onclick="editarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-editar">

         
        


        <form action="../SQLs/SQL-Categoria.php" method="POST">

            


          
            <div class="form-group">
            <h1 class="titulo">Editar <?php echo $titulo; ?></h1>
            </div>
            
             <!-- Input para id Categoria-->
            <div class="form-group">
                <a class="sub">Id categor&Iacutea:</a>
                
                <input type="text" class="form-control"  name="Id_categoriae"  id="Id_categoriae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre-->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombree" id="Nombree" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

               <!-- Input para Horas Duracion desde-->
            <div class="form-group">
                <a class="sub">Horas Duraci&oacuten desde:</a>
                
                <input type="number" class="form-control" name="Horas_duracion_desdee" id="Horas_duracion_desdee" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


               <!-- Input para Horas Duracion hasta-->
            <div class="form-group">
                <a class="sub">Horas Duraci&oacuten hasta:</a>
                
                <input type="number" class="form-control" name="Horas_duracion_hastae" id="Horas_duracion_hastae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>



            
                <!-- Input para Estado -->
            
            
             <div class="form-group">
                <a class="sub">Estado :</a>
            
                  <select type="text"  class="form-control"  name="Estadoe"  id="Estadoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Activo</option>
                            <option  >Inactivo</option>
                          
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


        <form action="../SQLs/SQL-Categoria.php" method="POST">

            
            <div class="form-group">
            <h1 class="titulo">Eliminar <?php echo $titulo; ?></h1>
            </div>
            
           <!-- Input para id Categoria-->
            <div class="form-group">
                <a class="sub">Id categor&Iacutea:</a>
                
                <input type="text" class="form-control"  name="Id_categoriael"  id="Id_categoriael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre-->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombreel" id="Nombreel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


               <!-- Input para Horas Duracion desde-->
            <div class="form-group">
                <a class="sub">Horas Duraci&oacuten desde:</a>
                
                <input type="text" class="form-control" name="Horas_duracion_desdeel" id="Horas_duracion_desdeel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


               <!-- Input para Horas Duracion hasta-->
            <div class="form-group">
                <a class="sub">Horas duracion hasta:</a>
                
                <input type="text" class="form-control" name="Horas_duracion_hastael" id="Horas_duracion_hastael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


            
                <!-- Input para Estado -->
            
            
             <div class="form-group">
                <a class="sub">Estado :</a>
            
                    <input type="text" class="form-control" name="Estadoel" id="Estadoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />

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

   

    
 
  <script src="../JavaScripts/JavaScript-Categoria.js"></script>

    

 

</body>






</html>

