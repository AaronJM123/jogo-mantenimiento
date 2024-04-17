<?php 
include 'conexion.php';

if((!isset($_SESSION['email'])) and (!isset($_SESSION['fecha_login'])) and (!isset($_SESSION['username']))
 and (!isset($_SESSION['id_sesion']))){
    echo '<h1 style="color: red;">No se a iniciado sesion correctamente, vuelva a hacerlo e intentelo de nuevo</h1>';
} else{
    $sql = "SELECT id FROM users WHERE email = '".$_SESSION['email']."' AND username = '".$_SESSION['username']."'";
    $resultado = $pdo->query($sql);

    if ($resultado->rowCount() < 1) {
	echo '<h1 style="color: red;">"No se a podido enlazar su cuenta a los usuarios registrados en la paltaforma, 
    inicie sesion nuevamente e intentelo de nuevo";</h1>'; 
    } else{
        $sql2 = "SELECT id, name, image_path FROM albums";
        $resultado2 = $pdo->query($sql2);

        while ($fila2 = $resultado2->fetch(PDO::FETCH_ASSOC)) {
            $nombreAlbum = $fila2['name'];
            $imagenAlbum = $fila2['image_path'];
            $idAlbum = $fila2['id'];

            // Generar el HTML para el álbum
            echo '<div class="explore-item" data-id="' . $idAlbum . '">';
            echo '<img src="' . $imagenAlbum . '" alt="Album cover">';
            echo '<p>' . $nombreAlbum . '</p>';
            echo '</div>';
        }
    }
}
?>