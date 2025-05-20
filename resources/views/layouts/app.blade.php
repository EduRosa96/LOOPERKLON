<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Looperman Clon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container">
            <a href="{{ route('loops.index') }}" class="navbar-brand">Looperman Clon</a>
            <a href="{{ route('loops.create') }}" class="btn btn-outline-light">Subir Loop</a>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
