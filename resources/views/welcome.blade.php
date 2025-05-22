@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <img src="{{ asset('storage/logo.png') }}" alt="LooperKlon" class="mb-4" style="height: 100px;">

        <h1 class="display-4 fw-bold text-primary">Bienvenido a LooperKlon</h1>
        <p class="lead text-secondary">Comparte y descubre loops musicales únicos.</p>

        <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('loops.index') }}" class="btn btn-primary btn-lg">
                🎧 Explorar Loops
            </a>

            @auth
                <a href="{{ route('loops.create') }}" class="btn btn-outline-primary btn-lg">
                    ⬆️ Subir un Loop
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">
                    Registrarse
                </a>
            @endauth
        </div>
    </div>
@endsection
