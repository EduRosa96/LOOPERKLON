@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Loops disponibles</h2>
        @auth
            <a href="{{ route('loops.create') }}" class="btn btn-primary">+ Subir Loop</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($loops as $loop)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $loop->title }}</h5>
                <p class="card-text text-muted">{{ $loop->description }}</p>

                <p class="mb-2 small text-secondary">
                    <strong>BPM:</strong> {{ $loop->bpm ?? 'N/A' }} |
                    <strong>Tonalidad:</strong> {{ $loop->key_signature ?? 'N/A' }} |
                    <strong>Subido por:</strong> {{ $loop->user->name ?? 'Anónimo' }}
                </p>

                <audio controls class="w-100 mb-2">
                    <source src="{{ asset('storage/' . $loop->filename) }}" type="audio/mpeg">
                    Tu navegador no soporta la reproducción de audio.
                </audio>

                @if ($loop->tags->count())
                    <div>
                        @foreach ($loop->tags as $tag)
                            <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            No hay loops disponibles todavía.
        </div>
    @endforelse
@endsection
