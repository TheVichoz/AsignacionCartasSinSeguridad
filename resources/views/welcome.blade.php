<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    
    <!-- Load Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* General page styles */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #d6d6d6;
        }

        /* Fixed header with navigation and logo */
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            height: 50px;
        }

        /* Main content area: centered vertically and horizontally */
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 80px;   /* Leave space for fixed header */
            padding-bottom: 40px;
        }

        /* Login card styling */
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Footer area */
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
        }

        /* Google OAuth button styling */
        .google-btn {
            background-color: #4285F4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .google-btn:hover {
            background-color: #357ae8;
        }
    </style>
</head>
<body>

    <!-- Top navigation with logo and menu -->
    <header class="header">
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo de la empresa">
        
        <nav>
            <a href="#" class="mx-2 text-dark">Inicio</a>
            <a href="#" class="mx-2 text-dark">Servicios</a>
            <a href="#" class="mx-2 text-dark">Contacto</a>
        </nav>
    </header>
    
    <!-- Centered login card -->
    <main class="content">
        <div class="login-box">
            <h2>Bienvenido</h2>
            <p>Por favor, inicia sesión para continuar</p>

            <!-- Google login redirection -->
            <a href="{{ url('/auth/redirect/google') }}" class="google-btn">
                Iniciar sesión con Google
            </a>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 Mi Aplicación. Todos los derechos reservados.
    </footer>
    
    <!-- Load Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
