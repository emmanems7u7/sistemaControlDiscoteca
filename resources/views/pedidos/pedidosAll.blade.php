@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Encabezado -->
            <div class="text-center mb-5">
                <h1 class="display-4">Administración de Ventas</h1>
                <p class="lead">En esta sección puedes generar reportes y administrar los pedidos de tus clientes.</p>
            </div>

            <!-- Filtro por fecha -->
            <div class="row">
                <div class="col-md-7">
                        <div class="card mb-4">
                        <h5 class="card-header">Filtrar por Fecha</h5>
                        <div class="card-body">
                            <form action="{{ route('pedidos.all') }}" method="GET">
                            @csrf
                                <div class="form-group">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha">
                                </div>
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </form>
                        </div>
                        </div>
                </div>
                <div class="col-md-5">
                    <div class="card mb-4">
                    <h5 class="card-header">Mas opciones</h5>
                        <div class="card-body">
                    <a href="{{route('pedidos.all')}}" class="btn btn-info">Obtener todos los pedidos</a>
                    </div>
                    </div>
                </div>
            </div>
           

            <!-- Contenedor de Pedidos -->
           
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    @if($fecha !== null)
                    <h5 class="font-weight-bold mb-0">Pedidos del día {{ $fecha }}</h5>
                    @else
                    <h5 class="font-weight-bold mb-0">Todos los pedidos por mesero</h5>

                    @endif
                </div>
                <div class="card-body">
                    <p class="lead">Haz clic en un pedido para validar y registrar la venta.</p>
                    <!-- Lista de Pedidos por Usuario -->
                    <div class="row">
                    @foreach($pedidosPorUsuario as $usuario => $pedidos)
                    
                    <div class="col-md-6">
                    <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="font-weight-bold">Pedidos de {{ $usuario }}</h5>
                            </div>
                            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                @if(count($pedidos) > 0)
                                    @foreach ($pedidos as $pedido)
                                    <a href="#" class="list-group-item list-group-item-action" onclick="confirmarValidacion('{{ $pedido->id }}')">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-1">Pedido: {{ $pedido->id }}</h5>
                                                <p class="mb-1">Descripción: {{ $pedido->nombre }}</p>
                                            </div>
                                            <div class="text-right">
                                                @if($pedido->estado == 'pendiente')
                                                    <span class="badge badge-warning">{{ $pedido->estado }}</span>
                                                @elseif($pedido->estado == 'completado')
                                                    <span class="badge badge-success">{{ $pedido->estado }}</span>
                                                @elseif($pedido->estado == 'cancelado')
                                                    <span class="badge badge-danger">{{ $pedido->estado }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-0">Cantidad: {{ $pedido->cantidad }}</p>
                                                <p class="mb-0">Mesa: {{ $pedido->mesa }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="mb-0">Fecha: {{ $pedido->fecha_pedido }}</p>
                                                <p class="mb-0">Monto: {{ $pedido->monto }}</p>
                                                <p class="mb-0">Pago: {{ $pedido->Tpago }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                @else
                                    <p>No hay pedidos para este usuario.</p>
                                @endif
                            </div>
                        </div>
                     </div>
                    
                   
                       
                        @endforeach
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .accordion .card-header {
    background-color: #f8f9fa;
}

.accordion .btn-link {
    color: #333;
    text-decoration: none;
    font-weight: bold;
}

.accordion .btn-link:hover {
    text-decoration: none;
}

.accordion .collapse .card-body {
    padding: 1.25rem;
}

</style>
<script>
    function confirmarValidacion(idPedido) {
        if (confirm("¿Estás seguro de que quieres validar el pedido?")) {
            // Si el usuario confirma, puedes hacer lo que necesites aquí, como enviar una solicitud AJAX para validar el pedido.
           
            window.location.href = "{{ route('pedidos.validar', ['id' => ':pedidoId']) }}".replace(':pedidoId', idPedido);
            console.log("Pedido validado:", idPedido);
        } else {
            // Si el usuario cancela, puedes realizar alguna otra acción o simplemente no hacer nada.
            console.log("Validación del pedido cancelada.");
        }
    }
</script>

<style>
    .pedido {
        border: 1px solid #dee2e6;
        border-radius: 10px;
    }

    .pedido .pedido-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .pedido .pedido-body {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .estado-pendiente {
        color: orange;
    }

    .estado-completado {
        color: green;
    }

    .estado-cancelado {
        color: red;
    }
</style>

@endsection
