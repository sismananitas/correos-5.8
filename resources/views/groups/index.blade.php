@extends('layouts.app')

@section('title', 'Grupos')

@section('content')
<div class="container">
    <h1>Grupos</h1>

    <div class="table-responsive pb-5">
        <table class="table table-striped text-center border-bottom">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>GRUPO</th>
                    <th>CREACIÓN</th>
                    <th>ACTUALICIÓN</th>
                    <th class="w-10 pt-1 pb-1">
                        <button class="w-100 btn btn-primary" type="button" data-toggle="modal" data-target="#addGrupo">Agregar</button>
                    </th>
                </tr>
            </thead>
    
            <tbody id="tbody_grupos">
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->created_at }}</td>
                        <td>{{ $group->updated_at }}</td>
                        <th class="pt-1 pb-1">
                            <div class="dropdown" data-id="{$group->id}">
                                <button id="menuRow{$group->nombre}" class="btn btn-secondary dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    settings
                                </button>
                                
                                <div class="dropdown-menu shadow group-actions" aria-labelledby="menuRow{$group->nombre}">
                                    <a class="dropdown-item" href="{$base_url}group/view/{$group->id}">Agregar usuarios</a>
                                    <a class="dropdown-item btn-warning" href="#" data-toggle="modal" data-target="#editgroup">Editar</a>
                                    <a class="dropdown-item btn-danger" href="{$base_url}groups/eliminar/{$group->id}">Eliminar</a>
                                </div>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection