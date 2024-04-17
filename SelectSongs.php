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
        $sql2 = "SELECT id, name, image_path, song_path, artist FROM songs";
        $resultado2 = $pdo->query($sql2);

        while ($fila2 = $resultado2->fetch(PDO::FETCH_ASSOC)) {
            $nombreSong = $fila2['name'];
            $artist = $fila2['artist'];
            $imagenSong = $fila2['image_path'];
            $pathSong = $fila2['song_path'];
            $idSong = $fila2['id'];
        
            // Generar el HTML para la cancion
            echo '<div class="explore-item" data-id="' . $idSong . '" data-song-path="' . $pathSong . '" data-artist="' . $artist . '" onclick="reproducirCancion(this)">';
            echo '<img src="' . $imagenSong . '" alt="Song cover">';
            echo '<p>' . $nombreSong . '</p>';
            echo '</div>';
        }
    }
}
?>