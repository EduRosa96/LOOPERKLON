@extends('layouts.app')

@section('content')
    <h1>Loops Subidos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($loops as $loop)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $loop->title }}</h5>
                <p>{{ $loop->description }}</p>
                <p><strong>BPM:</strong> {{ $loop->bpm ?? 'N/A' }} | <strong>Tonalidad:</strong> {{ $loop->key_signature ?? 'N/A' }}</p>
                <audio controls>
                    <source src="{{ asset('storage/' . $loop->filename) }}" type="audio/mpeg">
                    Tu navegador no soporta el audio.
                </audio>
            </div>
        </div>
    @empty
        <p>No hay loops aún.</p>
    @endforelse
@endsection
