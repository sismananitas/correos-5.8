@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card col-md-5 p-4">
            <form action="{{ route('correos.store') }}" method="post" autocomplete="off">
                @csrf
                <input type="hidden" name="emailable_id" value="{{ $student->matricula }}">
                <input type="hidden" name="emailable_type" value="student">
                <input type="hidden" name="dependency" value="{{ $student->unidad }}">

                <h3>{{ $student->nombre . ' ' . $student->ap_paterno . ' ' . $student->ap_materno }}</h3>
                <h4>Curp: {{ $student->curp }}</h4>
                <hr>
        
                <p>
                    <strong>Status</strong> {{ $student->status }} <br>
                    <strong>Carrera</strong> {{ $student->carrera }} <br>
                    <strong>Unidad Académica</strong> {{ $student->unidad }} <br>
                    <strong>Grado</strong> {{ $student->grado }}
                </p>
        
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

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Registrar</button>
                    <a href="{{ route('correos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection