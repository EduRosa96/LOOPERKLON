@extends('layouts.app')

@section('content')
<style>
    .dashboard-hero {
        background: linear-gradient(to right, #1d3557, #121212);
        padding: 80px 20px;
        border-radius: 12px;
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -25%;
        left: -25%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, #e63946 0%, transparent 70%);
        opacity: 0.06;
        animation: pulse 6s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.06;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.1;
        }
    }

    .dashboard-card {
        background: #1e1e2f;
        border: 1px solid #333;
        border-radius: 12px;
        padding: 20px;
        color: #fff;
    }

    .form-control,
    .btn {
        border-radius: 6px;
    }
</style>

<div class="dashboard-hero shadow-lg mb-5">
    <h1 class="fw-bold">Hola, {{ Auth::user()->name }}</h1>
    <p class="text-secondary">Este es tu panel personal. Desde aquí puedes gestionar tu perfil y tus loops.</p>
</div>

<div class="container mb-5" style="max-width: 1000px;">
    <div class="row g-4">
        <!-- Perfil -->
        <div class="col-md-4">
            <div class="dashboard-card text-center">
                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/100' }}"
                    class="rounded-circle shadow-sm mb-3" width="120" height="120" alt="Foto de perfil">
                <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-white small">{{ Auth::user()->email }}</p>

                <form action="{{ route('dashboard.photo') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <input type="file" name="photo" class="form-control form-control-sm mb-2 text-white bg-dark border-secondary">
                    <button type="submit" class="btn btn-outline-primary btn-sm w-100">Actualizar foto</button>
                </form>
            </div>
        </div>

        <!-- Loops -->
        <div class="col-md-8">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Tus Loops</h5>
                    <button class="btn btn-sm btn-outline-light" data-bs-toggle="collapse" data-bs-target="#loopList">Mostrar/Ocultar</button>
                </div>
                <div id="loopList" class="collapse show fade">
                    @php
                    $loops = Auth::user()->loops()->with('tags')->latest()->get();
                    @endphp

                    @if ($loops->count())
                    @foreach ($loops as $item)
                    <div class="card bg-dark text-white border-secondary mb-4 shadow-sm">
                        <div class="card-body bg-black rounded p-3 shadow-sm">

                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>

                            <p class="text-secondary small mb-1">
                                <strong>BPM:</strong> {{ $item->bpm ?? 'N/A' }} |
                                <strong>Tonalidad:</strong> {{ $item->key_signature ?? 'N/A' }}
                            </p>

                            <div class="mb-3">
                                {{-- Onda de audio --}}
                                <div id="waveform-{{ $item->id }}" class="rounded bg-dark" style="height: 80px;"></div>

                                {{-- Controles --}}
                                <div class="d-flex align-items-center mt-2 gap-3">
                                    <button id="btn-{{ $item->id }}" class="btn btn-outline-primary btn-sm" onclick="togglePlay('{{ $item->id }}')">
                                        <span class="icon">▶ Reproducir</span>
                                    </button>
                                    <input type="range" id="volume-{{ $item->id }}" class="form-range" min="0" max="1" step="0.01" style="width: 120px;"
                                        oninput="setVolume('{{ $item->id }}', this.value)" value="1">
                                </div>

                                <audio id="audio-{{ $item->id }}" src="{{ asset('storage/' . $item->filename) }}" class="d-none"></audio>
                            </div>

                            @if ($item->tags->count())
                            <div class="mb-2">
                                @foreach ($item->tags as $tag)
                                <a href="{{ route('loops.byTag', $tag) }}" class="badge bg-secondary text-decoration-none me-1">
                                    {{ $tag->name }}
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-white">Aún no has subido ningún loop.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection