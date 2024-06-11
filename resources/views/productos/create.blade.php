@section('createProductos')
<div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearProductoModalLabel">Crear Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear producto -->
                <form id="crearProductoForm" action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-4">
                            <label for="formFile" class="form-label">foto</label>
                            <input class="form-control" type="file" id="formFile" onchange="previewFile1()">
             
                             <input type="hidden" id="photoHiddenInput1" name="imagen" value="">
                        </div>
                        <div class="col-md-3">
                        <div id="previewPhoto"></div>
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
    function previewFile1() {
        
        const preview = document.querySelector('#previewPhoto');
        preview.innerHTML = '';

        const photoHiddenInput1 = document.querySelector('#photoHiddenInput1');
        const file = document.getElementById('formFile').files[0];
        
        if ( /\.(jpe?g|png)$/i.test(file.name) ) {
           
            const sizeInKB = Math.round(parseInt(file.size)/1024);
            const sizeLimit= 5000; // 500 KB

            if (sizeInKB > sizeLimit) {
                alert(`Allowed file size: ${sizeLimit} KB.\nYour file size: ${sizeInKB} KB`);
            } else {
                const reader = new FileReader();

                reader.addEventListener("load", function () {
                    var image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    // convert image file to base64 string
                    image.src = this.result;
                    preview.appendChild( image );
                    photoHiddenInput1.value = this.result;
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        } else {
            alert('Allowed file types: jpeg, jpg, png');
        }
    }
</script>
@endsection