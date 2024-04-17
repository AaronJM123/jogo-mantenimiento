<?php
session_start(); 
session_unset();
session_destroy();

//cerramos la conexion PDO a la bd y redirigimos al login y register
header("Location: LyR.php"); 