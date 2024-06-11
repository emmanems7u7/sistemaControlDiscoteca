@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">{{ __('Inicio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <h4 class="font-weight-bold">{{ __('Bienvenido ') }} {{ Auth::user()->name }}</h4>
                    <p>{{ __('Aca encontraras diferentes herramientas para administrar la empresa') }}</p>

                    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('productos.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-box-open fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Productos') }}</h5>
                    </div>
                </a>
            </div>
        </div>
      
        @role('administrador')
        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('configuracion.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-cogs fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Configuracion') }}</h5>
                    </div>
                </a>
            </div>
        </div>

     
     

       

        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('user.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-user-tag fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Administrar personal') }}</h5>
                    </div>
                </a>
            </div>
        </div>

@endrole
        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('pedidos.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-cocktail fa-3x mb-3"></i>
                        <h5 class="card-title">{{ __('Pedidos') }}</h5>
                    </div>
                </a>
            </div>
        </div>
        @role('administrador|cajero')
        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('pedidos.all') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-chart-line fa-3x mb-3"></i>

                        <h5 class="card-title">{{ __('Control de pedidos') }}</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('ventas.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-wallet fa-3x mb-3"></i>

                        <h5 class="card-title">{{ __('Control de ventas') }}</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center h-100" data-aos="zoom-in">
                <a href="{{ route('ventasR.index') }}" class="btn btn-outline-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-wallet fa-3x mb-3"></i>

                        <h5 class="card-title">{{ __('Registro de ventas') }}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endrole
    </div>

    <div class="row mt-5">
        <div class="col-md-6 mb-4" data-aos="fade-right">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notificaciones</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach(Auth::user()->unreadNotifications as $notification)

                                <li class="list-group-item ">
                                @if ($notification->type === 'App\Notifications\RegistroUsuario')                                  
                                <a href="#" class="text-black float-right {{$notification->data['btn-action']}}" data-toggle="modal" data-target="#myModal" onclick="cargarDato('{{$notification->id}}', '{{$notification->data['UserId']}}', '{{ route($notification->data['action_url'], ['id' => ':id', 'UserId' => ':userid']) }}')">
                                @else
                            
                            <a href="{{ route($notification->data['action_url'],$notification->id) }}" class="text-black float-right">
                                @endif
                                    <strong>{{ $notification->created_at->diffForHumans() }}</strong> - 
                                  
                                        {{ $notification->data['message'] }}
                                 
                                    
                                    </a>
                                </li>
                                
                            @endforeach
                       
                       
                    </ul>
                </div>
            </div>
        </div>
       
   


                   
                </div>
            </div>
        </div>
    </div>
</div>
@include('personal.modalRol')
@yield('modalP')
</div>

@endsection
