@extends('layouts.app')

@section('content')
    <h1>Usuarios</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }}
                            @if (!$loop->last), 
                            
                            @endif
                            
                        @endforeach
                    </td>
                    
                    <td><a href="#" class=" float-right btn btn-info" data-toggle="modal" data-target="#myModal" onclick="cargarDato('1', '{{$user->id}}', '{{ route('UsuarioRol.show', ['id' => ':id', 'UserId' => ':userid']) }}')">Asignar rol</a></td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('personal.modalRol')
       @yield('modalP')
@endsection

