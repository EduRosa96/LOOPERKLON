<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>LooperKlon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('loops.index') }}" class="navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('storage/logo.png') }}" alt="Logo" height="40">
            <strong>LooperKlon</strong>
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


<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
