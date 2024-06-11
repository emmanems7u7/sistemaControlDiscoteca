@section('editP')
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear producto -->
                <form id="formularioEditar"  onsubmit="event.preventDefault(); actualizarUsuario();" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-4">S
                            <label for="formFile" class="form-label">foto</label>
                            <input class="form-control" type="file" id="formFile2"  onchange="previewFile2()">
                        
                        <input type="hidden" id="photoHiddenInput2" name="imagen" value="">
                          
                        </div>
                        <div class="col-md-3">
                        <div id="previewPhoto2"></div>
                        </div>
                        <div class="col-md-4">
                            <label for="unidad" class="form-label">tipo</label>
                            <input type="text" class="form-control" id="unidad" name="unidad" required>
                        </div>
                        <div class="col-md-4">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <select class="form-control" id="proveedor" name="proveedor" required>
                                <option value="" disabled selected>Seleccione un Proveedor</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <option value="" disabled selected>Seleccione una Categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="precioC" class="form-label">Precio de Compra</label>
                            <div class="input-group">
                                <span class="input-group-text">Bs</span>
                                <input type="number" class="form-control" id="precioC" name="precioC" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="precioV" class="form-label">Precio de Venta</label>
                            <div class="input-group">
                                <span class="input-group-text">Bs</span>
                                <input type="number" class="form-control" id="precioV" name="precioV" required min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required min="0">
                        </div>
                    </div>
                    <input type="hidden" id="productoId" name="productoId" value="">
                    <div class="mb-3 text-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
     function obtenerDato(id) {
        // URL de la solicitud GET para obtener los datos del usuario
        let url = "{{ route('productosJson.show', ':id') }}".replace(':id', id);

        // Realizar la solicitud utilizando Fetch
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los datos del usuario');
                }
                return response.json();
            })
            .then(data => {
             

                document.getElementById('nombre').value = data.nombre;
                document.getElementById('productoId').value = data.id;
                document.getElementById('formFile2').src = '/storage/' + data.imagen;
                document.getElementById('unidad').value = data.unidad;
                document.getElementById('proveedor').value = data.proovedor_id;
                document.getElementById('categoria').value = data.categoria_id;
                document.getElementById('descripcion').value = data.descripcion;
                document.getElementById('precioC').value = data.precio_compra;
                document.getElementById('precioV').value = data.precio_venta;
                document.getElementById('stock').value = data.cantidad_stock;
           
            })
            .catch(error => {
                console.error('Error durante la solicitud:', error);
            });
    }
</script>
<script>
    function previewFile2() {
        const preview2 = document.querySelector('#previewPhoto2');
        preview2.innerHTML = '';

        const photoHiddenInput2 = document.querySelector('#photoHiddenInput2');
        const file2 = document.getElementById('formFile2').files[0];
        
        if ( /\.(jpe?g|png)$/i.test(file2.name) ) {
            const sizeInKB = Math.round(parseInt(file2.size)/1024);
            const sizeLimit= 5000; // 500 KB

            if (sizeInKB > sizeLimit) {
                alert(`Allowed file size: ${sizeLimit} KB.\nYour file size: ${sizeInKB} KB`);
            } else {
                const reader1 = new FileReader();

                reader1.addEventListener("load", function () {
                    var image2 = new Image();
                    image2.height = 100;
                    image2.title = file2.name;
                    // convert image2 file to base64 string
                    image2.src = this.result;
                    preview2.appendChild( image2 );
                    photoHiddenInput2.value = this.result;
                }, false);

                if (file2) {
                    reader1.readAsDataURL(file2);
                }
            }
        } else {
            alert('Allowed file types: jpeg, jpg, png');
        }
    }
    function actualizarUsuario() {
        var productoId = document.getElementById('productoId').value;
        var nombre = document.getElementById('nombre').value;
        var imagen = document.getElementById('photoHiddenInput2').value; // Obtén el valor del campo de archivo de imagen
        var unidad = document.getElementById('unidad').value;
        var proveedor = document.getElementById('proveedor').value;
        var categoria = document.getElementById('categoria').value;
        var descripcion = document.getElementById('descripcion').value;
        var precioC = document.getElementById('precioC').value;
        var precioV = document.getElementById('precioV').value;
        var stock = document.getElementById('stock').value;
        var productoId = document.getElementById('productoId').value;

        // URL de la solicitud PUT para actualizar los datos del usuario
        var url = "{{ route('productoJson.update', ':id') }}"; // Utilizamos el nombre de la ruta 'productoJson.update'
            url = url.replace(':id', productoId);
            var formData = {
        nombre: nombre,
        imagen: imagen,
        unidad: unidad,
        proveedor: proveedor,
        categoria: categoria,
        descripcion: descripcion,
        precioC: precioC,
        precioV: precioV,
        stock: stock,
        productoId: productoId
    };

      
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
console.log(formData);
     
        fetch(url, {
            method: 'PUT',
            body: JSON.stringify(formData),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al actualizar los datos del producto');
                }
                return response.json();
            })
            .then(data => {
             
                console.log('producto actualizado exitosamente');
             
                $('#editarModal').modal('hide');
                location.reload();
            })
            .catch(error => {
                console.error('Error durante la solicitud:', error);
            });
    }
</script>
@endsection