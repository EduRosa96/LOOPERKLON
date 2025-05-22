@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Mi perfil</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 text-center">
            <div class="mb-3">
                @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" class="rounded-circle img-fluid" style="max-width: 150px;" alt="Foto de perfil">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1d3557&color=fff" class="rounded-circle img-fluid" style="max-width: 150px;" alt="Avatar">
                @endif
            </div>
            <form method="POST" action="{{ route('dashboard.photo') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <input type="file" name="photo" class="form-control form-control-sm">
                </div>
                <button type="submit" class="btn btn-outline-light btn-sm">Actualizar foto</button>
            </form>
        </div>

        <div class="col-md-8">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva contraseña <small>(opcional)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
@endsection
