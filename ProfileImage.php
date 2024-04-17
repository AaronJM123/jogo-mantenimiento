<?php 
include 'conexion.php';

$sql = "SELECT profile_picture FROM users WHERE email = '".$_SESSION['email']."' AND username = '".$_SESSION['username']."'";
$resultado = $pdo->query($sql);
$fila = $resultado->fetch(PDO::FETCH_ASSOC);

if ($resultado->rowCount() < 1) {
	echo '<h6 style="color: red;">"Error al cargar <br> imagen de perfil</h6>'; 
    } else{
            // Generar el HTML 
            echo '<img src="' . $fila['profile_picture'] . '" alt="User profile">';
            echo '<p>' . $_SESSION['username'] . '</p>';
    }
?>