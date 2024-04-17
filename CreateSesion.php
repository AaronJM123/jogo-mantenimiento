<?php
session_start();
$_SESSION['email'] = $email;
$_SESSION['inicio_sesion'] = (!isset($_SESSION['inicio_sesion'])) ? time() : $_SESSION['inicio_sesion'];
define("TimeDifference", 3600);/*Constante que define el tiempo de diferencia entre zona horaria con la que se 
                                define time() y nuestra zona horaria*/
$_SESSION['fecha_login'] = date("Y-m-d H:i:s", $_SESSION['inicio_sesion']-TimeDifference);

include 'conexion.php';

$sql = "INSERT INTO Sesiones_iniciadas (email, fecha_login) 
		VALUES ('".$_SESSION['email']."','".$_SESSION['fecha_login']."')";
$pdo->query($sql);

$sql2 = "SELECT id FROM Sesiones_iniciadas WHERE email = '".$_SESSION['email']."' 
    AND fecha_login = '".$_SESSION['fecha_login']."'";
$resultado = $pdo->query($sql2);
$fila = $resultado->fetch(PDO::FETCH_ASSOC);

$sql3 = "SELECT username FROM users WHERE email = '".$_SESSION['email']."'";
$resultado2 = $pdo->query($sql3);
$fila2 = $resultado2->fetch(PDO::FETCH_ASSOC);

$_SESSION['username'] = $fila2['username'];
$_SESSION['id_sesion'] = $fila['id'];
?>