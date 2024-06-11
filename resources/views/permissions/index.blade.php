@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Permisos</h1>

    <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Crear Permiso</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection