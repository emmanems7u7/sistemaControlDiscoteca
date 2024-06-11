@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Proveedor</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proveedor->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $proveedor->direccion }}" required>
        </div>
        <div class="form-group">
            <label for="persona_contacto">Persona de Contacto</label>
            <input type="text" class="form-control" id="persona_contacto" name="persona_contacto" value="{{ $proveedor->persona_contacto }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $proveedor->correo }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $proveedor->telefono }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
