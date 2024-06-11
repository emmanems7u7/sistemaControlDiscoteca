@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Permiso</h1>

    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Permiso</button>
    </form>
</div>
@endsection