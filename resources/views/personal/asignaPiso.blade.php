@section('asigna')
<!-- Modal -->
<div class="modal fade" id="assignFloorModal" tabindex="-1" aria-labelledby="assignFloorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignFloorModalLabel">Asignar Piso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="assignFloorForm" method="POST" action="{{route('asignar.piso')}}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="userId" name="user_id">
                    <div class="form-group">
                        <label for="userName">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="userName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email del Usuario</label>
                        <input type="text" class="form-control" id="userEmail" readonly>
                    </div>
                    <div class="form-group">
                        <label for="floor">Asignar Piso</label>
                        <select class="form-control" id="floor" name="floor_id">
                            @foreach($pisos as $piso)
                                <option value="{{ $piso->id }}">{{ $piso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function openAssignFloorModal(userId, userName, userEmail) {
        // Poblamos los campos del modal con los datos del usuario
        document.getElementById('userId').value = userId;
        document.getElementById('userName').value = userName;
        document.getElementById('userEmail').value = userEmail;

        // Abrimos el modal
        $('#assignFloorModal').modal('show');
    }
</script>
@endsection