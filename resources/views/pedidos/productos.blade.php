@section('modal-productos')
<div class="modal fade" id="productosModal" tabindex="-1" role="dialog" aria-labelledby="productosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productosModalLabel">Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                    <!-- Campo de búsqueda -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                            <label for="">Buscar</label>
                                <input type="text" class="form-control" id="busquedaInput" placeholder="Escribe el nombre del producto">
                            </div>
                            <div class="col-md-2">
                           

                                <a href="" class="btn btn-info">Buscar</a>
                            </div>
                            <div class="col-md-6">
                                <!-- Filtro por categoría -->
                                <div class="mb-3">
                                    <label for="categoriaSelect">Filtrar por Categoría:</label>
                                    <select class="form-select" id="categoriaSelect" >
                                    <option value=""  selected="true" disabled="disabled">Seleccione Categoria</option>
                                        @foreach ($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                        @endforeach
                                        
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Tarjetas de productos -->
                    <div class="row">
                        <!-- Ejemplo de tarjeta de producto -->
                       
                         
                           <div id="productos-container">
                           
                          
                         
                           </div>
                       
                        <!-- Agrega más tarjetas de productos aquí -->
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        #productos-container {
  display: flex; 
  flex-wrap: wrap; /* Allow wrapping to multiple rows if needed */
  height: 400px; /* Set the desired height */
  overflow-y: auto; /* Enable vertical scrolling */
}
.card-img-top {
    width: 60%;
    height: 40%;
  
    display: flex; /* Enable Flexbox layout */
  justify-content: center; /* Center horizontally */
  align-items: center; /* Center vertically */
}
    </style>
    <script>
 function GetProductos() {
    
            
           const productosContainer = document.getElementById('productos-container');
           let url = "{{ route('extrae.show', 3) }}";
           productosContainer.innerHTML="";
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    data.forEach(producto => {

                     
                        const card = document.createElement('div');
                        card.classList.add('card', 'col-sm-3','mr-2');
                        
                        const img = document.createElement('img');
                     
                        img.src = '/storage'+producto.imagen ;
                       
                        img.alt = producto.nombre;
                        img.classList.add('card-img-top');

                        const cardBody = document.createElement('div');
                        cardBody.classList.add('card-body');

                        const cardTitle = document.createElement('h5');
                        cardTitle.classList.add('card-title');
                        cardTitle.textContent = producto.nombre;

                        const cardTextPrecio = document.createElement('p');
                        cardTextPrecio.classList.add('card-subtitle');
                        cardTextPrecio.classList.add( 'mb-2');
                        cardTextPrecio.classList.add('text-muted');
                        cardTextPrecio.textContent = `Precio: Bs${producto.precio_venta}`;

                        const cardTextCantidad = document.createElement('p');
                        cardTextCantidad.classList.add('card-subtitle');
                        cardTextCantidad.classList.add('mb-2');
                        cardTextCantidad.classList.add('text-muted');
                        cardTextCantidad.textContent = `Cantidad: ${producto.cantidad_stock}`;

                        const cardTextUnidad = document.createElement('p');
                        cardTextUnidad.classList.add('card-subtitle');
                        cardTextUnidad.classList.add('mb-2');
                        cardTextUnidad.classList.add('text-muted');
                        cardTextUnidad.textContent = `Unidad: ${producto.unidad}`;
                        const cardButton = document.createElement('button'); // Create a button element
                        cardButton.textContent = 'Seleccionar';
                        cardButton.classList.add('btn', 'btn-primary');
                        cardButton.setAttribute('data-dismiss', 'modal');
                        cardButton.addEventListener('click', function() {
                       

                            document.getElementById('id').value = producto.id;
                            document.getElementById('nombre').textContent  ='Nombre:'+" "+ producto.nombre;
                            document.getElementById('precio').textContent  = 'Precio:'+" "+producto.precio_venta;
                            alert('Seleccionado');
                            
                            const modal = document.getElementById('productosModal');
                          
                        });
                       
                        cardBody.appendChild(cardTitle);
                        cardBody.appendChild(cardTextPrecio);
                        cardBody.appendChild(cardTextCantidad);
                        cardBody.appendChild(cardTextUnidad);
                        cardBody.appendChild(cardButton);
                        card.appendChild(img);
                        card.appendChild(cardBody);

                        productosContainer.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los detalles del producto:', error);
                });

            }   

            const categoriaSelect = document.getElementById('categoriaSelect');

                categoriaSelect.addEventListener('change', function(event) {
                const selectedCategory = event.target.value;
               
                GetProductoCategoria(selectedCategory);
                });


                function GetProductoCategoria(id) {
    const productosContainer = document.getElementById('productos-container');
    let url = "{{ route('extraeCategoria.show', ':id') }}";
    url = url.replace(':id', id);

    productosContainer.innerHTML = "";

    fetch(url)
        .then(response => response.json())
        .then(data => {
            data.forEach(producto => {
                const card = document.createElement('div');
                card.classList.add('card', 'col-sm-3', 'mr-2', 'mb-3');

                const img = document.createElement('img');
                img.src = `/storage/${producto.imagen}`;
                img.alt = producto.nombre;
                img.classList.add('card-img-top');

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');

                const cardTitle = document.createElement('h5');
                cardTitle.classList.add('card-title');
                cardTitle.textContent = producto.nombre;

                const cardTextPrecio = document.createElement('p');
                cardTextPrecio.classList.add('card-subtitle', 'mb-2', 'text-muted');
                cardTextPrecio.textContent = `Precio: Bs${producto.precio_venta}`;

                const cardTextCantidad = document.createElement('p');
                cardTextCantidad.classList.add('card-subtitle', 'mb-2', 'text-muted');
                cardTextCantidad.textContent = `Cantidad: ${producto.cantidad_stock}`;

                const cardTextUnidad = document.createElement('p');
                cardTextUnidad.classList.add('card-subtitle', 'mb-2', 'text-muted');
                cardTextUnidad.textContent = `Unidad: ${producto.unidad}`;

                cardBody.appendChild(cardTitle);
                cardBody.appendChild(cardTextPrecio);
                cardBody.appendChild(cardTextCantidad);
                cardBody.appendChild(cardTextUnidad);

                card.appendChild(img);
                card.appendChild(cardBody);

                productosContainer.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error al obtener los detalles del producto:', error);
        });
}

    </script>
    
@endsection