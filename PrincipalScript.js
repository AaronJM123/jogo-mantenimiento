// Seleccionamos elementos relevantes
const audio = document.getElementById('audio');
const playPauseButton = document.getElementById('play-pause-button');
const playPauseImg = document.getElementById('play-pause-img');
const currentTimeSpan = document.getElementById('current-time');
const progressBar = document.querySelector('.progress-bar');
let borrarActivo = false;

// Función para alternar entre reproducción y pausa
function togglePlayPause() {
  if (audio.paused) {
    audio.play();
    playPauseImg.src = 'pause.png';
  } else {
    audio.pause();
    playPauseImg.src = 'play.png';
  }
}

// Actualizar el tiempo de reproducción y la barra de progreso
audio.addEventListener('timeupdate', function() {
  let currentMinutes = Math.floor(audio.currentTime / 60);
  let currentSeconds = Math.floor(audio.currentTime - currentMinutes * 60);
  if (currentSeconds < 10) {
    currentSeconds = '0' + currentSeconds;
  }
  currentTimeSpan.textContent = currentMinutes + ':' + currentSeconds;

  // Calculamos el porcentaje de la canción completada
  let progress = (audio.currentTime / audio.duration) * 100;
  progressBar.value = progress;
});

// Cambiar la posición de reproducción cuando se mueve la barra de progreso
progressBar.addEventListener('input', function() {
  let newPosition = audio.duration * (progressBar.value / 100);
  audio.currentTime = newPosition;
});

function mostrarContenido(opcion) {
  var tabs = document.querySelectorAll('.tab');

  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove('activo');
  }

  var contenido = document.querySelectorAll('.contenido');
  for (var i = 0; i < contenido.length; i++) {
    contenido[i].style.display = 'none';
  }

  var tabSeleccionado = document.querySelector(`.tab[data-opcion="${opcion}"]`);
  tabSeleccionado.classList.add('activo');

  var contenidoSeleccionado = document.getElementById(opcion);
  contenidoSeleccionado.style.display = 'flex';
}

function closeMenu() {
  const dialog = document.getElementById('formulario-dialog');
  dialog.close();
}

function mostrarFormulario() {
  var formularioDialog = document.getElementById('formulario-dialog');
  var cancionFormulario = document.getElementById('cancion-formulario');
  var albumFormulario = document.getElementById('album-formulario');
  
  var tabs = document.querySelectorAll('.tab');
  var cancionTab = document.querySelector('.tab[data-opcion="songs-list"]');
  var albumTab = document.querySelector('.tab[data-opcion="album-list"]');
  
  for (var i = 0; i < tabs.length; i++) {
    if (tabs[i].classList.contains('activo')) {
      if (tabs[i] === cancionTab) {
        cancionFormulario.style.display = 'block';
        albumFormulario.style.display = 'none';
      } else if (tabs[i] === albumTab) {
        cancionFormulario.style.display = 'none';
        albumFormulario.style.display = 'block';
      }
    }
  }
  
  formularioDialog.showModal();
}

function enviarCancion(event) {
  event.preventDefault(); // Prevenir el envío del formulario
  
  // Obtener los valores del formulario
  var nombreCancion = document.getElementById('song-nombre').value;
  var artista = document.getElementById('song-artista').value;
  var imagen = document.getElementById('song-imagen').files[0];
  var audio = document.getElementById('song-audio').files[0];

  //Validar que los campos no esten vacios
  if (!nombreCancion.trim()) {
    alert('Por favor ingresa el nombre de la cancion.');
    return;
  }

  if (!artista.trim()) {
    alert('Por favor ingresa el nombre del artista.');
    return;
  }

  if (!imagen) {
    alert('Por favor ingresa la imagen de portada de la cancion.');
    return;
  }

  if (!audio) {
    alert('Por favor ingresa la cancion.');
    return;
  }
  
  // Crear un objeto FormData y agregar los datos del formulario
  var formData = new FormData();
  formData.append('nombreCancion', nombreCancion);
  formData.append('artista', artista);
  formData.append('imagen', imagen);
  formData.append('audio', audio);
  
  // Obtener la duración del audio
  var audioElement = new Audio();
  audioElement.src = URL.createObjectURL(audio);
  audioElement.addEventListener('loadedmetadata', function() {
    var duracionAudio = audioElement.duration;
    formData.append('duracion', duracionAudio);
    
    // Enviar los datos del formulario al servidor PHP
    fetch('createSong.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      if (data === 'Bienvenido') {
        alert("La cancion se a subido correctamente");
        // Recargar la página después de 1 segundo
        window.location.href = window.location.href;
      } else {
        alert(data);
      }
    })
    .catch(error => {
      alert('Error: '.error);
    });
  });
}

function enviarAlbum(event) {
  event.preventDefault(); // Prevenir el envío del formulario

  // Obtener los valores del formulario
  var nombreAlbum = document.getElementById('album-nombre').value;
  var imagen = document.getElementById('album-imagen').files[0];
  
  // Validar que ningún campo esté vacío
  if (!nombreAlbum.trim()) {
    alert('Por favor ingresa el nombre del album.');
    return;
  }

  if (!imagen) {
    alert('Por favor ingresa una imagen de portada para el album.');
    return;
  }
  
  // Crear un objeto FormData y agregar los datos del formulario
  var formData = new FormData();
  formData.append('nombreAlbum', nombreAlbum);
  formData.append('imagen', imagen);
  
  // Enviar los datos del formulario al servidor PHP
  fetch('createAlbum.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    if (data === 'Bienvenido') {
      alert("El album se a creado correctamente");
      // Recargar la página después de 1 segundo
      window.location.href = window.location.href;
    } else {
      alert(data);
    }
  })
  .catch(error => {
    alert('Error: '.error);
  });
}

function reproducirCancion(elemento) {
  // Obtener los atributos de datos del explore-item
  const pathSong = elemento.dataset.songPath;
  const artist = elemento.dataset.artist;
  const imagen = elemento.querySelector('img');
  const titulo = elemento.querySelector('p');;

  const songCover = document.querySelector('.song-info img');
  const songTitle = document.querySelector('.song-details h2');
  const songArtist = document.querySelector('.song-details p');

  const songSection = document.querySelector('.song-section');
  
  songCover.src = imagen.src;
  songTitle.textContent = titulo.textContent;
  songArtist.textContent = artist;

  // Cambiar el display de la clase song-section a flex
  songSection.style.display = 'flex';
  audio.src = pathSong;
  audio.play();
  playPauseImg.src = 'pause.png';
}

function toggleBorrar() {
  const button = document.getElementById('btn-borrar');
  const exploreItems = document.querySelectorAll('.explore-item');

  // Alternar el estado de borrado
  borrarActivo = !borrarActivo;

  // Cambiar la clase del botón según el estado de borrado
  if (borrarActivo) {
    button.style.background = 'red';
  } else {
    button.style.background = '#0b41b6';
  }

  // Agregar o quitar el evento clic de los elementos explore-item según el estado de borrado
  exploreItems.forEach(item => {
    if (borrarActivo) {
      item.addEventListener('click', confirmarEliminar);
    } else {
      item.removeEventListener('click', confirmarEliminar);
    }
  });
}

function confirmarEliminar(event) {
  const item = event.currentTarget;
  if (confirm('¿Estás seguro de que quieres eliminar este elemento?')) {
    const tabGroup = document.querySelector('.tab-group');
    const activeTab = tabGroup.querySelector('.activo');
    const opcion = activeTab.dataset.opcion;
    let tipoElemento;

    if (opcion === 'album-list') {
      tipoElemento = 'albums';
    } else if (opcion === 'songs-list') {
      tipoElemento = 'songs';
    }

    var formData = new FormData();
    formData.append('id', item.dataset.id);
    formData.append('tabla', tipoElemento);


    fetch('DeleteSyA.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      if (data === 'Bienvenido') {
        item.remove();
        alert("Se borro correctamente el elemento");
        // Recargar la página después de 1 segundo
        window.location.href = window.location.href;
      } else {
        alert(data);
      }
    })
    .catch(error => {
      alert('Error: '.error);
    });
  }
}

