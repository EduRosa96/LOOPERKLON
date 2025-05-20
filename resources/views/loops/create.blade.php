@extends('layouts.app')

@section('content')
    <h1>Subir Loop</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('loops.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">BPM</label>
            <input type="number" name="bpm" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tonalidad</label>
            <input type="text" name="key_signature" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Archivo de audio (MP3 o WAV)</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir</button>
    </form>
@endsection
