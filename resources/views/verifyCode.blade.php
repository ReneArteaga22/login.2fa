<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        .verification-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .verification-header {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
        }
        
        .verification-header h2 {
            font-weight: 600;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .verification-header h2 i {
            font-size: 1.5rem;
        }
        
        .verification-form {
            padding: 30px;
            text-align: center;
        }
        
        .verification-message {
            color: #666;
            margin-bottom: 25px;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        .code-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        .code-input {
            width: 55px;
            height: 55px;
            text-align: center;
            font-size: 1.5rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .code-input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.2);
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
        }
        
        button[type="submit"]:hover:not(:disabled) {
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
        
        .resend-link {
            display: block;
            margin-top: 20px;
            color: #666;
            font-size: 0.9rem;
        }
        
        .resend-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .resend-link a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .verification-container {
                border-radius: 0;
            }
            
            .verification-form {
                padding: 20px;
            }
            
            .code-input {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
<div class="verification-container">
    <div class="verification-header">
        <h2><i class="fas fa-key"></i> Verificación</h2>
    </div>
    <div class="verification-form">
        <p class="verification-message">Hemos enviado un código de verificación a tu correo electrónico. Por favor ingrésalo a continuación.</p>
        
        <form id="verification-form" method="POST" action="{{ route('verifyLoginCode') }}">
            @csrf
            <div class="code-input-container">
                <input type="text" class="code-input" maxlength="1" required />
                <input type="text" class="code-input" maxlength="1" required />
                <input type="text" class="code-input" maxlength="1" required />
                <input type="text" class="code-input" maxlength="1" required />
                <input type="text" class="code-input" maxlength="1" required />
            </div>
            <!-- Campo oculto para el token de reCAPTCHA v3 -->
            <input type="hidden" name="g-recaptcha-response" id="recaptcha-token">
            <input type="hidden" name="verify" id="verify">
            <button type="submit" disabled>Verificar</button>
        </form>
        
        <p class="resend-link">¿No recibiste el código? <a href="#">Reenviar código</a></p>
    </div>
</div>

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

@if ($errors->any()))
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
    const inputs = document.querySelectorAll('.code-input');
    const button = document.querySelector('button[type="submit"]');
    const hiddenInput = document.getElementById('verify');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value) {
                if (inputs[index + 1]) {
                    inputs[index + 1].focus();
                }
            } else {
                if (inputs[index - 1]) {
                    inputs[index - 1].focus();
                }
            }

            // Check if all inputs have values and enable the submit button
            const code = Array.from(inputs).map(input => input.value).join('');
            hiddenInput.value = code;

            button.disabled = code.length !== 5;
        });
        
        // Manejar pegado de código
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text').trim();
            if (pasteData.length === 5 && /^\d+$/.test(pasteData)) {
                pasteData.split('').forEach((char, i) => {
                    if (inputs[i]) {
                        inputs[i].value = char;
                    }
                });
                if (inputs[4]) {
                    inputs[4].focus();
                }
                hiddenInput.value = pasteData;
                button.disabled = false;
            }
        });
    });

    // Inicializar reCAPTCHA v3 y obtener el token
    document.addEventListener("DOMContentLoaded", function() {
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ config('services.recaptcha.site_key') }}", {action: 'verify'}).then(function(token) {
                // Agregar el token al formulario
                document.getElementById('recaptcha-token').value = token;
            });
        });
    });
</script>
</body>
</html>