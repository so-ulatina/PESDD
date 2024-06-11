<?php
session_start();
if(!$_SESSION['Correo']){header('Location: Login.php');}
