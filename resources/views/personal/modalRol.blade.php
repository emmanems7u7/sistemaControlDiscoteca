@section('modalP')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Usuarios sin rol asignado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" name="idnoti" id="noti">
                    <input type="hidden" name="user" id="user">
                </div>
                <div class="modal-body">
                    <table class="table" id="tablaUser">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            
                            <!-- Más filas aquí -->
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="roles">Seleccionar Rol:</label>
                        <select class="form-control" id="roles">
                            <option value="admin">Administrador</option>
                            <option value="editor">Editor</option>
                            <option value="viewer">Visualizador</option>
                            <!-- Más roles aquí -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="asignarRol()">Asignar Rol</button>
                </div>
            </div>
        </div>
    </div>


    <script>
   function cargarDato(notificationId, userId, ruta) {
    console.log('Notification ID:', notificationId);
    console.log('User ID:', userId);
    console.log('Action URL:', ruta);

    var url = ruta.replace(':id', notificationId).replace(':userid', userId);
   
    fetch(url)
        .then(response => response.json())
        .then(data => {
           
            console.log(data);
           
            var tbody = document.getElementById('tablaUser').getElementsByTagName('tbody')[0];
             document.getElementById('noti').value = data.id;
             document.getElementById('user').value = data.user.id;

            tbody.innerHTML = '';

            var tr = document.createElement('tr');

            var tdNombre = document.createElement('td');
            tdNombre.textContent = data.user.name;
            tr.appendChild(tdNombre);

            var tdApellidos = document.createElement('td');
            tdApellidos.textContent = data.user.apepat +" "+data.user.apemat ;
            tr.appendChild(tdApellidos);
            
            tbody.appendChild(tr);

            var select = document.getElementById('roles');
            select.innerHTML = '';
            data.roles.forEach(role => {
                var option = document.createElement('option');
                option.value = role.id; 
                option.textContent = role.name; 
                select.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
}
function asignarRol() {
    var rol = document.getElementById('roles').value;
    var noti = document.getElementById('noti').value;
    var user = document.getElementById('user').value;
    console.log('User ID:', user);
    console.log('Notification ID:', noti);
    console.log('Role ID:', rol);

    // Aquí asumo que 'UsuarioAsigna.show' es la ruta correcta que deseas usar
    var url = "{{ route('UsuarioAsigna.show', ['id' => ':id', 'UserId' => ':userid', 'rol' => ':rol']) }}";
    url = url.replace(':id', noti).replace(':userid', user).replace(':rol', rol);

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            alert("Asignado correctamente");
        })
        .catch(error => console.error('Error:', error));
}
</script>
@endsection