{{-- resources/views/productos/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">

    <div class="container mt-5">
        <h1 class="mb-4">Filtrar Productos</h1>
        <form method="GET" action="{{ route('productos.index') }}" class="form-inline">
            <div class="form-group mb-2 mr-3">
                <label for="categoria_id" class="mr-2">Categoría:</label>
                <select name="categoria_id" id="categoria_id" class="form-control">
                    <option value="">Todas</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2 mr-3">
                <label for="buscar" class="mr-2">Buscar Producto:</label>
                <input type="text" name="buscar" id="buscar" class="form-control" value="{{ request('buscar') }}">
            </div>

            <div class="form-group form-check mb-2 mr-3">
                <input type="checkbox" name="stock_bajo" id="stock_bajo" class="form-check-input" {{ request('stock_bajo') ? 'checked' : '' }}>
                <label for="stock_bajo" class="form-check-label">Stock Bajo</label>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
        </form>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Productos</h5>
                        @role('administrador')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearProductoModal">Crear Producto</button>
                   @endrole
                    </div>

                    <div class="card-body">
                        @if ($productos->isEmpty())
                            <p>No hay productos disponibles. Por favor, cree uno.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio Venta</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>
                                                @if (isset($producto->imagen))
                                                <img src="{{asset('/storage'.$producto->imagen)}}" class="rounded" alt="Profile picture" height="35" width="35">
                                            @else
                                                <i class="bi bi-person-square"></i>
                                            @endif
                                         </td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td>{{ $producto->precio_venta }}</td>
                                            <td>{{ $producto->cantidad_stock }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detalleProductoModal" onclick="mostrarDetalleProducto({
                                                        nombre: '{{ $producto->nombre }}',
                                                        descripcion: '{{ $producto->descripcion }}',
                                                        categoria: '{{ $producto->categoria_id }}',
                                                        proveedor: '{{ $producto->proovedor_id }}',
                                                        precio_compra: {{ $producto->precio_compra }},
                                                        precio_venta: {{ $producto->precio_venta }},
                                                        cantidad_stock: {{ $producto->cantidad_stock }},
                                                        unidad: '{{ $producto->unidad }}',
                                                        imagen: '{{ asset('/storage'.$producto->imagen) }}' 
                                                    })"><i class="fas fa-eye"></i></a>
                                            @role('administrador')
                                                <a href="" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editarModal" onclick="obtenerDato({{ $producto->id }})"> <i class="fas fa-edit"></i></a>
                                                <form action="{{ route('productos.destroy', ['producto' => $producto->id]) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">   <i class="fas fa-trash"></i></button>
                                                </form>
                                                @endrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
    <ul class="pagination">
        {{-- Anterior --}}
        @if ($productos->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $productos->previousPageUrl() }}" rel="prev">&laquo;</a>
            </li>
        @endif

        {{-- Elementos --}}
        @for ($i = 1; $i <= $productos->lastPage(); $i++)
            <li class="page-item {{ ($productos->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $productos->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Siguiente --}}
        @if ($productos->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $productos->nextPageUrl() }}" rel="next">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">&raquo;</span>
            </li>
        @endif
    </ul>
</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->

@include('productos.editProductos')
 @yield('editP')

@include('productos.detalleProducto')
 @yield('detalleprod')

 <!-- Modal Crear Producto -->
 @include('productos.create')
 @yield('createProductos')

 <script>
  
 </script>
@endsection
