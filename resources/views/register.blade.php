<!doctype html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Cargar reCAPTCHA v3 -->
  <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4895ef;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --success-color: #4bb543;
      --error-color: #ff3333;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      padding: 20px;
    }
    
    .register-container {
      width: 100%;
      max-width: 500px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .register-header {
      background: var(--primary-color);
      color: white;
      padding: 25px;
      text-align: center;
      position: relative;
    }
    
    .register-header h2 {
      font-weight: 600;
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    
    .register-header h2 i {
      font-size: 1.5rem;
    }
    
    .register-form {
      padding: 30px;
    }
    
    .form-group {
      margin-bottom: 20px;
      position: relative;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark-color);
    }
    
    .form-group input {
      width: 100%;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s;
      padding-left: 45px;
    }
    
    .form-group input:focus {
      outline: none;
      border-color: var(--accent-color);
      box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.2);
    }
    
    .form-group i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #777;
    }
    
    .password-container {
      position: relative;
    }
    
    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #777;
      cursor: pointer;
    }
    
    .password-hint {
      margin-top: 10px;
      font-size: 0.85rem;
      color: #666;
      display: none;
    }
    
    .password-hint ul {
      margin-top: 5px;
      padding-left: 20px;
    }
    
    .password-hint li {
      margin-bottom: 3px;
    }
    
    .progress {
      height: 8px;
      border-radius: 4px;
      margin-top: 10px;
      background-color: #f0f0f0;
    }
    
    .progress-bar {
      transition: width 0.3s ease;
    }
    
    .bg-success {
      background-color: var(--success-color) !important;
    }
    
    .bg-warning {
      background-color: #ffc107 !important;
    }
    
    .bg-danger {
      background-color: var(--error-color) !important;
    }
    
    button[type="submit"] {
      width: 100%;
      padding: 15px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 10px;
    }
    
    button[type="submit"]:hover {
      background: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    button[type="submit"]:disabled {
      background: #cccccc;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }
    
    .login-link {
      text-align: center;
      margin-top: 20px;
      color: #666;
      font-size: 0.9rem;
    }
    
    .login-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
    }
    
    .login-link a:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }
    
    @media (max-width: 480px) {
      .register-container {
        border-radius: 0;
      }
      
      .register-form {
        padding: 20px;
      }
    }
  </style>
  <script>
    // Inicializar reCAPTCHA v3 y obtener el token
    document.addEventListener("DOMContentLoaded", function() {
      grecaptcha.ready(function() {
        grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {action: 'register'}).then(function(token) {
          // Agregar el token al formulario
          document.getElementById('recaptcha-token').value = token;
        });
      });
    });
  </script>
</head>
<body>
  <div class="register-container">
    <div class="register-header">
      <h2><i class="fas fa-user-plus"></i> Crear Cuenta</h2>
    </div>
    <div class="register-form">
      <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="form-group">
          <label>Nombre</label>
          <i class="fas fa-user"></i>
          <input type="text" name="name" placeholder="Ingresa tu nombre" value="{{ old('name') }}">
        </div>
        <div class="form-group">
          <label>Correo electrónico</label>
          <i class="fas fa-envelope"></i>
          <input type="text" name="email" placeholder="Ingresa tu correo electrónico" value="{{ old('email') }}">
        </div>
        <div class="form-group">
          <label>Número de teléfono</label>
          <i class="fas fa-phone"></i>
          <input type="text" name="phone" placeholder="Ingresa tu número de teléfono" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
          <label>Contraseña</label>
          <div class="password-container">
            <i class="fas fa-lock"></i>
            <input id="password" type="password" name="password" placeholder="Crea tu contraseña">
            <button type="button" id="toggle-password" class="password-toggle">
             
            </button>
          </div>
          <small id="password-hint" class="password-hint">
            Tu contraseña debe incluir:
            <ul>
              <li>Al menos 8 caracteres</li>
              <li>Una letra mayúscula</li>
              <li>Una letra minúscula</li>
              <li>Un número</li>
              <li>Un carácter especial (!, @, #, $, etc.)</li>
            </ul>
          </small>
          <div class="progress">
            <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
          </div>
        </div>
        <!-- Campo oculto para el token de reCAPTCHA v3 -->
        <input type="hidden" name="g-recaptcha-response" id="recaptcha-token">
        <button type="submit" id="register-btn" disabled>Registrarse</button>
        <div class="login-link">
          ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

  <!-- Sweetalert for session success/error -->
  @if (session('success'))
    <script>
        Swal.fire({
            title: "¡Bienvenido!",
            text: "{{ session('success') }}",
            icon: "success",
            draggable: true,
            timer: 3000,
            showConfirmButton: false
        });
    </script>
  @endif

  @if (session('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ session('error') }}",
        });
    </script>
  @endif

  @if ($errors->any())
    <script>
        var errorMessages = "{{ implode(', ', $errors->all()) }}";
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: errorMessages,
        });
    </script>
  @endif

  <script>
    const passwordInput = document.getElementById("password");
    const togglePasswordButton = document.getElementById("toggle-password");
    const passwordIcon = document.getElementById("password-icon");
    const passwordHint = document.getElementById("password-hint");
    const strengthBar = document.getElementById("password-strength-bar");
    const registerButton = document.getElementById("register-btn");

    togglePasswordButton.addEventListener("click", () => {
      const type = passwordInput.type === "password" ? "text" : "password";
      passwordInput.type = type;
      passwordIcon.className = type === "password" ? "fas fa-eye" : "fas fa-eye-slash";
    });

    passwordInput.addEventListener("input", () => {
      const password = passwordInput.value;
      const strength = calculateStrength(password);

      passwordHint.style.display = strength.isComplete ? "none" : "block";

      strengthBar.style.width = `${strength.percent}%`;
      strengthBar.className = `progress-bar ${strength.colorClass}`;

      // Enable/disable the register button based on password strength
      registerButton.disabled = !strength.isComplete;
    });

    function calculateStrength(password) {
      let score = 0;

      if (password.length >= 8) score++;
      if (/[A-Z]/.test(password)) score++;
      if (/[a-z]/.test(password)) score++;
      if (/\d/.test(password)) score++;
      if (/[\W_]/.test(password)) score++;

      const percent = (score / 5) * 100;
      const isComplete = score === 5;

      const strength = {
        5: { colorClass: "bg-success", isComplete },
        3: { colorClass: "bg-warning", isComplete: false },
        0: { colorClass: "bg-danger", isComplete: false },
      };

      return { ...strength[Math.min(score, 5)], percent };
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>