@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Roles</h1>

        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Crear Rol</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge badge-info">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
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
