@extends('layouts.app')

@section('title', 'Correos')

@section('content')
<div class="container">
    <h1>Correos</h1>

    <p>Lista de Correos local. <a href="https://gsuite.google.com.mx/" target="_black">Ir a G-Suite</a></p>

    {{-- Pinta los errores en caso de haber --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>No se aplicaron los cambios</strong>

            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive pb-5">
        <table class="table table-striped text-center border-bottom">
            <thead>
                <tr class="thead-dark">
                    <th>ID</th>
                    <th>CORREO</th>
                    <th>PASSWORD</th>
                    <th>MEDIO SOLICITUD</th>
                    <th>TIPO</th>
                    <th>STATUS</th>
                    <th>SOLICITÓ</th>
                    <th>CREACIÓN</th>
                    <th class="pt-1 pb-1">
                        <div class="dropdown" data-item="">
                            <button id="menuRow" class="btn btn-primary dropdown-toggle w-100"
                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Agregar
                            </button>

                            {{-- Modales para registrar correos --}}
                            @include('emails.modal-add-email')
                            @include('emails.modal-employee')
                            @include('emails.modal-departament')
                            @include('emails.modal-other')
                            {{-- Modal de editar correo --}}
                            @include('emails.modal-edit')
                            
                            <div class="dropdown-menu shadow correo-actions" aria-labelledby="menuRow">
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addTrabajador">Trabajador</a>
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addAlumno">Alumno</a>
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addDepartamental">Departamental</a>
                                <a class="dropdown-item btn-primary" type="button" data-toggle="modal" data-target="#addOtro">Otro</a>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
    
            <tbody id="tbody_correos">
                @forelse ($emails as $email)
                    <tr>
                        <td>{{ $email->id }}</td>
                        <td>{{ $email->login }}</td>
                        <td>{{ $email->password }}</td>
                        <td>{{ $email->tasks->first()->medium }}</td>

                        {{-- Traduce el tipo de correo --}}
                        <td>{{ __(str_after($email->emailable_type, 'App\\')) }}</td>

                        <td>{{ $email->status }}</td>
                        <td>{{ $email->delivered_to }}</td>

                        {{-- Pinta la fecha de creacion --}}
                        <td title="{{ $email->created_at->format('h:m A') }}"
                        data-toggle="tooltip" data-placement="top">
                            {{ $email->created_at->format('d/m/Y') }}
                        </td>

                        <td class="pt-1 pb-1">
                            <div class="dropdown">
                                <button id="menuRow" class="btn btn-secondary dropdown-toggle w-100"
                                type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i> Sett
                                </button>
                                
                                <div class="dropdown-menu" aria-labelledby="menuRow">
                                    <a class="dropdown-item btn-secondary" href="{{ route('grupos.index') }}">Agregar grupo</a>
                                    <a class="dropdown-item btn-warning" type="button" data-toggle="modal" data-target="#editEmail">Editar </a>
                                    <a class="dropdown-item btn-danger" href="{{ route('correos.destroy', ['email' => $email->id]) }}">Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-warning">
                        No hay correos registrados
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .card-body {
            background: #ebebeb;
        }
        #accordion {
            margin-bottom: 5px;
        }
        .table td, .table th {
            cursor: default;
        }
        .modal {
            font-weight: normal;
        }
    </style>
@endpush