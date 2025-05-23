@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(to right, #1d3557, #000);
        padding: 100px 20px;
        border-radius: 12px;
        color: #fff;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
    }

    .hero-section p {
        font-size: 1.25rem;
        color: #a8dadc;
        max-width: 700px;
        margin: 0 auto;
    }

    .hero-buttons a {
        font-size: 1.1rem;
        padding: 12px 24px;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -20%;
        left: -20%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, #e63946 0%, transparent 70%);
        opacity: 0.05;
        animation: pulse 6s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.05; }
        50% { transform: scale(1.1); opacity: 0.1; }
    }

    .testimonial-card {
        background: #1d1f2f;
        border: 1px solid #333;
        border-radius: 12px;
        padding: 20px;
        color: #ccc;
        height: 100%;
    }

    .testimonial-card h5 {
        color: #f1faee;
    }

    .section-title {
        color: #f1faee;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
    }

    .loop-card {
        background: #212529;
        border: 1px solid #2f3542;
        border-radius: 10px;
        padding: 15px;
        color: #fff;
        text-align: left;
        height: 100%;
    }

    .loop-author {
        color: #f4a261;
        font-weight: 500;
    }
</style>

{{-- HERO --}}
<div class="hero-section shadow-lg">
    <h1>Bienvenido a <span class="text-primary">LooperKlon</span></h1>
    <p class="mt-3 mb-4">Descubre, comparte y descarga loops creados por productores como tú. Una comunidad hecha por y para amantes de la música.</p>

    <div class="hero-buttons d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('loops.index') }}" class="btn btn-primary shadow">Explorar Loops</a>
        @auth
            <a href="{{ route('loops.create') }}" class="btn btn-outline-light">Subir un Loop</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
        @endauth
    </div>
</div>

{{-- LOOPS DESTACADOS --}}
@php
    $featuredLoops = \App\Models\Loop::with('user', 'tags')->latest()->take(3)->get();
@endphp

<div class="mb-5">
    <h2 class="section-title">Loops destacados</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($featuredLoops as $item)
        <div class="col">
            <div class="loop-card">
                <h5>{{ $item->title }}</h5>
                <p class="small">{{ Str::limit($item->description, 60) }}</p>
                <p class="small">Subido por <span class="loop-author">{{ $item->user->name ?? 'Anónimo' }}</span></p>

                <div id="waveform-{{ $item->id }}" class="rounded bg-dark" style="height: 80px;"></div>

                <div class="d-flex align-items-center mt-2 gap-3">
                    <button id="btn-{{ $item->id }}" class="btn btn-outline-primary btn-sm" onclick="togglePlay('{{ $item->id }}')">
                        <span class="icon">▶ </span>
                    </button>
                    <input type="range" id="volume-{{ $item->id }}" class="form-range" min="0" max="1" step="0.01" style="width: 120px;" value="1"
                        oninput="setVolume('{{ $item->id }}', this.value)">
                </div>

                <audio id="audio-{{ $item->id }}" src="{{ asset('storage/' . $item->filename) }}" class="d-none"></audio>

                @if ($item->tags->count())
                    <div class="mt-3">
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
    </div>
</div>

{{-- TESTIMONIOS --}}
<div class="mb-5">
    <h2 class="section-title">Lo que dicen los usuarios</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="testimonial-card h-100">
                <h5>"¡Me encanta!"</h5>
                <p class="mb-0">He encontrado samples que encajan perfecto con mis beats. Lo recomiendo 100%.</p>
                <div class="loop-author small mt-2">– Dani Beatmaker</div>
            </div>
        </div>
        <div class="col">
            <div class="testimonial-card h-100">
                <h5>"Perfecto para colaborar"</h5>
                <p class="mb-0">Conecté con otros productores y estamos subiendo loops todas las semanas.</p>
                <div class="loop-author small mt-2">– LofiKing</div>
            </div>
        </div>
        <div class="col">
            <div class="testimonial-card h-100">
                <h5>"Fácil y directo"</h5>
                <p class="mb-0">Subes tu loop, etiquetas y listo. ¡Mejor que muchas plataformas de pago!</p>
                <div class="loop-author small mt-2">– Sara Beats</div>
            </div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<div class="text-center mt-5 text-secondary">
    <p>LooperKlon es un proyecto libre para productores. Comparte, conecta y crea sin límites.</p>
</div>

{{-- WaveSurfer --}}
<script src="https://unpkg.com/wavesurfer.js"></script>
<script>
    const waves = {};

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('audio[id^="audio-"]').forEach(audio => {
            const id = audio.id.replace('audio-', '');
            createWaveform(id);
        });
    });

    function createWaveform(id) {
        const audio = document.getElementById('audio-' + id);
        const waveform = WaveSurfer.create({
            container: '#waveform-' + id,
            waveColor: '#457b9d',
            progressColor: '#e63946',
            backgroundColor: '#000',
            height: 80,
            responsive: true,
            barWidth: 2,
            cursorColor: '#fff',
        });

        waveform.load(audio.src);
        waves[id] = waveform;
    }

    function togglePlay(id) {
        if (waves[id]) {
            waves[id].playPause();
            const btn = document.getElementById('btn-' + id).querySelector('.icon');
            btn.textContent = waves[id].isPlaying() ? '⏸ ' : '▶ ';
        }
    }

    function setVolume(id, volume) {
        if (waves[id]) {
            waves[id].setVolume(volume);
        }
    }
</script>
@endsection
