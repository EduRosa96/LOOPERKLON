<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LooperKlon</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fuente personalizada -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .btn-primary {
            background-color: #e63946 !important;
            border-color: #e63946 !important;
        }
        .btn-primary:hover {
            background-color: #c82333 !important;
            border-color: #bd2130 !important;
        }
        .bg-primary {
            background-color: #e63946 !important;
        }
        .text-primary {
            color: #e63946 !important;
        }
        .btn-outline-primary {
            color: #e63946 !important;
            border-color: #e63946 !important;
        }
        .btn-outline-primary:hover {
            background-color: #e63946 !important;
            color: white !important;
        }
        .btn-secondary {
            background-color: #457b9d !important;
            border-color: #457b9d !important;
        }
        .btn-secondary:hover {
            background-color: #365f7a !important;
            border-color: #2f5269 !important;
        }
        .bg-secondary {
            background-color: #457b9d !important;
        }
        .text-secondary {
            color: #457b9d !important;
        }
        .btn-success {
            background-color: #2a9d8f !important;
            border-color: #2a9d8f !important;
        }
        .btn-success:hover {
            background-color: #21867a !important;
            border-color: #1f776d !important;
        }
        .btn-danger {
            background-color: #e76f51 !important;
            border-color: #e76f51 !important;
        }
        .btn-danger:hover {
            background-color: #d65a3c !important;
            border-color: #c74f32 !important;
        }
        .btn-warning {
            background-color: #f4a261 !important;
            border-color: #f4a261 !important;
        }
        .btn-warning:hover {
            background-color: #e78a3d !important;
            border-color: #d6792d !important;
        }
        .btn-info {
            background-color: #a8dadc !important;
            border-color: #a8dadc !important;
            color: #1b1b18 !important;
        }
        .btn-info:hover {
            background-color: #8fd0d2 !important;
            border-color: #7ac8ca !important;
            color: #1b1b18 !important;
        }
        .btn-dark,
        .bg-dark {
            background-color: #1d3557 !important;
            border-color: #1d3557 !important;
        }
        .text-dark {
            color: #1d3557 !important;
        }
        .btn-light,
        .bg-light {
            background-color: #f1faee !important;
            border-color: #f1faee !important;
        }
        .text-light {
            color: #f1faee !important;
        }
    </style>
</head>
<body class="bg-dark text-white min-vh-100 d-flex flex-column">
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('loops.index') }}" class="navbar-brand d-flex align-items-center gap-2">
                <img src="{{ asset('storage/logo.png') }}" alt="LooperKlon" height="60">

            </a>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <span class="text-white me-2">Hola, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mt-4 flex-grow-1" style="max-width: 800px;">
        @yield('content')
    </main>

    <footer class="bg-dark text-center py-4 text-sm text-secondary">
        &copy; {{ date('Y') }} LooperKlon. Desarrollado por EduRosa.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
