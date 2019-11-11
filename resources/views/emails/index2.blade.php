@extends('layouts.app')

@section('title', 'Correos')

@section('content')
<div class="container">
    <h1>Correos</h1>

    <p>Lista de Correos local. <a href="https://gsuite.google.com.mx/" target="_black">Ir a G-Suite</a></p>

    {{-- Pinta los errores en caso de haber --}}
    @include('alerts.show-errors')
    @include('alerts.show-success')

    <modal-student-email></modal-student-emails>
    <modal-employee-email></modal-employee-email>
    <modal-edit-email></modal-edit-email>

    <emails-table></emails-table>
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