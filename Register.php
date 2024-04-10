<?php
$username = $_POST['username'];
$email = $_POST['email'];
$pass = md5($_POST['password']);
$dob = $_POST['dob'];

include 'conexion.php';

$sql = "SELECT email FROM users WHERE email = '".$email."'";
$resultado = $pdo->query($sql);
$sql2 = "SELECT username FROM users WHERE username = '".$username."'";
$resultado2 = $pdo->query($sql2);

if ($resultado->rowCount() > 0) {
	$data = "Ya existe un usuario con ese email";
	Autentificacion($data);
}
if ($resultado2->rowCount() > 0) {
	$data = "Ya existe un usuario con ese nombre de usuario";
	Autentificacion($data);
}
else{
	$targetDirectory = "C:/xampp/htdocs/jogoImages/"; // Carpeta donde quieres almacenar las imágenes
	$originalFileName = $_FILES["profile-pic"]["name"]; // Nombre original de la imagen de perfil
	$extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener extensión del archivo

	// Generar un nuevo nombre de archivo con la misma extensión y algo más agregado
	$newFileName = $originalFileName . "_user_" . uniqid() . "." . $extension;
	$targetFile = $targetDirectory . $newFileName; // Ruta completa del archivo destino

	// Intentar mover el archivo cargado al destino con el nuevo nombre
	if (!(move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $targetFile))) {
		$data = "Lo sentimos, hay un problema al subir la imagen de perfil";
		Autentificacion($data);
	}

	$newFileName = "../jogoImages/".$newFileName;
    $sql3 = "INSERT INTO users (username, email, pass, date_of_birth, profile_picture) 
		VALUES ('".$username."','".$email."','".$pass."','".$dob."','".$newFileName."')";
	$resultado3 = $pdo->query($sql3);

	$data = "Bienvenido";
	Autentificacion($data);
}

function Autentificacion($data){
	echo $data;
	exit();
}

?>