<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('login.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        .login-container {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
        }
        
        .login-header h2 {
            font-weight: 600;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-header h2 i {
            font-size: 1.5rem;
        }
        
        .login-form {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
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
        
        .message {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 0.9rem;
        }
        
        .message a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .message a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .logo {
            margin-bottom: 15px;
        }
        
        .logo img {
            height: 50px;
        }
        
        @media (max-width: 480px) {
            .login-container {
                border-radius: 0;
            }
            
            .login-form {
                padding: 20px;
            }
        }
    </style>
    <script>
        // Inicializar reCAPTCHA v3 y obtener el token
        document.addEventListener("DOMContentLoaded", function() {
          grecaptcha.ready(function() {
            grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {action: 'login'}).then(function(token) {
              // Agregar el token al formulario
              document.getElementById('recaptcha-token').value = token;
            });
          });
        });
    </script> 
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h2><i class="fas fa-lock"></i> Iniciar Sesión</h2>
    </div>
    <form class="login-form" method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
            <i class="fas fa-envelope"></i>
            <input type="text" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" />
        </div>
        <div class="form-group">
            <i class="fas fa-key"></i>
            <input type="password" name="password" placeholder="Contraseña" />
        </div>
        <!-- Campo oculto para el token de reCAPTCHA v3 -->
        <input type="hidden" name="g-recaptcha-response" id="recaptcha-token">
        <button type="submit">Acceder</button>
        <p class="message">¿No tienes una cuenta? <a href="{{ url('/register') }}">Regístrate aquí</a></p>
    </form>
</div>

@if (session('success'))
    <script>
        Swal.fire({
            title: "Welcome!",
            text: "{{ session('success') }}",
            icon: "success",
            draggable: true,
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error_code') == \App\Constants\Errors\V1\ErrorCodes::E1001)
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "The provided credentials are incorrect.",
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ implode(', ', $errors->all()) }}",
        });
    </script>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>