<?php 
session_start();
$nombreAlbum = $_POST['nombreAlbum'];

include 'conexion.php';

if((!isset($_SESSION['email'])) and (!isset($_SESSION['fecha_login'])) and (!isset($_SESSION['username']))
and (!isset($_SESSION['id_sesion']))){
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
    $originalFileName = $_FILES["imagen"]["name"]; // Nombre original de la imagen del album
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener extensión del archivo

    // Generar un nuevo nombre de archivo con la misma extensión y algo más agregado
    $newFileName = $originalFileName . "_album_" . uniqid() . "." . $extension;
    $targetFileImage = $targetDirectory . $newFileName; // Ruta completa del archivo destino

    // Intentar mover el archivo cargado al destino con el nuevo nombre
    if (!(move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFileImage))) {
	    $data = "Lo sentimos, hay un problema al subir la imagen del album";
	    Autentificacion($data);
    }

    $newFileName = "../jogoImages/".$newFileName;

    $sql3 = "INSERT INTO albums (name, user_id, image_path) 
		VALUES ('".$nombreAlbum."','".$userId."','".$newFileName."')";
    $resultado3 = $pdo->query($sql3);

    $data = "Bienvenido";
    Autentificacion($data);
}

function Autentificacion($data){
	echo $data;
	exit();
}

?>