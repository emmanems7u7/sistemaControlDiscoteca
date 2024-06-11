<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  
  </head>
  <body>
  <style>
      .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .card-header {
        background-color: #f0f0f0;
        padding: 5px;
        border-bottom: 1px solid #ccc;
    }
    
    .card-body {
       
        padding: 10px;
        
    }
    
    .venta {
        border-bottom: 1px solid #ccc;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    
    .venta p {
        margin-bottom: 5px;
       
        font-size: 12px; /* Tamaño de fuente reducido */
    }
    
    .venta strong {
        font-weight: bold;
    }
    .text-rightt{
        position: relative; /* Establece la posición relativa */
        top: -100px; /* Mueve el div 50px hacia abajo desde su posición original */
        left: 550px; /* Mueve el div 100px hacia la derecha desde su posición original */
    }
    .text-righttt{
        position: relative; /* Establece la posición relativa */
      
        left: 520px; /* Mueve el div 100px hacia la derecha desde su posición original */
    }
    .venta
    {
        width: 97%; /* Ancho del div */
            height: 85px; /* Altura del div */
            
           
    }
    .encabezado {
             /* Color de fondo */
            color: #6c757d; /* Color de texto */
            padding: 20px; /* Espaciado interno */
            text-align: center; /* Alineación de texto */
            margin-bottom: 20px; /* Espaciado inferior */
        }
        .fecha {
            font-style: italic; /* Texto en cursiva */
            color: #6c757d; /* Color de texto */
        }
</style>
<div class="container">
        <!-- Encabezado con título y fecha -->
        <div class="encabezado">
            <h1>Reporte de Registro de Ventas</h1>
            <p class="fecha">{{ $fecha }}</p>
        </div>
        <!-- Contenido del cuerpo de la página aquí -->
    </div>
  <div class="container-fluid">
  <div class="card">
    

    
    <div class="card-header">
        <h5 class="card-title text-center">Detalles de las Ventas</h5>
        <p><strong>Cajero Validador</strong> {{ $ventas['nombre'] }}</p>
       
    </div>
    <div class="card-body">
        @if (empty($ventas['ventas']))
            <p>No existen ventas registradas.</p>
        @else
        @php
            $contador = 0;
        @endphp
            @foreach ($ventas['ventas'] as $venta)
            @if ($contador  == 5 && $contador != 0)
                <!-- Agregar un salto de página después de cada 5 iteraciones -->
                @php
            $contador = 0;
        @endphp
                <div style="page-break-before: always;"></div>
            @endif
                <div class="venta" style="border-bottom: 1px solid #ccc; padding-bottom: -300px;">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Código de pedido:</strong> {{ $venta['codP'] }}</p>
                            <p><strong>Nombre del Mesero:</strong> {{ $venta['mesero'] }}</p>
                            <p><strong>Producto:</strong> {{ $venta['nombre'] }}</p>
                            <p><strong>Cantidad:</strong> {{ $venta['cantidad'] }}</p>
                        </div>
                        <div class="col-md-6 car text-rightt">
                            <p><strong>Fecha:</strong> {{ $venta['fecha_venta'] }}</p>
                            <p><strong>Hora:</strong> {{ $venta['hora_venta'] }}</p>
                            <p><strong>Monto:</strong> Bs {{ $venta['monto'] }}</p>
                        </div>
                    </div>
                </div>
                @php
                $contador++;
            @endphp
            @endforeach
            
        @endif
    </div>
   
   
     
    </div>
    <div class="card">
        <div class="card-body">
        <div class="row">
    <div class="col-md-6 text-righttt">
     <p><strong>Monto Total:</strong> Bs {{ $ventas['montoT'] }}</p>
                        </div>
  
    </div>
        </div>
    </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  
  </body>
</html>







