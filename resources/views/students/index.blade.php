@extends('layouts.app')

@section('title', 'Alumnos')

@section('content')
<div class="container">
    <h1>Alumnos</h1>

    <div class="table-responsive pb-5">
        <table class="table table-striped text-center border-bottom">
            <thead>
                <tr class="thead-dark">
                    <th>N. CONTROL</th>
                    {{-- <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>STATUS</th> --}}
                    <th>ACTUALIZADO</th>
                    <th>CREADO</th>
                    <th class="pt-1 pb-1"><button class="btn btn-primary col-12" type="button" data-toggle="modal" data-target="#addAlumno">Agregar</button></th>
                </tr>
            </thead>
    
            <tbody id="tbody_alumnos">
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->enrollment }}</td>
                        {{-- <td>{{ $student->nombre }}</td>
                        <td>{{ $student->apellidos }}</td>
                        <td>{{ $student->status }}</td> --}}
                        <td title="{{ $student->updated_at->format('h:i A') }}" data-toggle="tooltip">{{ $student->updated_at->format('d-m-Y') }}</td>
                        <td title="{{ $student->created_at->format('h:i A') }}" data-toggle="tooltip">{{ $student->created_at->format('d-m-Y') }}</td>
                        <td class="pt-1 pb-1">
                            <div class="dropdown">
                                <button id="menuRow{{ $student->nombre }}" class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    settings
                                </button>
                                
                                <div class="dropdown-menu shadow alumno-actions" aria-labelledby="menuRow{{ $student->nombre }}" data-id="{{ $student->id }}">
                                    <a class="dropdown-item btn-warning" type="button" data-toggle="modal" data-target="#editAlumno">Editar</a>
                                    <a class="dropdown-item btn-danger" href="{$base_url}alumno/borrar/{{ $student->id }}">Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection