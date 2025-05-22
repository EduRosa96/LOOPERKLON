@extends('layouts.app')

@section('content')

<h1>Loops Subidos</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@forelse ($loops as $item)
<div class="card mb-3">
    <div class="card-body">
        <h5>{{ $item->title }}</h5>
        <p>{{ $item->description }}</p>
        <p>
            <strong>BPM:</strong> {{ $item->bpm ?? 'N/A' }} |
            <strong>Tonalidad:</strong> {{ $item->key_signature ?? 'N/A' }}
        </p>
        <audio controls>
            <source src="{{ asset('storage/' . $item->audio_path) }}" type="audio/wav">
            <source src="{{ asset('storage/' . $item->audio_path) }}" type="audio/mpeg">
            <source src="{{ asset('storage/' . $item->audio_path) }}" type="audio/ogg">
            <p>Tu navegador no soporta la reproducción de audio.</p>
            <a href="{{ asset('storage/' . $item->audio_path) }}">Descargar</a>
            Tu navegador no soporta la reproducción de audio.
        </audio>
    </div>
</div>
@empty
<p>No hay loops disponibles.</p>
@endforelse
@endsection