@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Rol</h1>

        <form action="{{ route('roles.update', $role) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
            </div>
            <div class="form-group">
    <label for="permissions">Permisos:</label>
    <br>
    <label for="permissions">Presiona Ctrl para seleccionar mas de un Permiso</label>
    <select multiple class="form-control" id="permissions" name="permissions[]">
        @foreach ($permissions as $permission)
            <option value="{{ $permission->id }}" @if ($role->hasPermissionTo($permission->name)) selected @endif>{{ $permission->name }}</option>
        @endforeach
    </select>
</div>
            <button type="submit" class="btn btn-primary">Actualizar Rol</button>
        </form>
    </div>
@endsection