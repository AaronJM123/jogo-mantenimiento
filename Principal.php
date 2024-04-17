<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>jOGO</title>
  <link rel="stylesheet" href="PrincipalStyle.css">
</head> 
<body>
  <?php session_start(); 
  include 'Restriccion.php'?>
  <div class="app-container">
    <div class="header">
      <div class="search-bar">
        <input type="text" placeholder="¿Qué quieres reproducir?">
        <button class="search-button">Buscar</button>
      </div>
      <div class="profile">
        <?php include 'ProfileImage.php'?>
        <a id="btn_logout" href="logout.php" class="logout"><img src="logout.png" alt="logout"></a>
      </div>
    </div>
    <div class="content">
      <div class="explore-section">
        <div class="tab-bar">
          <div class="tab-group">
            <div class="tab activo" data-opcion="album-list" onclick="mostrarContenido('album-list')">Albumes</div>
            <div class="tab" data-opcion="songs-list" onclick="mostrarContenido('songs-list')">Canciones</div>
          </div>
          <div class="tab-group">
            <button class="explore-section-btn" onclick="mostrarFormulario()">+</button>
            <button id="btn-borrar" class="explore-section-btn" onclick="toggleBorrar()">-</button>
          </div>
        </div>
        
        <dialog id="formulario-dialog">
          <div class="close-button" onclick="closeMenu()">X</div>
          <div id="cancion-formulario" class="formulario" style="display:none;">
            <h2>Subir Canción</h2>
            <form id="upload-song-form" onsubmit="enviarCancion(event)">
              <label for="song-nombre">Nombre:</label>
              <input type="text" id="song-nombre" name="song-nombre" required><br>
        
              <label for="artista">Artista:</label>
              <input type="text" id="song-artista" name="song-artista" required><br>
        
              <label for="imagen">Imagen de portada:</label>
              <input type="file" id="song-imagen" name="song-imagen" accept="image/*" required><br>

              <label for="song-audio">Archivo MP3:</label>
              <input type="file" id="song-audio" name="song-audio" accept="audio/mpeg" required><br>

              <button type="submit">Subir Canción</button>
            </form>
          </div>
        
          <div id="album-formulario" class="formulario" style="display:none;">
            <h2>Subir Álbum</h2>
            <form id="upload-album-form" onsubmit="enviarAlbum(event)">
              <label for="album-nombre">Nombre:</label>
              <input type="text" id="album-nombre" name="album-nombre" required><br>
        
              <label for="imagen">Imagen de portada:</label>
              <input type="file" id="album-imagen" name="album-imagen" accept="image/*" required><br>
        
              <button type="submit">Subir Álbum</button>
            </form>
          </div>
        </dialog>
        <div id="album-list" class="contenido">
          <?php include 'SelectAlbumes.php'; ?>
        </div>
        <div id="songs-list" class="contenido" style="display: none;">
          <?php include 'SelectSongs.php'; ?>
        </div>
      </div>
      <div class="song-section" style="display: none;">
        <div class="song-info">
          <img src="" alt="Song cover">
          <div class="song-details">
            <h2></h2>
            <p></p>
          </div>
        </div>
        <div class="song-progress">
          <div class="progress-bar-container">
            <input type="range" class="progress-bar" min="0" max="100" value="0">
          </div>
          <span id="current-time">0:00</span>
        </div>
        <div class="song-controls">
          <button class="prev-button">
            <img src="previous.png" alt="Previous">
          </button>
          <button id="play-pause-button" onclick="togglePlayPause()">
            <img id="play-pause-img" src="play.png" alt="Play">
          </button>
          <button class="next-button">
            <img src="next.png" alt="Next">
          </button>
          <audio id="audio" src=""></audio>
        </div>
      </div>
    </div>
  </div>
  <script type="Text/Javascript" src="PrincipalScript.js"></script>
</body>
</html>
