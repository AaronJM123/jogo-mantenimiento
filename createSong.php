<?php 
session_start();
$nombreCancion = $_POST['nombreCancion'];
$artista = $_POST['artista'];
$duracion = $_POST['duracion'];

include 'conexion.php';

if((!isset($_SESSION['email'])) and (!isset($_SESSION['fecha_login']))
and (!isset($_SESSION['username'])) and (!isset($_SESSION['id_sesion']))){
    $data = "No se a iniciado sesion correctamente, vuelva a hacerlo e intentelo de nuevo";
	Autentificacion($data);
}

$sql = "SELECT id FROM users WHERE email = '".$_SESSION['email']."'";
$resultado = $pdo->query($sql);


if ($resultado->rowCount() < 1) {
	$data = "No se a podido enlazar su cuenta a los usuarios registrados en la paltaforma, 
    inicie sesion nuevamente e intentelo de nuevo";
	Autentificacion($data);
} else{
    $fila = $resultado->fetch(PDO::FETCH_ASSOC);
    $userId = $fila['id'];

	//ALMACENAJE DE LA IMAGEN EN EL SERVIDOR
	$targetDirectory = "C:/xampp/htdocs/jogoImages/"; // Carpeta donde quieres almacenar las imágenes
	$originalFileName = $_FILES["imagen"]["name"]; // Nombre original de la imagen de la cancion
	$extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener extensión del archivo

	// Generar un nuevo nombre de archivo con la misma extensión y algo más agregado
	$newFileNameImage = $originalFileName . "_song_" . uniqid() . "." . $extension;
	$targetFileImage = $targetDirectory . $newFileNameImage; // Ruta completa del archivo destino

	// Intentar mover el archivo cargado al destino con el nuevo nombre
	if (!(move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFileImage))) {
		$data = "Lo sentimos, hay un problema al subir la imagen de la cancion";
		Autentificacion($data);
	}

	//AlMACENAJE DE LA CANCION EN EL SERVIDOR
	$targetDirectory = "C:/xampp/htdocs/jogoSongs/"; // Carpeta donde quieres almacenar las imágenes
	$originalFileName = $_FILES["audio"]["name"]; // Nombre original de la cancion
	$extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener extensión del archivo

	// Generar un nuevo nombre de archivo con la misma extensión y algo más agregado
	$newFileNameSong = $originalFileName . "__" . uniqid() . "." . $extension;
	$targetFileSong = $targetDirectory . $newFileNameSong; // Ruta completa del archivo destino

	// Intentar mover el archivo cargado al destino con el nuevo nombre
	if (!(move_uploaded_file($_FILES["audio"]["tmp_name"], $targetFileSong))) {
		$data = "Lo sentimos, hay un problema al subir la cancion";
		Autentificacion($data);
	}

	$newFileNameImage = "../jogoImages/".$newFileNameImage;
	$newFileNameSong = "../jogoSongs/".$newFileNameSong;

    $sql3 = "INSERT INTO songs (name, artist, duration, user_id, image_path, song_path) 
		VALUES ('".$nombreCancion."','".$artista."','".$duracion."','".$userId."','".$newFileNameImage."','".$newFileNameSong."')";
    $resultado3 = $pdo->query($sql3);

	$data = "Bienvenido";
    Autentificacion($data);
}

function Autentificacion($data){
	echo $data;
	exit();
}

?>