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
    $titulo = "Cursos Matriculados por Docente";
    $_SESSION["Categoria"] = $titulo;
        
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
                  
                    <li class="titulo"> <h2> <?php echo $titulo; ?> </h2></li>
                    

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


            
               <form action="../SQLs/SQL-ReporteCursosDocente.php" class="filtrosreportes" method="POST" >
                 <div class="filtrar-undo-iconos">
                     <button  type="submit" name="submitf" ><span class="material-symbols-outlined">search</span></button>
                     <button  type="submit" name="submitundo" ><span class="material-symbols-outlined">undo</span></button>
                     </div>   
                    
                    <div class="agregar-exportar-iconos">
                     <a href="../Exportar.php"> <span class="material-symbols-outlined">ios_share </span></a>
                        <a href="../ExportarCarta.php"> <span class="material-symbols-outlined">mail</span></a>
                    </div>
                 
                 <div class="filtrar1reportes">
                           <p> Facultad: </p>
                       <input type="text" name="findFacultad" />
                        
                     </div>

                    <div class="filtrar1reportes">
                           <p>Carrera: </p>
                       <input type="text" name="findCarrera" />
                        
                     </div>
                     <div class="filtrar1reportes">
                           <p> Docente: </p>
                       <input type="text" name="findDocente" />
                        
                     </div>

                    <div class="filtrar1reportes">
                           <p> C&eacutedula: </p>
                       <input type="text" name="findCedula" />
                        
                     </div>
                     <div class="filtrar1reportes">
                           <p>Correo: </p>
                       <input type="text" name="findCorreo" />
                        
                     </div>

                    <div class="filtrar1reportes">
                           <p>Sede: </p>
                       <input type="text" name="findSede" />
                        
                     </div>
                     <div class="filtrar1reportes">
                           <p>Periodo: </p>
                       <input type="text" name="findPeriodo" />
                        
                     </div>

                    <div class="filtrar1reportes">
                           <p>A&ntildeo: </p>
                       <input type="text" name="findAno" />
                        
                     </div>
                      
                      <div class="filtrar1reportes">
                           <p>Curso: </p>
                       <input type="text" name="findCurso" />
                        
                     </div>
                     
                    <div class="filtrar1reportes">
                           <p>Modalidad: </p>
                       <input type="text" name="findModalidad" />
                        
                     </div>

                 <div class="filtrar1reportes">
                           <p>Certificado: </p>
                       <input type="text" name="findCertificado" />
                        
                     </div>
                 <div class="filtrar1reportes">
                           <p>Estado: </p>
                       <input type="text" name="findEstado" />
                        
                     </div>

                 
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
                
                
      <div class="tbl-scroll">         
   
   <table id="tabla" class = "table" cellspacing="0">
      <thead>
          <tr>
            
<th>Facultad</th>  
<th>Carrera</th>
<th>Docente</th>
<th>C&eacutedula</th>
<th>Correo</th>
<th>Sede</th>
<th>Periodo</th>
<th>A&ntildeo</th>
<th>Curso</th>
<th>Modalidad</th>
<th>Certificado</th>
<th>Nota</th>
<th>Estado</th>


         </tr>

      </thead>
       
       
       <tbody>

          <?php
              
               require_once "../ConexionBaseDatos/Conexion.php";

          
               // Inicio Validar si hay un sql nuevo para buscar

               if($_SESSION['sql1']){
              $sql = $_SESSION['sql1'];
           
               }else {

              $sql = "SELECT fac.Nombre , ca.Nombre , doc.Nombre,doc.Apellido1,doc.Apellido2, doc.Id_cedula,doc.Correo,sed.Nombre ,cua.Periodo ,cua.Ano , cu.Nombre , modal.Descripcion,cert.Nombre , cm.Nota , cm.Estado,cu.Id_Curso,cua.ano,cu.Horas FROM 
                       cursos_matriculados as cm INNER JOIN curso as cu ON cm.Id_curso  = cu.Id_Curso 
            INNER JOIN docente as doc ON cm.Id_cedula = doc.Id_cedula 
            INNER JOIN cuatrimestre as cua ON cm.Id_cuatrimestre = cua.Id_Cuatrimestre 
            INNER JOIN carrera as ca ON doc.Id_carrera = ca.Id_carrera
            INNER JOIN sede as sed on sed.Id_sede = ca.Id_sede
            INNER JOIN facultad as fac on fac.Id_Facultad =ca.Id_Facultad
            INNER JOIN modalidad as modal on modal.Id_modalidad = cu.Id_Modalidad
            INNER JOIN certificado as cert on cert.Id_certificado = cu.Id_certificado;";    // Si no hay un sql nuevo para buscar , entonces select *
              $_SESSION['sql2'] = $sql;

               }

          // Fin Validar si hay un sql nuevo para buscar
          require_once "../ConexionBaseDatos/Conexion.php";

               $result = mysqli_query($conn, $sql); //conexion con el sql
             
               if (!$result) {
                   die("Consulta a la base de datos fallo");  
               } else {
                   
                  
                   while ($row = $result->fetch_row()) {   // recorrer cada linea agregandola a la tabla
                
                  ?>

          
          <tr id = "row1">   
               
<td  >  <?php echo $row[0]; ?> </td>  
<td  >  <?php echo $row[1]; ?> </td>
<td  >  <?php echo $row[2]," ",$row[3]," ",$row[4]; ?> </td>
<td  >  <?php echo $row[5]; ?> </td>
<td  >  <?php echo $row[6];; ?> </td>
<td  >  <?php echo $row[7]; ?> </td>
<td  >  <?php echo $row[8]; ?> </td>
<td  >  <?php echo $row[9]; ?> </td>
<td  >  <?php echo $row[10]; ?> </td>
<td  >  <?php echo $row[11]; ?> </td>
<td  >  <?php echo $row[12]; ?> </td>
<td  >  <?php echo $row[13]; ?> </td>
<td  >  <?php echo $row[14]; ?> </td>
      
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

    </div> <!-- Fin div Container-->


     <div class="separator">

</div>
   

    <footer>

</footer>


</body>






</html>

