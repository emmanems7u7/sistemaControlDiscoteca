@foreach($ventas as $venta)
    <div class="card mb-3">
        <div class="card-header">
            
            <div class="row">
            <div class="col-md-6 text-right">
            <h5 class="card-title ">Detalles del Día</h5>
            </div>
         
                <div class="col-md-6 text-right">
                <form method="POST" action="{{ route('Reporte.ventas') }}">
                        @csrf 
                       
                            <input type="hidden" name="venta[]" value="{{ json_encode($venta) }}">
                            <input type="hidden" name="fecha" value="{{ json_encode($fecha) }}">
                             

                        <button type="submit" class="btn btn-success">Generar PDF</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Cajero Validador:</strong> {{ $venta['nombre'] }}</p>
                    <p><strong>Descripción:</strong> Reporte diario de ventas</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Fecha:</strong> {{$fecha}}</p> <!-- Ajusta la fecha según corresponda -->
                </div>
            </div>
        </div>
        
        <div class="card-body">
            @if(empty($venta['ventas']))
                <p><strong>No existen pedidos validados:</strong></p>
            @else
                @foreach($venta['ventas'] as $registro)
                    <div class="venta" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                        <div class="row">
                            <div class="col-md-8">
                                <p><strong>Codigo de pedido:</strong> {{ $registro->codP }}</p>
                                <p><strong>Nombre del Mesero:</strong> {{ $registro->mesero }}</p>
                                <p><strong>Producto:</strong> {{ $registro->nombre }}</p>
                                <p><strong>Cantidad:</strong> {{ $registro->cantidad }}</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <p style="color: #888;"><strong>Fecha:</strong> {{ $registro->fecha_venta }}<strong> Hora:</strong> {{ $registro->hora_venta }}</p>
                                <p><strong>Monto:</strong> Bs{{ $registro->monto }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="col-md-12 text-right">
                <p><strong>Monto Total:</strong>Bs {{$venta['montoT'] }}</p>
            </div>
        </div>
    </div>
@endforeach
@if($guardar)
<div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <form action="{{route('venta.guardar')}}" method="POST">
                    @csrf
                        <div class="row">
                        <h5 class="card-title">Monto Total de Ventas</h5>
                        
                            <div class="col-md-6">
                    
                        <p class="card-text">Fecha: {{ $fecha}}</p>
                            </div>
                            <div class="col-md-6">
                            <p class="card-text text-right">Monto Total de ventas: Bs{{$montoF}}</>
                            
                            </div>
                        </div>
                       @role('administrador')
                        <input type="hidden" name="montoT" value="{{$montoF}}">
                            <input type="hidden" name="fecha" value="{{$fechaN}}">
                            <input type="hidden" name="fechal" value="{{$fecha}}">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif