@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
<div class="container">
    <h1>Empleados</h1>

    <div class="table-responsive">
        <table class="table table-striped text-center border-bottom">
            <thead>
                <tr class="thead-dark">
                    <th>N. CONTROL</th>
                    {{-- <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                    <th>STATUS</th> --}}
                    <th>ACTUALIZADO</th>
                    <th>CREADO</th>
                    <th class="pt-1 pb-1"><button class="btn btn-primary col-12" type="button" data-toggle="modal" data-target="#addTrabajador">Agregar</button></th>
                </tr>
            </thead>
        
            <tbody id="tbody_trabajadores">
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->control_number }}</td>
                        {{-- <td>{{ $employee->nombre }}</td>
                        <td>{{ $employee->apellidos }}</td>
                        <td>{{ $employee->status }}</td> --}}

                        <td title="{{ $employee->updated_at->format('h:i A') }}" data-toggle="tooltip">
                            {{ $employee->updated_at->format('d-m-Y') }}
                        </td>
                        
                        <td title="{{ $employee->created_at->format('h:i A') }}" data-toggle="tooltip">
                            {{ $employee->created_at->format('d-m-Y') }}
                        </td>

                        <td class="pt-1 pb-1">
                            <div class="dropdown" data-item="{{ $employee->id }}">
                                <button id="menuRow{{ $employee->nombre }}" class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    settings
                                </button>
                                
                                <div class="dropdown-menu shadow trabajador-actions" aria-labelledby="menuRow{{ $employee->nombre }}">
                                    <a class="dropdown-item btn-warning" type="button" data-toggle="modal" data-target="#editTrabajador">Editar</a>
                                    <a class="dropdown-item btn-danger" href="{$base_url}trabajador/borrar/{{ $employee->id }}">Eliminar</a>
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