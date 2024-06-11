@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Rol</h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del rol">
            </div>
            <div class="form-group">
                <label for="permissions">Permisos:</label>
                <select multiple class="form-control" id="permissions" name="permissions[]">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Rol</button>
        </form>
    </div>
@endsection