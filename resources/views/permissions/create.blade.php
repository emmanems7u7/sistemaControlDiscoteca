@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Permiso</h1>

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del permiso">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear Permiso</button>
    </form>
</div>
@endsection