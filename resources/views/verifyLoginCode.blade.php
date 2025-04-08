<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Cuenta</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --text-color: #333333;
            --muted-color: #6c757d;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }
        
        .email-container {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .email-header {
            background: var(--primary-color);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .email-header h1 {
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .email-body {
            padding: 40px;
            text-align: center;
        }
        
        .greeting {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: var(--text-color);
        }
        
        .message {
            font-size: 1rem;
            margin-bottom: 30px;
            color: var(--text-color);
        }
        
        .verification-code {
            display: inline-block;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 5px;
            color: var(--primary-color);
            background: #f0f4ff;
            padding: 20px 30px;
            border-radius: 8px;
            margin: 30px 0;
            border: 1px dashed var(--accent-color);
        }
        
        .instructions {
            font-size: 0.9rem;
            color: var(--muted-color);
            margin-top: 30px;
        }
        
        .email-footer {
            padding: 20px;
            background: #f8f9fa;
            text-align: center;
            font-size: 0.8rem;
            color: var(--muted-color);
            border-top: 1px solid #eee;
        }
        
        .logo {
            margin-bottom: 20px;
        }
        
        .logo img {
            height: 50px;
        }
        
        .button {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            transition: all 0.3s;
        }
        
        .button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 600px) {
            .email-body {
                padding: 30px 20px;
            }
            
            .verification-code {
                font-size: 1.5rem;
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Verificación de Cuenta</h1>
        </div>
        
        <div class="email-body">
            <div class="greeting">Hola {{ $user->name }},</div>
            
            <p class="message">¡Gracias por registrarte en nuestro servicio! Estamos encantados de tenerte con nosotros.</p>
            
            <p class="message">Para completar la verificación de tu cuenta, por favor utiliza el siguiente código:</p>
            
            <div class="verification-code">{{ $code }}</div>
            
            <p class="instructions">Este código es válido por 30 minutos. Si no solicitaste esta verificación, por favor ignora este mensaje o contacta con nuestro soporte.</p>
            
           
        </div>
        
        <div class="email-footer">
            <p>Este mensaje ha sido enviado automáticamente. Por favor, no respondas a este correo.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>