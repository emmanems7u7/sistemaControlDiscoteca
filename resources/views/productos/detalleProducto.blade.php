@section('detalleprod')
<div class="modal fade" id="detalleProductoModal" tabindex="-1" role="dialog" aria-labelledby="detalleProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detalleProductoModalLabel">Detalle del Producto</h5>
                <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="ruta_imagen.jpg" class="img-fluid rounded mb-3" alt="Imagen del Producto">
                    </div>
                    <div class="col-md-8">
                        <h3 id="productoNombre" class="mb-3">Nombre del Producto</h3>
                        <p id="productoDescripcion">Descripción detallada del producto aquí.</p>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>Categoría:</strong> <span id="productoCategoria">Categoría del Producto</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Proveedor:</strong> <span id="productoProveedor">Proveedor del Producto</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Precio de Compra:</strong> <span id="productoPrecioCompra">$0.00</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Precio de Venta:</strong> <span id="productoPrecioVenta">$0.00</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Cantidad en Stock:</strong> <span id="productoCantidadStock">0</span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Unidad:</strong> <span id="productoUnidad">Unidad del Producto</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
     function mostrarDetalleProducto(producto) {
    
        // Asignar los datos del producto a los elementos del modal
        document.getElementById('productoNombre').innerText = producto.nombre;
        document.getElementById('productoDescripcion').innerText = producto.descripcion;

      
       
        document.getElementById('productoPrecioCompra').innerText = 'bs' + producto.precio_compra.toFixed(2);
        document.getElementById('productoPrecioVenta').innerText = 'bs' + producto.precio_venta.toFixed(2);
        document.getElementById('productoCantidadStock').innerText = producto.cantidad_stock;
        document.getElementById('productoUnidad').innerText = producto.unidad;

        // Actualizar la imagen del producto
        document.querySelector('#detalleProductoModal img').src = producto.imagen;
        let url = "{{ route('categoria.extraeP', ':id') }}";
    // Reemplazar el marcador de posición :id con el ID real del producto
        url = url.replace(':id', producto.categoria);

        fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById('productoCategoria').innerText = data.nombre;
        })
        .catch(error => {
            console.error('Error al obtener los detalles del producto:', error);
        });


        let url2 = "{{ route('proveedor.extraeP', ':id') }}";
   
        url2 = url2.replace(':id', producto.proveedor);

        fetch(url2)
        .then(response => response.json())
        .then(data2 => {
            
            document.getElementById('productoProveedor').innerText = data2.nombre;
        })
        .catch(error => {
            console.error('Error al obtener los detalles del proveedor:', error);
        });
    }

</script>
@endsection