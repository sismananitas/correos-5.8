@extends('layouts.app')

@section('title', 'Correos')

@section('content')
<div class="container">
    <h1>Correos</h1>
    <p>Lista de Correos local. <a href="https://gsuite.google.com.mx/" target="_black">Ir a G-Suite</a></p>

    {{-- Tabla de correos --}}
    <emails-component></emails-component>
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