<?php

$email = $_POST['email'];
$pass = md5($_POST['password']); 

include 'conexion.php';

$sql = "SELECT email FROM users WHERE email = '".$email."'";
$resultado = $pdo->query($sql);
$sql2 = "SELECT pass FROM users WHERE pass = '".$pass."' AND email = '".$email."'";
$resultado2 = $pdo->query($sql2);

if ($resultado->rowCount() < 1) {
	$data = "No existe un usuario con ese email";
	Autentificacion($data);
}
if ($resultado2->rowCount() < 1) {
	$data = "La contraseña que se a puesto es incorrecta";
	Autentificacion($data);
}
else{
	$data = "Bienvenido";
    include 'CreateSesion.php';
	Autentificacion($data);
}

function Autentificacion($data){
	echo $data;
	exit();
}
?>