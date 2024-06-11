@section('proveedores')
<div class="container">
   

    <table class="table table-hover table-responsive">
        <thead>
            <tr>
            
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
                <tr>
                    
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->persona_contacto }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>
                        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection