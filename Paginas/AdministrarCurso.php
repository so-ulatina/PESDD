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
    $titulo = "Curso";
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

               
                
                 <form action="../SQLs/SQL-Curso.php" class="filtros" method="POST" >
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
             <th>Id Curso</th>
          <th>Nombre</th>
          <th>Horas</th>
          <th>Id Categor&iacutea</th>
          <th>Id Modalidad</th>
              <th>Id certificado</th>
              <th>Id administrador</th>
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

              $sql = "SELECT * FROM Curso ";    // Si no hay un sql nuevo para buscar , entonces select *
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
           
               
<td  class="Id_Curso">  <?php echo $row["Id_Curso"]; ?> </td>  
<td  class="Nombre">  <?php echo $row["Nombre"]; ?> </td>
<td  class="Horas">  <?php echo $row["Horas"]; ?> </td>


<!--  ---------- Inicio obtener nombre para todas las categorias ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM categoria WHERE Id_categoria = " . $row["Id_Categoria"];

                 $resultcategoria = mysqli_query($conn, $sql); //conexion con el sql
                 $rowCategoria = mysqli_fetch_assoc($resultcategoria);

                 if (!$resultcategoria) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                           <td  class="Id_Categoria">  <?php echo $rowCategoria["Id_categoria"]."-". $rowCategoria["Nombre"]; ?> </td>

                      <?php } ?>

                 <!--  ----------  Fin Select para todas las categorias ----------   -->


<!--  ---------- Inicio obtener nombre para todas las modalidad ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM modalidad WHERE Id_modalidad  = " . $row["Id_Modalidad"];

                 $resultmodalidad = mysqli_query($conn, $sql); //conexion con el sql
                 $rowModalidad = mysqli_fetch_assoc($resultmodalidad);

                 if (!$resultmodalidad) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                          <td  class="Id_Modalidad">  <?php echo $rowModalidad["Id_modalidad"]."-". $rowModalidad["Descripcion"]; ?> </td>

                      <?php } ?>

                 <!--  ----------  Fin Select para todas las modalidad ----------   -->


<!--  ---------- Inicio obtener nombre para todas las certificado ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM certificado WHERE Id_certificado  = " . $row["Id_certificado"];

                 $resultCertificado = mysqli_query($conn, $sql); //conexion con el sql
                 $rowCertificado = mysqli_fetch_assoc($resultCertificado);

                 if (!$resultCertificado) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                         <td  class="Id_certificado">  <?php echo $rowCertificado["Id_certificado"]."-". $rowCertificado["Nombre"]; ?> </td>

                      <?php } ?>

<!--  ----------  Fin Select para todas las certificado ----------   -->



<!--  ---------- Inicio obtener nombre para todas las certificado ----------   -->

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM administrador WHERE Id_administrador  = " . $row["Id_administrador"];

                 $resultAdministrador = mysqli_query($conn, $sql); //conexion con el sql
                 $rowAdministrador = mysqli_fetch_assoc($resultAdministrador);

                 if (!$resultAdministrador) {
                     die("Consulta a la base de datos fallo");
                 } else {

                     ?>

                        <td  class="Id_administrador">  <?php echo $rowAdministrador["Id_administrador"]."-". $rowAdministrador["Nombre"]; ?> </td>

                      <?php } ?>

<!--  ----------  Fin Select para todas las certificado ----------   -->




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
                      3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de ID Categor&iacutea,Id Modalidad,Id Certificado y ID Administrador <br />
             <div>
              <button onclick="agregarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-agregar">




        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-Curso.php" method="POST">
            
              
            <div class="form-group">
            <h1 name="titulo" class="titulo"> Agregar <?php echo $titulo; ?> </h1>
            </div>
            
            <!-- Input para id Curso-->
            <div class="form-group">
                <a class="sub">Id Curso:</a>
                
                <input type="text" class="form-control"  name="Id_Curso"  id="Id_Curso" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre-->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombre" id="Nombre" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

             <!-- Input para Horas-->
            <div class="form-group">
                <a class="sub">Horas :</a>
                
                <input type="text" class="form-control" name="Horas" id="Horas" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            
             <!-- Input para id categoria -->
            
            
             <div class="form-group">
                <a class="sub">Id categor&iacutea :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las categorias ----------   -->


                  <select type="text"  class="form-control"  name="Id_Categoria"  id="Id_Categoria" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Categoria WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option >  <?php echo $row["Id_categoria"], "-", $row["Nombre"], "-", $row["Horas_duracion_desde"], "-", $row["Horas_duracion_hasta"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las categorias ----------   -->

                
            </div>




             <!-- Input para id Modalidad -->
            
            
             <div class="form-group">
                <a class="sub">Id Modalidad:</a>
            
                 
                 <!--  ---------- Inicio Select para todas las Modalidad ----------   -->


                  <select type="text"  class="form-control"  name="Id_Modalidad"  id="Id_Modalidad" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM modalidad WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option >  <?php echo $row["Id_modalidad"], "-", $row["Descripcion"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las categorias ----------   -->

                
            </div>





             <!-- Input para id Id_certificado -->
            
            
             <div class="form-group">
                <a class="sub">Id Certificado:</a>
            
                 
                 <!--  ---------- Inicio Select para todas los certificados ----------   -->


                  <select type="text"  class="form-control"  name="Id_certificado"  id="Id_certificado" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Certificado WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option >  <?php echo $row["Id_certificado"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Certificados ----------   -->

                
            </div>



            
             <!-- Input para id ID Administrador -->
            
            
             <div class="form-group">
                <a class="sub">Id Administrador:</a>
            
                 
                 <!--  ---------- Inicio Select para todas los Administrador ----------   -->


                  <select type="text"  class="form-control"  name="Id_administrador"  id="Id_administrador" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Administrador WHERE Estado = 'Activo'";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option >  <?php echo  $row["Id_administrador"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Certificados ----------   -->

                
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
                      3-Por favor utilizar solamente las opciones que aparecen en la lista de opciones de ID Categor&iacutea,Id Modalidad,Id Certificado y ID Administrador <br />
             <div>
              <button onclick="editarCerrar()" class="boton-cerrar"> Cerrar</button>  
             </div>

	     </div>




         
         <!-- ----------------- Fin Instrucciones --------------------- -->

               <div class="popup-editar">

         
        


        <form action="../SQLs/SQL-Curso.php" method="POST">

            


          
            <div class="form-group">
            <h1 class="titulo">Editar <?php echo $titulo; ?></h1>
            </div>
            
            <!-- Input para id Curso-->
            <div class="form-group">
                <a class="sub">Id Curso:</a>
                
                <input type="text" class="form-control"  name="Id_Cursoe"  id="Id_Cursoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre-->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombree" id="Nombree" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

           

            <!-- Input para Horas-->
            <div class="form-group">
                <a class="sub">Horas :</a>
                
                <input type="text" class="form-control" name="Horase" id="Horase" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>


               <!-- Input para id categoria -->
            
            
             <div class="form-group">
                <a class="sub">Id categor&iacutea :</a>
            
                 
                 <!--  ---------- Inicio Select para todas las categorias ----------   -->


                  <select type="text"  class="form-control"  name="Id_Categoriae"  id="Id_Categoriae" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Categoria";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Categoria-", $row["Id_categoria"];?>">  <?php echo $row["Id_categoria"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las categorias ----------   -->

                
            </div>




             <!-- Input para id Modalidad -->
            
            
             <div class="form-group">
                <a class="sub">Id Modalidad:</a>
            
                 
                 <!--  ---------- Inicio Select para todas las Modalidad ----------   -->


                  <select type="text"  class="form-control"  name="Id_Modalidade"  id="Id_Modalidade" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM modalidad";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Modalidad-",$row["Id_modalidad"];?>">  <?php echo $row["Id_modalidad"], "-", $row["Descripcion"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las categorias ----------   -->

                
            </div>





             <!-- Input para id Id_certificado -->
            
            
             <div class="form-group">
                <a class="sub">Id Certificado:</a>
            
                 
                 <!--  ---------- Inicio Select para todas los certificados ----------   -->


                  <select type="text"  class="form-control"  name="Id_certificadoe"  id="Id_certificadoe" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Certificado";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Certificado-", $row["Id_certificado"];?>" >  <?php echo $row["Id_certificado"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Certificados ----------   -->

                
            </div>



            
             <!-- Input para id ID Administrador -->
            
            
             <div class="form-group">
                <a class="sub">Id Administrador:</a>
            
                 
                 <!--  ---------- Inicio Select para todas los Administrador ----------   -->


                  <select type="text"  class="form-control"  name="Id_administradore"  id="Id_administradore" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required>

                 <?php

                 require_once "../ConexionBaseDatos/Conexion.php";


                 $sql = "SELECT * FROM Administrador";    // Si no hay un sql nuevo para buscar , entonces select *
                 
                 $result = mysqli_query($conn, $sql); //conexion con el sql
                 
                 if (!$result) {
                     die("Consulta a la base de datos fallo");
                 } else {


                     while ($row = mysqli_fetch_assoc($result)) {   // recorrer cada linea agregandola a la tabla
                         ?>



                            <option class="<?php echo "Administrador-", $row["Id_administrador"], "-", $row["Nombre"]; ?>">  <?php echo  $row["Id_administrador"], "-", $row["Nombre"]; ?> </option>

                      <?php

                     } // fin del while
                 
                 }




                 ?>


                  </select>

                 <!--  ----------  Fin Select para todas las Certificados ----------   -->

                
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
                 <button  class="boton-editar" type="submit" name="submited" value="Actualizar" > Actualizar</button>
                </div>

        </form>
                   
        
        




    </div>
                
                
              
      


     </div>





      <!--  ----------------------- Fin popup Editar ----------------------- -->
        






          <!--  ----------------------- Inicio popup Eliminar ----------------------- -->


     <div class="popup-container-eliminar">


               <div class="popup-eliminar">

         
        <!-- Creacion de form principal en HTML-->


        <form action="../SQLs/SQL-Curso.php" method="POST">

            
            <div class="form-group">
            <h1 class="titulo">Eliminar <?php echo $titulo; ?></h1>
            </div>
            
           
            <!-- Input para id Curso-->
            <div class="form-group">
                <a class="sub">Id Curso:</a>
                
                <input type="text" class="form-control"  name="Id_Cursoel"  id="Id_Cursoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required/>
                
            </div>


            <!-- Input para Nombre-->
            <div class="form-group">
                <a class="sub">Nombre :</a>
                
                <input type="text" class="form-control" name="Nombreel" id="Nombreel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>
            <!-- Input para Horas-->
            <div class="form-group">
                <a class="sub">Horas :</a>
                
                <input type="text" class="form-control" name="Horasel" id="Horasel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            
            <!-- Input para Id_Categoria-->
            <div class="form-group">
                <a class="sub">Id Categor&iacutea :</a>
                
                <input type="text" class="form-control" name="Id_Categoriael" id="Id_Categoriael" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

             <!-- Input para Id_Modalidad-->
            <div class="form-group">
                <a class="sub">Id Modalidad :</a>
                
                <input type="text" class="form-control" name="Id_Modalidadel" id="Id_Modalidadel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>

            <!-- Input para Id_Modalidad-->
            <div class="form-group">
                <a class="sub">Id certificado :</a>
                
                <input type="text" class="form-control" name="Id_certificadoel" id="Id_certificadoel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
            </div>
           

            <!-- Input para Id_Modalidad-->
            <div class="form-group">
                <a class="sub">Id administrador :</a>
                
                <input type="text" class="form-control" name="Id_administradorel" id="Id_administradorel" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('*Este campo no puede estar vacio*')" required />
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

   

    
 
  <script src="../JavaScripts/JavaScript-Curso.js"></script>

    

 

</body>






</html>

