document.getElementById('register-form').addEventListener('submit', function(event) {
  event.preventDefault();

  var form = document.getElementById('register-form-content');
  var formData = new FormData(form);
  var username = document.getElementById('username').value;
  var email = document.getElementById('register-email').value;
  var password = document.getElementById('register-password').value;
  var confirmPassword = document.getElementById('confirm-password').value;
  var dob = document.getElementById('dob').value;
  var profilePic = document.getElementById('profile-pic').value;
  var errorMessage = document.getElementById('error-message');
  
  // Simple validation example, you can expand this as needed
  if (!username.trim()) {
    errorMessage.innerText = 'Por favor ingresa un nombre de usuario.';
    return;
  }

  if (username.length > 15) {
    errorMessage.innerText = 'El nombre de usuario debe tener como máximo 15 caracteres.';
    return;
  }

  if (!email.trim()) {
    errorMessage.innerText = 'Por favor ingresa un correo electrónico.';
    return;
  }

  if (!/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
    errorMessage.innerText = 'Por favor ingresa un correo electrónico válido.';
    return;
  }

  if (!password.trim()) {
    errorMessage.innerText = 'Por favor ingresa una contraseña.';
    return;
  }

  if (password.length < 8 || password.length > 16) {
    errorMessage.innerText = 'La contraseña debe tener entre 8 y 16 caracteres.';
    return;
  }

  if (!confirmPassword.trim()) {
    errorMessage.innerText = 'Por favor confirma tu contraseña.';
    return;
  }

  if (password !== confirmPassword) {
    errorMessage.innerText = 'Las contraseñas no coinciden. Por favor, inténtalo de nuevo.';
    return;
  }

  if (!dob.trim()) {
    errorMessage.innerText = 'Por favor ingresa tu fecha de nacimiento.';
    return;
  }

  if (!profilePic.trim()) {
    errorMessage.innerText = 'Por favor selecciona una foto de perfil.';
    return;
  }

  errorMessage.innerText = '';

  fetch('Register.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    if (data === 'Bienvenido') {
      showLoginForm();
    } else {
      errorMessage.innerText = data;
    }
  })
  .catch(error => {
    errorMessage.innerText = 'Error: ' + error;
  });
});



document.getElementById('login-form').addEventListener('submit', function(event) {
  event.preventDefault();
  var form = document.getElementById('login-form-content');
  var formData = new FormData(form);
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var errorMessage = document.getElementById('error-message');

  // Simple validation example, you can expand this as needed
  if (!email.trim()) {
    errorMessage.innerText = 'Por favor ingresa un correo electrónico.';
    return;
  }

  if (!/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
    errorMessage.innerText = 'Por favor ingresa un correo electrónico válido.';
    return;
  }

  if (password.trim() === '') {
    errorMessage.innerText = 'Por favor ingresa una contraseña.';
    return;
  }

  if (password.length < 8 || password.length > 16) {
    errorMessage.innerText = 'La contraseña debe tener entre 8 y 16 caracteres.';
    return;
  }

  errorMessage.innerText = '';

  fetch('Login.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    if (data === 'Bienvenido') {
      window.location.href = 'principal.php';
    } else {
      errorMessage.innerText = data;
    }
  })
  .catch(error => {
    errorMessage.innerText = 'Error: ' + error;
  });
});


function showRegisterForm() {
  document.getElementById('login-form').style.display = 'none';
  document.getElementById('register-form').style.display = 'block';
  document.getElementById('form-title').innerText = 'Registrarse';
}

function showLoginForm() {
  document.getElementById('register-form').style.display = 'none';
  document.getElementById('login-form').style.display = 'block';
  document.getElementById('form-title').innerText = 'Iniciar sesión';
}
