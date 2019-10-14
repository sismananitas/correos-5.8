@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-6 mt-3 p-4">
        <h1>{{ $correo->login }}</h1>
        <h3>{{ $emailable->nombre . ' ' . $emailable->apepat . ' ' . $emailable->apemat }}</h3>
        <hr>

        @include('emails.show-errors')

        @if(session('success'))
            {{ session('success') }}
        @endif

        <form id="formEditar" action="{{ route('correos.update', ['correo' => $correo->id]) }}" method="POST" autocomplete="off">
            @csrf @method('PUT')

            <label for="login">Login</label>
            <input id="login" class="form-control" type="email" name="login" required value="{{ $correo->login }}">

            <label for="password">Contraseña</label>
            <input id="password" class="form-control" type="text" name="password" required value="{{ $correo->password }}">

            <label for="solicitante">Solicitante del cambio</label>
            <input id="solicitante" class="form-control" type="text" name="solicitante" required>

            <div class="form-row">
                <div class="col">
                    <label for="medium">Medio de solicitud</label>
                    <select class="form-control" name="medium" id="medium" value="{{ old('medium') }}" required>
                        <option value="">- Elegir -</option>
                        <option value="Ticket">Ticket</option>
                        <option value="Oficio">Oficio</option>
                    </select>
                </div>

                <div class="col">
                    <label for="status">Estatus</label>
                    <select class="form-control" name="status" id="status" value="{{ old('status') }}" required>
                        <option value="">- Elegir -</option>
                        <option value="Activo" @if($correo->status == 'Activo') selected @endif>Activo</option>
                        <option value="Suspendido" @if($correo->status == 'Suspendido') selected @endif>Suspendido</option>
                        <option value="Eliminado" @if($correo->status == 'Eliminado') selected @endif>Eliminado</option>
                    </select>
                </div>
            </div> 
            
            <div class="my-4">
                <button class="btn btn-warning" type="submit">Actualizar</button>
                <a class="btn btn-secondary" href="{{ route('correos.index') }}">Cancelar</a>
            </div>
        </form>

        <a class="btn btn-primary" href="">Cambiar propietario</a>
    </div>
</div>
@endsection