<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>jOGO</title>
  <link rel="stylesheet" href="LyRStyle.css">
</head>
<body>
  <h1 class="main-title">jOGO</h1>
  <div class="container">
    <h2 id="form-title">Iniciar sesión</h2>
    <div id="login-form">
      <form id="login-form-content">
        <div class="form-group">
          <label for="email">Correo electrónico:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar sesión</button>
      </form>
      <p id="register-link" class="link-text">¿No tienes una cuenta? <a href="#" onclick="showRegisterForm()">Registrarse</a></p>
    </div>
    <div id="register-form" style="display: none;">
      <form id="register-form-content">
        <div class="form-group">
          <label for="username">Nombre de usuario (máximo 15 caracteres):</label>
          <input type="text" id="username" name="username" maxlength="15" required>
        </div>
        <div class="form-group">
          <label for="email">Correo electrónico:</label>
          <input type="email" id="register-email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Contraseña (8-16 caracteres):</label>
          <input type="password" id="register-password" name="password" minlength="8" maxlength="16" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirmar contraseña:</label>
          <input type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="form-group">
          <label for="dob">Fecha de nacimiento:</label>
          <input type="date" id="dob" name="dob" required>
        </div>
        <div class="form-group">
          <label for="profile-pic">Foto de perfil:</label>
          <input type="file" id="profile-pic" name="profile-pic" accept="image/*" required>
        </div>
        <button type="submit">Registrarse</button>
      </form>
      <p id="login-link" class="link-text">¿Ya tienes una cuenta? <a href="#" onclick="showLoginForm()">Iniciar sesión</a></p>
    </div>
    <div id="error-message" class="error-message"></div>
  </div>
  <script src="LyRScript.js"></script>
</body>
</html>