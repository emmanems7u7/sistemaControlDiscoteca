@include('layouts.menu')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 
    'resources/js/app.js',
    'resources/sass/style.scss',
    'resources/js/jquery.min.js',
        'resources/js/popper.js',
        'resources/js/bootstrap.min.js',
        'resources/js/main.js'
    ])
   
   
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
       
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
<div class="wrapper d-flex align-items-stretch">

@auth                         
                               
			<nav id="sidebar" class="active">
				<h1><a href="index.html" class="logo">Logo</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="{{ url('/home') }}"><span class="fa fa-home"></span> Inicio</a>
          </li>
          @role('administrador')
          <li>
              <a href=" {{ route('configuracion.index') }}"><span class="fa fa-cogs"></span> Configuracion</a>
             

          </li>
          @endrole
          <li>
            <a href="{{ route('pedidos.index') }}"><span class="fa fa-sticky-note"></span> Pedidos</a>
          </li>
          @role('administrador|cajero')
          <li>
            <a href=" {{ route('pedidos.all') }}"><span class="fa fa-chart-line"></span> Control de pedidos</a>
          </li>
        

          <li>
            <a href="{{ route('ventas.index') }}"><span class="fa fa-paper-plane"></span>ventas</a>
          </li>
        </ul>
@endrole
        <div class="footer">
        	<p>
					 Sistema de control
					</p>
        </div>
    	</nav>
        @endauth
        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">
      
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Sistema de Control') }}
                </a>
                @auth
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            @endauth
                <button class="navbar-toggler btn  d-inline-block d-lg-none ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
           
           

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
              
              <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a href="{{route('cambiar_contrasena')}}">Cambiar contraseña</a>

                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
          </div>
        </nav>
        <main class="py-4">
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

       
            
          
            
           

            @yield('content')
           
        </div>
    
            
        </main>
       
      </div>
		</div>

  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
