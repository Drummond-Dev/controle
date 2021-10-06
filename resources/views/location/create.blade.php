@extends('adminlte::page')

@section('title', 'Controle - Localizações')

@section('content_header')
    <h1>Cadastrar Nova Localização</h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('location.index') }}">Localizações</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cadastrar Nova Localização</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <form action="{{ route('location.store') }}" class="form" method="post">
            @csrf

            @include('location._partials.form')
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
@stop