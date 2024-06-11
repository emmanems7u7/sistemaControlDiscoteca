@section('pisos')
<div class="container">
    

    <table class="table mt-3">
        <thead>
            <tr>
              
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pisos as $piso)
                <tr>
                   
                    <td>{{ $piso->nombre }}</td>
                    <td>
                        
                        <a href="{{ route('pisos.edit', $piso->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('pisos.destroy', $piso->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection