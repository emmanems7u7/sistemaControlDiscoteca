@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ventas</h1>
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Lista de ventas por dia</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Piso</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventaDia as $venta)
                    <tr>
                    <td>{{ $venta->fecha_literal }}</td>
                        <td>{{ $venta->piso->nombre }}</td>
                        <td>{{ $venta->monto }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
