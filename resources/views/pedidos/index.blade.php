@extends('layouts.app')

@section('content')
<div class="container">
<h3 class="text-center text-primary">Area de Pedidos</h3>
<div class="row">
    <div class="col-md-4">
    <div class="card">
            <div class="card-header">
                
                <p class="text-muted">{{$fecha}}</p>
                <p class="font-weight-bold">{{ Auth::user()->name }} {{ Auth::user()->apepat }}  {{ Auth::user()->apemat }}</p>
            </div>
            <div class="card-body">
                <!-- Formulario para que el mesero realice el pedido -->
                <h5 for="pedido">Pedido:</h5>
                <form id="pedido" action="{{ route('pedidos.all') }}" method="POST">
                    @csrf
                <button type="button" class="btn btn-info mt-3" data-toggle="modal" data-target="#productosModal" onclick="GetProductos()">
                    Seleccionar Producto
                </button>
                    
                              <!-- Botón para abrir el modal de productos -->
             
                    <div class="form-group">
                       <input type="hidden" name="producto_id" id="id">
                          
                            <p id="nombre">Nombre</p>
                            <p id="precio">precio</p>  
                          
                    </div>
                    <div class="form-group">
                        <label for="Cantidad">Cantidad:</label>
                        <input type="number" class="form-control" id="Cantidad" name="cantidad"  placeholder="Ingrese Cantidad">
                    </div>
                    <div class="mb-3">
                <label for="mesa" class="form-label">Tipo de pago:</label>
                <select class="form-select" id="mesa" name="pago">
                    <option selected disabled="disabled">Selecciona tipo de pago</option>
                  
                    <option value="QR">QR</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                </select>
            </div>
                    <div class="mb-3">
                <label for="mesa" class="form-label">Selecciona una mesa:</label>
                <select class="form-select" id="mesa" name="mesa">
                    <option selected disabled="disabled">Elige una mesa</option>
                    @foreach ($mesas as $mesa )
                    <option value="{{$mesa->id}}">{{$mesa->nombre}}</option>
                    
                    @endforeach
                    
                    <!-- Agrega más opciones según tus necesidades -->
                </select>
            </div>
                    <button type="submit" class="btn btn-primary btn-block">Enviar Pedido</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title">Pedidos realizados por:  {{ Auth::user()->name }} {{ Auth::user()->apepat }}  {{ Auth::user()->apemat }}</h4>
        <p>De la fecha {{$fecha}}</p>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach ($pedidos as $pedido )
            
           
           
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <p><a href="{{route('pedidos.cancelar',['id'=>$pedido->id])}}">Cancelar pedido</a></p>
                            <h5 class="mb-1">Pedido: {{$pedido->id}}</h5>
                            <p class="mb-0">Descripción: {{$pedido->nombre}}</p>
                            <small class="text-muted">Fecha: {{$pedido->fecha_pedido}}</small>
                        </div>
                        <div>
                            @if($pedido->estado == 'pendiente')
                                <span class="badge badge-warning">{{$pedido->estado}}</span>
                            @elseif($pedido->estado == 'completado') 
                                <span class="badge badge-success">{{$pedido->estado}}</span>
                            @elseif($pedido->estado == 'cancelado') 
                                <span class="badge badge-danger">{{$pedido->estado}}</span>
                            @endif
                            <p class="mb-0">Cantidad: {{$pedido->cantidad}}</p>
                            <p class="mb-0">Monto: {{$pedido->monto}}</p>
                            <p class="mb-0">Pago: {{$pedido->Tpago}}</p>
                            <p class="mb-0">{{$pedido->mesa}}</p>
                        </div>
                    </li>

            @endforeach
            
        </ul>
    </div>
    </div>

    <div class="card">
    <div class="card-header">
        <h4 class="card-title">Todos los Pedidos realizados por: {{ Auth::user()->name }} {{ Auth::user()->apepat }} {{ Auth::user()->apemat }}</h4>
    </div>
    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
        <ul class="list-group">
            @foreach ($pedidosall as $pedido)
                <a href="#" class="list-group-item list-group-item-action">
                    <li class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Pedido: {{$pedido->id}}</h5>
                            <p class="mb-0">Descripción: {{$pedido->nombre}}</p>
                            <small class="text-muted">Fecha: {{$pedido->fecha_pedido}}</small>
                        </div>
                        <div>
                            @if($pedido->estado == 'pendiente')
                                <span class="badge badge-warning">{{$pedido->estado}}</span>
                            @elseif($pedido->estado == 'completado')
                                <span class="badge badge-success">{{$pedido->estado}}</span>
                            @elseif($pedido->estado == 'cancelado')
                                <span class="badge badge-danger">{{$pedido->estado}}</span>
                            @endif
                            <p class="mb-0">Cantidad: {{$pedido->cantidad}}</p>
                            <p class="mb-0">Monto: {{$pedido->monto}}</p>
                            <p class="mb-0">Pago: {{$pedido->Tpago}}</p>
                            <p class="mb-0">{{$pedido->mesa}}</p>
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
</div>

</div>
      

       

        <!-- Modal de productos -->
        @include('pedidos.productos')
        @yield('modal-productos')
    </div>

    
    @endsection