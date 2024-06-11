@extends('layouts.app')

@section('content')
    <h1>Editar usuario: {{ $user->name }}</h1>

    <form method="POST" action="{{ route('rolUser.actualizar', $user) }}">
        @csrf
        @method('PUT')

    

        <div class="mb-3">
            <label for="roles">Roles:</label>
            <select class="form-control" id="roles" name="roles[]" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if (in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar usuario</button>
    </form>
@endsection
