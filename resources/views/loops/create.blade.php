@extends('layouts.app')

@section('content')
{{-- CDN de Tagify --}}
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<style>
    .upload-section {
        background: linear-gradient(to right, #1d3557, #121212);
        border-radius: 12px;
        padding: 40px;
        color: #fff;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }

    .upload-section label {
        color: #a8dadc;
        font-weight: 500;
    }

    .upload-section input,
    .upload-section textarea {
        background-color: #2b2d42;
        color: #fff;
        border: 1px solid #444;
    }

    .upload-section input::placeholder,
    .upload-section textarea::placeholder {
        color: #ccc;
    }

    .upload-section .form-control:focus {
        border-color: #e63946;
        box-shadow: 0 0 0 0.2rem rgba(230, 57, 70, 0.25);
    }

    .upload-section .btn-primary {
        background-color: #e63946;
        border-color: #e63946;
    }

    .upload-section .btn-primary:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .tagify {
        background-color: #2b2d42 !important;
        border-color: #444 !important;
    }

    .tagify__tag {
        background-color: #457b9d !important;
        color: #fff;
    }

    .tagify__input {
        color: #fff !important;
    }
</style>

<div class="container mt-5">
    <div class="upload-section">
        <h2 class="mb-4 text-center">Subir nuevo loop</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('loops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" required placeholder="Nombre del loop">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Describe tu loop..."></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="bpm" class="form-label">BPM</label>
                    <input type="number" name="bpm" id="bpm" class="form-control" placeholder="Ej: 120">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="key_signature" class="form-label">Tonalidad</label>
                    <input type="text" name="key_signature" id="key_signature" class="form-control" placeholder="Ej: C#m">
                </div>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Etiquetas</label>
                <input name="tags" id="tag-input" class="form-control" placeholder="rock, trap, jazz" />
            </div>

            <div class="mb-4">
                <label for="filename" class="form-label">Archivo de audio</label>
                <input type="file" name="filename" id="filename" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Subir Loop</button>
        </form>
    </div>
</div>

{{-- Tagify init --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new Tagify(document.querySelector('#tag-input'));
    });
</script>
@endsection
