<!DOCTYPE html>

<?php
use MongoDB\Driver\Session;
include ('../SecureLogin.php');

if (!$_SESSION) {
    session_start();
}

$_SESSION['Nombre'];

?>


<html lang="en">

<head>

      <!-- Declaracion variables-->
    <?php
    $titulo = "Docente";
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
    
    
        
    <main>
    


        <div class="tabla-centro">

            <div class="tabla">


              <div class="agregar-exportar-iconos">
   <a class="boton-Exportar" href="../Exportar.php"> <span class="material-symbols-outlined">ios_share </span></a>
   <button onclick="agregar()" class="show-popup-agregar" ><span class="material-symbols-outlined">add </span></button>
   </div>
               
                
                <form action="../SQLs/SQL-Docente.php" class="filtros" method="POST" >
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
             <th>Id c&eacutedula</th>
             <th>Id Docente</th>
              <th>Id carrera</th>
              <th>Nombre</th>
              <th>Apellido1</th>
              <th>Apellido2</th>
              <th>Id Nivel Acad&eacutemico</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Fecha Nacimiento</th>
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

              $sql = "SELECT * FROM Docente";    // Si no hay un sql nuevo para buscar , entonces select *
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
           
               
<td  class="Id_cedula">  <?php echo $row["Id_cedula"]; ?> </td>  
<td  class="Id_Docente">  <?php echo $row["Id_Docente"]; ?> </td>



                <!--  ---------- Inicio obtener nombre para todas las carreras ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM carrera WHERE Id_carrera = " . $row["Id_carrera"];

                 $resultCarreras = mysqli_query($conn, $sql); //conexion con el sql
                 $rowCarreras = mysqli_fetch_assoc($resultCarreras);

                 if (!$resultCarreras) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                           <td  class="Id_carrera">  <?php echo $rowCarreras["Id_Carrera"]."-". $rowCarreras["Nombre"]; ?> </td>

                      <?php } ?>

                 <!--  ----------  Fin Select para todas las carreras ----------   -->



<td  class="Nombre">  <?php echo $row["Nombre"]; ?> </td>
<td  class="Apellido1">  <?php echo $row["Apellido1"]; ?> </td>
<td  class="Apellido2">  <?php echo $row["Apellido2"]; ?> </td>



  <!--  ---------- Inicio obtener nombre para todas las Nivel Academico ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM nivel_academico WHERE Id_NivelAcademico = " . $row["Id_NivelAcademico"];

                 $resultNivelAcademico = mysqli_query($conn, $sql); //conexion con el sql
                 $rowNivelAcademico = mysqli_fetch_assoc($resultNivelAcademico);

                 if (!$resultNivelAcademico) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                           <td  class="Id_NivelAcademico">  <?php echo $rowNivelAcademico["Id_NivelAcademico"]."-". $rowNivelAcademico["Nombre"]; ?> </td>

                      <?php } ?>

                 <!--  ----------  Fin Select para todas las Nivel Academico ----------   -->

<td  class="Correo">  <?php echo $row["Correo"]; ?> </td>
<td  class="Celular">  <?php echo $row["Celular"]; ?> </td>
<td  class="Fecha_Nacimiento">  <?php echo $row["Fecha_Nacimiento"]; ?> </td>
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
         3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de Id Carrera y Id Nivel Acad&eacutemico.<br />
         4-Por favor utilizar el formato AAAA-MM-DD en el campo de fecha de Nacimiento.<br />
         5-Por favor utilizar el formato de ejemplo@ulatina.net para el campo de Correo.<br />
         6-No utilizar espacios o guiones en el campo de Celular.<br />
             <div>
              <button onclick="agregarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-agregar">




        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-Docente.php" method="POST">
            
              
            <div class="form-group">
            <h1 name="titulo" class="titulo"> Agregar <?php echo $titulo; ?> </h1>
            </div>
            
            <!-- Input para Id_cedula -->
            <div class="form-group">
                <a class="sub">Id c&eacutedula :</a>
                
                <input type="text" class="form-control"  name="Id_cedula"  id="Id_cedula" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Id_Docente-->
            <div class="form-group">
                <a class="sub">Id Docente:</a>
                
                <input type="text" class="form-control" name="Id_Docente" id="Id_Docente" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>







             <!-- Input para id Id_carrera -->
            
            
             <div class="form-group">
                <a class="sub">Id carrera :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las carreras ----------   -->


                  <select type="text"  class="form-control"  name="Id_Carrera"  id="Id_Carrera" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Carrera WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *

                   $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                 ?>



                            <option  >  <?php echo $row["Id_Carrera"], "-", $row["Nombre"] ?> </option>

                      <?php

                     } // fin del while

                 }

                 
                 
                 
                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las carreras ----------   -->

                
            </div>




             <!-- Input para id Nombre-->
            <div class="form-group">
                <a class="sub">Nombre:</a>
                
                <input type="text" class="form-control"  name="Nombre"  id="Nombre" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Apellido1-->
            <div class="form-group">
                <a class="sub">Primer Apellido:</a>
                
                <input type="text" class="form-control"  name="Apellido1"  id="Apellido1" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

               <!-- Input para id Apellido1-->
            <div class="form-group">
                <a class="sub">Segundo Apellido:</a>
                
                <input type="text" class="form-control"  name="Apellido2"  id="Apellido2" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>






             
             <!-- Input para id Id_NivelAcademico -->
            
            
             <div class="form-group">
                <a class="sub">Id Nivel Acad&eacutemico :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las carreras ----------   -->


                  <select type="text"  class="form-control"  name="Id_NivelAcademico"  id="Id_NivelAcademico" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM nivel_academico WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option value="<?php echo $row["Id_NivelAcademico"] ?>" >  <?php echo $row["Id_NivelAcademico"], "-", $row["Nombre"] ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las nivel_academico ----------   -->

                
            </div>





             <!-- Input para Correo-->
            <div class="form-group">
                <a class="sub">Correo:</a>
                
                <input type="text" class="form-control"  name="Correo"  id="Correo" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Celular-->
            <div class="form-group">
                <a class="sub">Celular:</a>
                
                <input type="text" class="form-control"  name="Celular"  id="Celular" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Fecha_Nacimiento-->
            <div class="form-group">
                <a class="sub">Fecha Nacimiento:</a>
                
                <input type="text" class="form-control"  name="Fecha_Nacimiento"  id="Fecha_Nacimiento" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
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
         3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de Id Carrera y Id Nivel Acad&eacutemico.<br />
         4-Por favor utilizar el formato AAAA-MM-DD en el campo de fecha de Nacimiento.<br />
         5-Por favor utilizar el formato de ejemplo@ulatina.net para el campo de Correo.<br />
         6-No utilizar espacios o guiones en el campo de Celular.<br />
             <div>
              <button onclick="editarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-editar">

         
        


        <form action="../SQLs/SQL-Docente.php" method="POST">

            


          
            <div class="form-group">
            <h1 class="titulo">Editar <?php echo $titulo; ?></h1>
            </div>
            
              <!-- Input para Id_cedula -->
            <div class="form-group">
                <a class="sub">Id c&eacutedula :</a>
                
                <input type="text" class="form-control"  name="Id_cedulae"  id="Id_cedulae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Id_Docente-->
            <div class="form-group">
                <a class="sub">Id Docente:</a>
                
                <input type="text" class="form-control" name="Id_Docentee" id="Id_Docentee" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

           <!-- Input para id Id_carrera -->
            
            
             <div class="form-group">
                <a class="sub">Id carrera :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las carreras ----------   -->


                  <select type="text"  class="form-control" name="Id_Carrerae"  id="Id_Carrerae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Carrera";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Carrera-", $row["Id_Carrera"]; ?>">  <?php echo $row["Id_Carrera"], "-", $row["Nombre"]; ?> </option>
                      
                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las carreras ----------   -->

                
            </div>


             <!-- Input para id Nombre-->
            <div class="form-group">
                <a class="sub">Nombre:</a>
                
                <input type="text" class="form-control"  name="Nombree"  id="Nombree" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Apellido1-->
            <div class="form-group">
                <a class="sub">Apellido 1:</a>
                
                <input type="text" class="form-control"  name="Apellido1e"  id="Apellido1e" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>
              <!-- Input para id Apellido1-->
            <div class="form-group">
                <a class="sub">Apellido 2:</a>
                
                <input type="text" class="form-control"  name="Apellido2e"  id="Apellido2e" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
              </div>




             <!-- Input para id Id_NivelAcademico -->
            
            
             <div class="form-group">
                <a class="sub">Id Nivel Acad&eacutemico :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las carreras ----------   -->


                  <select type="text"  class="form-control"  name="Id_NivelAcademicoe"  id="Id_NivelAcademicoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM nivel_academico";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                              <option class="<?php echo "NivelAcademico-", $row["Id_NivelAcademico"]; ?>">  <?php echo $row["Id_NivelAcademico"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las nivel_academico ----------   -->

                
            </div>





             <!-- Input para Correo-->
            <div class="form-group">
                <a class="sub">Correo:</a>
                
                <input type="text" class="form-control"  name="Correoe"  id="Correoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Celular-->
            <div class="form-group">
                <a class="sub">Celular:</a>
                
                <input type="text" class="form-control"  name="Celulare"  id="Celulare" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Fecha_Nacimiento-->
            <div class="form-group">
                <a class="sub">Fecha Nacimiento:</a>
                
                <input type="text" class="form-control"  name="Fecha_Nacimientoe"  id="Fecha_Nacimientoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
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


        <form action="../SQLs/SQL-Docente.php" method="POST">

            
            <div class="form-group">
            <h1 class="titulo">Eliminar <?php echo $titulo; ?></h1>
            </div>
            
              <!-- Input para Id_cedula -->
            <div class="form-group">
                <a class="sub">Id c&eacutedula :</a>
                
                <input type="text" class="form-control"  name="Id_cedulael"  id="Id_cedulael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Id_Docente-->
            <div class="form-group">
                <a class="sub">Id Docente:</a>
                
                <input type="text" class="form-control" name="Id_Docenteel" id="Id_Docenteel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


             <!-- Input para id Id_carrera -->
            <div class="form-group">
                <a class="sub">Id carrera :</a>
                
                <input type="text" class="form-control"  name="Id_carrerael"  id="Id_carrerael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Nombre-->
            <div class="form-group">
                <a class="sub">Nombre:</a>
                
                <input type="text" class="form-control"  name="Nombreel"  id="Nombreel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Apellido1-->
            <div class="form-group">
                <a class="sub">Apellido 1:</a>
                
                <input type="text" class="form-control"  name="Apellido1el"  id="Apellido1el" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>
              <!-- Input para id Apellido1-->
            <div class="form-group">
                <a class="sub">Apellido 2:</a>
                
                <input type="text" class="form-control"  name="Apellido2el"  id="Apellido2el" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
             </div>
             <!-- Input para Nivel_Academico-->
            <div class="form-group">
                <a class="sub">Nivel Acad&eacutemico:</a>
                
                <input type="text" class="form-control"  name="Nivel_Academicoel"  id="Nivel_Academicoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para Correo-->
            <div class="form-group">
                <a class="sub">Correo:</a>
                
                <input type="text" class="form-control"  name="Correoel"  id="Correoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Celular-->
            <div class="form-group">
                <a class="sub">Celular:</a>
                
                <input type="text" class="form-control"  name="Celularel"  id="Celularel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>

             <!-- Input para id Fecha_Nacimiento-->
            <div class="form-group">
                <a class="sub">Fecha Nacimiento:</a>
                
                <input type="text" class="form-control"  name="Fecha_Nacimientoel"  id="Fecha_Nacimientoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
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

   

    
 
  <script src="../JavaScripts/JavaScript-Docente.js"></script>

    

 

</body>






</html>
