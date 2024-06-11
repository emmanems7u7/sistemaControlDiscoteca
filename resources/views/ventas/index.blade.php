@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-4">
            <div class="card">
                    <div class="card-body">
                        <!-- Aquí van los campos de filtro y búsqueda -->
                        <form action="{{ route('ventas.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Buscar...">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card">
                    <div class="card-body">
            <form method="GET" action="{{ route('ventas.index') }}" class="form-inline">
                <div class="form-group mr-2">
                    <label for="fecha_inicio" class="mr-2">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                </div>

                <div class="form-group mr-2">
                    <label for="fecha_fin" class="mr-2">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                </div>
            
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
            </div>
            </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <!-- Tabla de Ventas -->
                @include('ventas.tabla_ventas')
            </div>
        </div>
      
    </div>
@endsection