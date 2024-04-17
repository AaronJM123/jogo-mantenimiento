<?php
session_start();
include 'conexion.php';

$id = $_POST['id'];
$tabla = $_POST['tabla'];

$sql = "SELECT id FROM users WHERE email = '".$_SESSION['email']."' AND username = '".$_SESSION['username']."'";
$resultado = $pdo->query($sql);
$fila = $resultado->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT id FROM $tabla WHERE id = '".$id."' AND user_id = '".$fila['id']."'";
$resultado2 = $pdo->query($sql2);

if ($resultado->rowCount() < 1) {
	$data = "Se a iniciado sesion mal, inicie sesion nuevamente";
	Autentificacion($data);
}
if ($resultado2->rowCount() < 1) {
	$data = "No puede borrar una cancion o album creado por otros usuarios";
	Autentificacion($data);
}
else{
    $sql3 = "DELETE FROM $tabla WHERE id = '".$id."' AND user_id = '".$fila['id']."'";
    $pdo->query($sql3);
	$data = "Bienvenido";
	Autentificacion($data);
}

function Autentificacion($data){
	echo $data;
	exit();
}
?>