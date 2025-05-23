@extends('layouts.app')

@section('content')
<style>
    .section-header {
        background: linear-gradient(to right, #1d3557, #000);
        padding: 40px 20px;
        border-radius: 12px;
        color: #fff;
        text-align: center;
        margin-bottom: 40px;
    }

    .section-header h2 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .search-bar input,
    .search-bar button {
        border-radius: 8px;
    }

    .loop-card {
        background: #1c1c1e;
        border: 1px solid #2f3542;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        color: #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .waveform {
        background-color: #121212;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .loop-meta {
        font-size: 0.9rem;
        color: #a8dadc;
    }

    .loop-tags a {
        margin-right: 5px;
        font-size: 0.8rem;
    }
    .loop-author {
    color: #f4a261;
    font-weight: 500;
}
</style>

<div class="section-header">
    <h2>
        {{ isset($tag) ? 'Loops con la etiqueta: ' . $tag->name : 'Loops disponibles' }}
    </h2>
    @auth
    <a href="{{ route('loops.create') }}" class="btn btn-primary mt-3">+ Subir Loop</a>
    @endauth
</div>

@if (isset($tag))
    <div class="mb-3 text-center">
        <a href="{{ route('loops.index') }}" class="btn btn-outline-light btn-sm">← Ver todos los loops</a>
    </div>
@endif

<form method="GET" action="{{ route('loops.index') }}" class="mb-4 search-bar">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por título, BPM, usuario o etiqueta" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

@forelse ($loops as $item)
<div class="loop-card">
    <h5 class="mb-2">{{ $item->title }}</h5>
    <p class="text-light mb-1">{{ $item->description }}</p>

    <p class="loop-meta">
        <strong>BPM:</strong> {{ $item->bpm ?? 'N/A' }} |
        <strong>Tonalidad:</strong> {{ $item->key_signature ?? 'N/A' }} |
        <strong>Subido por:</strong> {{ $item->user->name ?? 'Anónimo' }}
    </p>

    <div class="waveform" id="waveform-{{ $item->id }}"></div>

    <div class="d-flex align-items-center mt-2 gap-3">
        <button id="btn-{{ $item->id }}" class="btn btn-outline-primary btn-sm" onclick="togglePlay('{{ $item->id }}')">
            <span class="icon">▶ Reproducir</span>
        </button>

        <input type="range"
               id="volume-{{ $item->id }}"
               class="form-range"
               min="0" max="1" step="0.01"
               style="width: 120px;"
               oninput="setVolume('{{ $item->id }}', this.value)"
               value="1">
    </div>

    <audio id="audio-{{ $item->id }}" src="{{ asset('storage/' . $item->filename) }}" class="d-none"></audio>

    @if ($item->tags->count())
    <div class="loop-tags mt-2">
        @foreach ($item->tags as $tag)
        <a href="{{ route('loops.byTag', $tag) }}" class="badge bg-secondary text-decoration-none">
            {{ $tag->name }}
        </a>
        @endforeach
    </div>
    @endif
</div>
@empty
<div class="alert alert-warning text-center">
    No hay loops disponibles.
</div>
@endforelse
@endsection
