@extends('layouts.app')

@section('content')
<div class="container mt-5">
   
<div class="jumbotron text-center bg-dark text-white rounded" data-aos="fade-down" data-aos-duration="1000">
    <h2 class="mb-3">Configuración</h2>
    <p class="lead">Administra y personaliza las opciones de tu sistema para optimizar su funcionamiento.</p>
</div>
    <div class="row">
        
       

        <div class="col-md-6 mb-4" data-aos="zoom-in">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Crear proveedores</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('proveedores.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="persona_contacto">Persona de Contacto</label>
                            <input type="text" class="form-control" id="persona_contacto" name="persona_contacto" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                    <h4 class="card-title">Proveedores disponibles</h4>
                @include('proveedores.index')
                    @yield('proveedores')
                </div>

                

            </div>
        </div>

        <div class="col-md-6 mb-4" data-aos="zoom-in">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Crear categoria</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>

                    <h4 class="card-title">Categorias disponibles</h4>
                @include('categorias.index')
                    @yield('categorias')
                </div>
            </div>
        </div>






        <div class="col-md-6 mb-4" data-aos="zoom-in">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Crear piso</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('pisos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                    <h4 class="card-title">Pisos disponibles</h4>
                @include('pisos.index')
                    @yield('pisos')
                </div>


               
              
            </div>

           
        </div>
    </div>
</div>
@endsection
