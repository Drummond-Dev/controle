@extends('adminlte::page')

@section('title', 'Controle - Localizações')

@section('content_header')
    <h1>Detalhes da Localização - <strong>{{ $location->name }}</strong></h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('location.index') }}">Localizações</a></li>
        <li class="breadcrumb-item active" aria-current="page">Localização - {{ $location->name }}</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nome: </strong>{{ $location->name }}</li>
                <li class="list-group-item"><strong>UF: </strong>{{ $location->uf }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('location.destroy', $location->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que quer apagar esta localização?')"><i class="fa fa-fw fa-trash"></i>Apagar</button>
            </form>
        </div>
    </div>
@stop