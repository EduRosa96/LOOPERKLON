@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">
        {{ isset($tag) ? 'Loops con la etiqueta: ' . $tag->name : 'Loops disponibles' }}
    </h2>
    @auth
    <a href="{{ route('loops.create') }}" class="btn btn-primary">+ Subir Loop</a>
    @endauth
</div>

@if (isset($tag))
<div class="mb-3">
    <a href="{{ route('loops.index') }}" class="btn btn-outline-light btn-sm">← Ver todos los loops</a>
</div>
@endif

<form method="GET" action="{{ route('loops.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por título" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>


@forelse ($loops as $item)
<div class="card bg-dark text-white border-secondary mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">{{ $item->title }}</h5>
        <p class="card-text">{{ $item->description }}</p>

        <p class="text-secondary small mb-1">
            <strong>BPM:</strong> {{ $item->bpm ?? 'N/A' }} |
            <strong>Tonalidad:</strong> {{ $item->key_signature ?? 'N/A' }} |
            <strong>Subido por:</strong> {{ $item->user->name ?? 'Anónimo' }}
        </p>

        <div class="mb-3">
            <audio controls class="w-100">
                <source src="{{ asset('storage/' . $item->filename) }}" type="audio/mpeg">
                Tu navegador no soporta la reproducción de audio.
            </audio>
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
@empty
<div class="alert alert-warning">
    No hay loops disponibles.
</div>
@endforelse
@endsection