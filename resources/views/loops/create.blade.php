@extends('layouts.app')

{{-- CDN de Tagify --}}
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

@section('content')
<div class="container mt-5">
    <h2>Subir nuevo loop</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/loops" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="bpm" class="form-label">BPM</label>
            <input type="number" name="bpm" id="bpm" class="form-control">
        </div>

        <div class="mb-3">
            <label for="key_signature" class="form-label">Tonalidad</label>
            <input type="text" name="key_signature" id="key_signature" class="form-control">
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Etiquetas</label>
            <input name="tags" id="tag-input" class="form-control" placeholder="rock, trap, jazz" />
        </div>

        <div class="mb-3">
            <label for="filename" class="form-label">Archivo de audio</label>
            <input type="file" name="filename" id="filename" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Subir Loop</button>
    </form>

    {{-- Tagify JS --}}
    <script>
        new Tagify(document.querySelector('#tag-input'));
    </script>
</div>
@endsection

{{-- CDN de Bootstrap --}} 