<?php
session_start();
session_destroy();
header('Location: ../Paginas/Login.php');

