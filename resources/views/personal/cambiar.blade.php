@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cambiar Contraseña</div>

                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('actualizar_contrasena') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="contrasena_actual" class="col-md-4 col-form-label text-md-right">Contraseña Actual</label>

                                <div class="col-md-6">
                                    <input id="contrasena_actual" type="password" class="form-control" name="contrasena_actual" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nueva_contrasena" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>

                                <div class="col-md-6">
                                    <input id="nueva_contrasena" type="password" class="form-control" name="nueva_contrasena" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="nueva_contrasena_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Cambiar Contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
