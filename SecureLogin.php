<?php
session_start();
if(!$_SESSION['Correo']){header('Location: ../Paginas/Login.php');}
