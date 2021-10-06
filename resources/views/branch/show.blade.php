@extends('adminlte::page')

@section('title', 'Controle - Filiais')

@section('content_header')
    <h1>Detalhes da Filial -
        <strong>{{ $branch->company->name }} - {{ $branch->location->name }}/{{ $branch->location->uf }}</strong>
    </h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('branch.index') }}">Filiais</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $branch->company->name }} -
            {{ $branch->location->name }}/{{ $branch->location->uf }}</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item align-middle"><strong>Compania: </strong>
                    {{ $branch->location->name }}<img class="float-right"
                        src="{{ url("storage/{$branch->company->image}") }}" alt="{{ $branch->company->name }}"
                        style="max-width: 60px;">
                </li>
                <li class="list-group-item"><strong>CNPJ: </strong>{{ $branch->cnpj }}</li>
                <li class="list-group-item"><strong>Localização:</strong>
                    {{ $branch->location->name }}/{{ $branch->location->uf }}
                </li>
            </ul>
            <div class="card" style="height: 50vh;overflow-y: auto;">
                <div class="card-header">
                    <h4>Lista de Clientes</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($branch->clients as $client)
                            <li class="list-group-item align-middle">
                                {{ $client->name }}
                                <img class="float-right" src="{{ url("storage/{$client->image}") }}"
                                    alt="{{ $client->name }}" style="max-width: 60px;">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('branch.destroy', $branch->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger"
                    onclick="return confirm('Tem certeza que quer apagar esta filial?')"><i
                        class="fa fa-fw fa-trash"></i>Apagar</button>
            </form>
        </div>
    </div>
@stop
