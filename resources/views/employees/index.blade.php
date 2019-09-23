@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
<div class="container">
    <h1>Empleados</h1>

    <div class="table-responsive">
        {{-- <tbody id="tbody_trabajadores">
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->numconemp }}</td>
                    <td>{{ $employee->nombre . ' ' . $employee->apepat }}</td>
                    <td>{{ $employee->dependencia }}</td>

                    <td class="pt-1 pb-1">
                        <div class="dropdown" data-item="{{ $employee->numconemp }}">
                            <button id="menuRow{{ $employee->nombre }}" class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                settings
                            </button>
                            
                            <div class="dropdown-menu shadow trabajador-actions" aria-labelledby="menuRow{{ $employee->nombre }}">
                                <a class="dropdown-item btn-warning" type="button" data-toggle="modal" data-target="#editTrabajador">Editar</a>
                                <a class="dropdown-item btn-danger" href="{$base_url}trabajador/borrar/{{ $employee->numconemp }}">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody> --}}
        <table-employees-component></table-employees-component>
    </div>
</div>
@endsection