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
    $titulo = "Cursos Matriculados";
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
               
                
               <form action="../SQLs/SQL-CursosMatriculados.php" class="filtros" method="POST" >
                    <div class="filtrar1">
                           <p>Id Curso: </p>
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
             <th>Id Cursos Matriculados</th>
          <th>Id c&eacutedula</th>
              <th>Id cuatrimestre</th>
              <th>Id curso</th>
              <th>Nota </th>
              <th>Estado </th>
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

              $sql = "SELECT * FROM Cursos_Matriculados";    // Si no hay un sql nuevo para buscar , entonces select *
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
           
               
<td  class="Id_cursos_matriculados">  <?php echo $row["Id_cursos_matriculados"]; ?> </td>  
<td  class="Id_cedula">  <?php echo $row["Id_cedula"]; ?> </td>





<!--  ---------- Inicio obtener nombre para todas las cuatrimestres ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM cuatrimestre WHERE Id_Cuatrimestre = " . $row["Id_cuatrimestre"];

                 $resultCuatrimestres = mysqli_query($conn, $sql); //conexion con el sql
                 $rowCuatrimestres = mysqli_fetch_assoc($resultCuatrimestres);

                 if (!$resultCuatrimestres) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                          <td  class="Id_cuatrimestre">  <?php echo $rowCuatrimestres["Id_Cuatrimestre"]."-". $rowCuatrimestres["Periodo"]."-". $rowCuatrimestres["Ano"]; ?> </td>

                      <?php } ?>

                 <!--  ----------  Fin Select para todas las cuatrimestres ----------   -->




<!--  ---------- Inicio obtener nombre para todas las curso ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM curso WHERE Id_curso = " . $row["Id_curso"];

                 $resultcurso = mysqli_query($conn, $sql); //conexion con el sql
                 $rowcurso = mysqli_fetch_assoc($resultcurso);

                 if (!$resultcurso) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                          <td  class="Id_curso">  <?php echo $rowcurso["Id_Curso"]."-". $rowcurso["Nombre"]; ?> </td>

                      <?php } ?>

                 <!--  ----------  Fin Select para todas las curso ----------   -->


<td  class="Nota">  <?php echo $row["Nota"]; ?> </td>
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
                      3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de Id C&eacutedula , Id Cuatrimestre e Id Curso.<br />
                      4-Por favor utilizar como maximo 2 decimales en el campo de Nota e identificarlo con un punto. 
           
             <div>
              <button onclick="agregarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-agregar">




        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-CursosMatriculados.php" method="POST">
            
              
            <div class="form-group">
            <h1 name="titulo" class="titulo"> Agregar <?php echo $titulo; ?> </h1>
            </div>
            
           <!-- Input para id Cedula -->
            
            
             <div class="form-group">
                <a class="sub">Id C&eacutedula :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las cedulas ----------   -->


                  <select type="text"  class="form-control"  name="Id_Cedula"  id="Id_Cedula" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Docente WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option>  <?php echo $row["Id_cedula"] , "-" , $row["Nombre"] , "-" ,  $row["Apellido1"] ,"-" , $row["Apellido2"];  ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las cedulas ----------   -->

                
            </div>

               <!-- Input para id Cuatrimestre -->
            
            
             <div class="form-group">
                <a class="sub">Id Cuatrimestre :</a>
            

                 <!--  ----------  Inicio Select para todas los cuatrimestres ----------   -->


                  <select type="text"  class="form-control"  name="Id_Cuatrimestre"  id="Id_Cuatrimestre" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Cuatrimestre WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option>  <?php echo $row["Id_Cuatrimestre"], "-", $row["Periodo"], "-", $row["Ano"] ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas los cuatrimestres ----------   -->

                
            </div>




              <!-- Input para id Curso -->
            
            
             <div class="form-group">
                <a class="sub">Id Curso :</a>
            

                 <!--  ----------  Fin Select para todos los Cursos ----------   -->


                  <select type="text"  class="form-control"  name="Id_Curso"  id="Id_Curso" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Curso WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option>  <?php echo $row["Id_Curso"], "-", $row["Nombre"] ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todos los Cursos ----------   -->

                
            </div>



             <!-- Input para Nota-->
            <div class="form-group">
                <a class="sub">Nota:</a>
                
                <input type="text" class="form-control" name="Nota" id="Nota" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Estado-->
            <div class="form-group">
                <a class="sub">Estado:</a>
                <select type="text"  class="form-control"  name="Estado"  id="Estado" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                            <option  >Aprobado</option>
                            <option  >Reprobado</option>
                         
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
                      3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de Id C&eacutedula , Id Cuatrimestre e Id Curso.<br />
                      4-Por favor utilizar como maximo 2 decimales en el campo de Nota e identificarlo con un punto. 
             <div>
              <button onclick="editarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-editar">

         
        


        <form action="../SQLs/SQL-CursosMatriculados.php" method="POST">

            


          
            <div class="form-group">
            <h1 class="titulo">Editar <?php echo $titulo; ?></h1>
            </div>
            
             <!-- Input para Id_cursos_matriculados-->
            <div class="form-group">
                <a class="sub">Id cursos matriculados:</a>
                
                <input type="text" class="form-control"  name="Id_cursos_matriculadose"  id="Id_cursos_matriculadose" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


               
           <!-- Input para id Cedula -->
            
            
             <div class="form-group">
                <a class="sub">Id C&eacutedula :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las cedulas ----------   -->


                  <select type="text"  class="form-control"  name="Id_Cedula"  id="Id_Cedula" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Docente";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class=" <?php echo "Cedula-",$row["Id_cedula"]; ?>">  <?php echo $row["Id_cedula"], "-", $row["Nombre"], "-", $row["Apellido1"], "-", $row["Apellido2"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las cedulas ----------   -->

                
            </div>

               <!-- Input para id Cuatrimestre -->
            
            
             <div class="form-group">
                <a class="sub">Id Cuatrimestre :</a>
            

                 <!--  ----------  Inicio Select para todas los cuatrimestres ----------   -->


                  <select type="text"  class="form-control"  name="Id_Cuatrimestre"  id="Id_Cuatrimestre" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Cuatrimestre";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Cuatrimestre-",$row["Id_Cuatrimestre"]; ?>" >  <?php echo $row["Id_Cuatrimestre"], "-", $row["Periodo"], "-", $row["Ano"] ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas los cuatrimestres ----------   -->

                
            </div>




              <!-- Input para id Curso -->
            
            
             <div class="form-group">
                <a class="sub">Id Curso :</a>
            

                 <!--  ----------  Fin Select para todos los Cursos ----------   -->


                  <select type="text"  class="form-control"  name="Id_Curso"  id="Id_Curso" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Curso";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Curso-", $row["Id_Curso"]?> ">  <?php echo $row["Id_Curso"], "-", $row["Nombre"] ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todos los Cursos ----------   -->

                
            </div>






             <!-- Input para Nota-->
            <div class="form-group">
                <a class="sub">Nota:</a>
                
                <input type="text" class="form-control" name="Notae" id="Notae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Estado-->
            <div class="form-group">
                <a class="sub">Estado:</a>
                
                <input type="text" class="form-control" name="Estadoe" id="Estadoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
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


        <form action="../SQLs/SQL-CursosMatriculados.php" method="POST">

            
            <div class="form-group">
            <h1 class="titulo">Eliminar <?php echo $titulo; ?></h1>
            </div>
            
             <!-- Input para Id_cursos_matriculados-->
            <div class="form-group">
                <a class="sub">Id cursos matriculados:</a>
                
                <input type="text" class="form-control"  name="Id_cursos_matriculadosel"  id="Id_cursos_matriculadosel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Id_cedula-->
            <div class="form-group">
                <a class="sub">Id c&eacutedula:</a>
                
                <input type="text" class="form-control" name="Id_cedulael" id="Id_cedulael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Id cuatrimestre-->
            <div class="form-group">
                <a class="sub">Id cuatrimestre:</a>
                
                <input type="text" class="form-control" name="Id_cuatrimestreel" id="Id_cuatrimestreel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Id_curso-->
            <div class="form-group">
                <a class="sub">Id curso:</a>
                
                <input type="text" class="form-control" name="Id_cursoel" id="Id_cursoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

             <!-- Input para Nota-->
            <div class="form-group">
                <a class="sub">Nota:</a>
                
                <input type="text" class="form-control" name="Notael" id="Notael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

              <!-- Input para Estado-->
            <div class="form-group">
                <a class="sub">Estado:</a>
                
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

   

    
 
  <script src="../JavaScripts/JavaScript-CursosMatriculados.js"></script>

    

 

</body>






</html>

