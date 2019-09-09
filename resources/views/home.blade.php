@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <section class="closter">
        <div class="row justify-content-between">
        <a class="item col-3 p-2" href="{{ route('correos.index') }}">
                <div class="item-thumb">
                    <i class="fas fa-envelope fa-6x"></i>
                </div>
                <p>Correos</p>
            </a>
            
            <a class="item col-3 p-2" href="{{ route('grupos.index') }}">
                <div class="item-thumb">
                    <i class="fas fa-users fa-6x"></i>
                </div>
                <p>Grupos</p>
            </a>
            
            <a class="item col-3 p-2" href="{{ route('correos.index') }}">
                <div class="item-thumb">
                    <i class="fas fa-mail-bulk fa-6x"></i>
                </div>
                <p>Correos masivos</p>
            </a>

            <!-- <a class="item col-3 p-2" href="./ajustes">
                <div class="item-thumb">
                    <i class="fas fa-wrench fa-6x"></i>
                </div>
                <p>Ajustes</p>
            </a> -->
        </div>
    </section>
</div>
@endsection
