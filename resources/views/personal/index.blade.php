@extends('layouts.app')

@section('content')
<div class="container">
        <!-- Admin Panel Card -->
        <div class="card">
            <div class="card-header">
                <h2>Panel de Administración</h2>
                <div class="row">

                <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('rolUser.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-user-tag fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Roles de usuarios') }}</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('permissions.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-user-lock fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Permisos') }}</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('roles.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-users-cog fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Roles') }}</h5>
                    </div>
                </a>
            </div>
        </div>
 
                    
                </div>
            </div>
            <div class="card-body">
                <p>Descripción de la ventana en la que se encuentra. Aquí puede administrar usuarios, filtrar por pisos asignados y ver detalles de cada usuario.</p>
                
                <!-- Filter Section -->
                <div class="filter-section">
                <form method="GET" action="{{ route('user.index') }}">
                    <div class="form-group">
                        <label for="piso_id">Seleccionar Piso</label>
                        <select name="piso_id" id="piso_id" class="form-control">
                            <option value="">Todos los Pisos</option>
                            @foreach($pisos as $piso)
                                <option value="{{ $piso->id }}" {{ request('piso_id') == $piso->id ? 'selected' : '' }}>
                                    {{ $piso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
                </div>
                
                <!-- Table Section -->
                <div class="container-fluid">
                <div class="table-section">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Piso Asignado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td> @forelse($usuario->roles as $role)
                                            {{ $role->name }}{{ !$loop->last ? ', ' : '' }}
                                        @empty
                                            <span class="text-danger">No asignado</span>
                                        @endforelse
                                    </td>
                                <td>
                                    @forelse($usuario->pisos as $piso)
                                        {{ $piso->nombre }}{{ !$loop->last ? ', ' : '' }}
                                        @php
                                        $d = "Cambiar de piso";
                                        @endphp
                                    @empty
                                        <span class="text-danger">No asignado</span>
                                        @php
                                        $d = "Asignar Piso";
                                        @endphp
                                    @endforelse
                                </td>
                                <td>
                                <button class="btn btn-primary btn-sm" onclick="openAssignFloorModal('{{ $usuario->id }}', '{{ $usuario->name }}', '{{ $usuario->email }}')">
                                {{$d}}
                            </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay usuarios disponibles</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    @include('personal.asignaPiso')
    @yield('asigna')
@endsection