@extends('layouts.app')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="card bg-dark text-white border-secondary shadow-lg w-100" style="max-width: 900px;">
        <div class="card-header border-secondary d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Panel de Usuario</h4>
            <small class="text-muted">Bienvenido, {{ Auth::user()->name }}</small>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Perfil -->
                <div class="col-md-4 mb-4 mb-md-0 border-end border-secondary">
                    <div class="text-center">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/100' }}" class="rounded-circle shadow-sm mb-3" width="120" height="120" alt="Foto de perfil">
                        <h5>{{ Auth::user()->name }}</h5>
                        <p class="text-secondary small">{{ Auth::user()->email }}</p>
                    </div>
                    <form action="{{ route('dashboard.photo') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <input type="file" name="photo" class="form-control form-control-sm mb-2 text-white bg-dark border-secondary">
                        <button type="submit" class="btn btn-outline-primary btn-sm w-100">Actualizar foto</button>
                    </form>
                </div>

                <!-- Loops del usuario -->
                <div class="col-md-8">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Tus Loops</h5>
                        <button class="btn btn-sm btn-outline-light" data-bs-toggle="collapse" data-bs-target="#loopList" aria-expanded="true" aria-controls="loopList">Mostrar/Ocultar</button>
                    </div>
                    <div id="loopList" class="collapse show fade">
                        @if (Auth::user()->loops && Auth::user()->loops->count())
                            @foreach (Auth::user()->loops as $loop)
                                <div class="mb-4 pb-3 border-bottom border-secondary">
                                    <h6>{{ $loop->title }}</h6>
                                    <p class="text-muted small mb-1">
                                        <strong>BPM:</strong> {{ $loop->bpm ?? 'N/A' }} |
                                        <strong>Tonalidad:</strong> {{ $loop->key_signature ?? 'N/A' }}
                                    </p>
                                    <audio controls class="w-100 mt-2">
                                        <source src="{{ asset('storage/' . $loop->filename) }}" type="audio/mpeg">
                                        Tu navegador no soporta la reproducción de audio.
                                    </audio>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Aún no has subido ningún loop.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap animation fallback -->
<script>
    const collapses = document.querySelectorAll('.collapse');
    collapses.forEach(collapse => {
        collapse.classList.add('show');
    });
</script>
@endsection