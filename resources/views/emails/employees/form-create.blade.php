@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <form action="" method="post" autocomplete="off">
            @csrf
            <input type="hidden" name="num_control" value="{{ $num_control }}">
    
            <label for="usuario">Plazas activa</label>
    
            <div class="form-group">
                @foreach ($plazas as $plaza)
                    <label for="{{ $plaza->cvedep }}">{{ $plaza->cvedep }} {{ $plaza->nomdep }}</label>
                    <input type="radio" name="plaza" id="{{ $plaza->cvedep }}" value="{{ $plaza->nomdep }}" checked>
                @endforeach
            </div>
    
            <div class="form-row mt-2">
                <div class="col">
                    <label for="client_name">Solicitante del cambio</label>
                    <input id="solicitante" class="form-control" type="text" name="client_name" value="{{ old('client_name') }}" required>
                </div>
    
                <div class="col">
                    <label for="delivered_to">Entregado a</label>
                    <input class="form-control" type="text" name="delivered_to" value="{{ old('delivered_to') }}" required>
                </div>
            </div>                    
    
            <label for="login">Login</label>
            <input id="login" class="form-control" type="email" name="login" value="{{ old('login') }}" required>
    
            <label for="password">Contraseña</label>
            <input id="password" class="form-control" type="text" name="password" required>
    
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
                        <option value="Activo">Activo</option>
                        <option value="Suspendido">Suspendido</option>
                        <option value="Eliminado">Eliminado</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Registrar</button>
            <a href="{{ route('correos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection