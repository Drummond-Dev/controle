@extends('adminlte::page')

@section('title', 'Controle - Clientes')

@section('content_header')
    <h1>Detalhes do Cliente - <strong>{{ $client->name }}</strong></h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('client.index') }}">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cliente - {{ $client->name }}</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="h2">{{ $client->name }}</span><img
                        src="{{ url("storage/{$client->image}") }}" alt="{{ $client->name }}" style="max-width: 60px;"
                        class="float-right"></li>
                <li class="list-group-item">&nbsp;</li>
            </ul>
            <div class="card" style="height: 80%;">
                <div class="card-header">
                    <h4>Lista de Companias</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($client->branches as $branch)
                            <li class="list-group-item align-middle">
                                <strong>{{ $branch->company->name }}</strong> -
                                {{ $branch->location->name }}/{{ $branch->location->uf }}
                                <br />
                                <strong>CNPJ: </strong>
                                {{ $branch->cnpj }}
                                <img class="float-right align-middle"
                                    src="{{ url("storage/{$branch->company->image}") }}"
                                    alt="{{ $branch->company->name }}" style="max-width: 60px;">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('client.destroy', $client->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger"
                    onclick="return confirm('Tem certeza que quer apagar esta compania?')"><i
                        class="fa fa-fw fa-trash"></i>Apagar</button>
            </form>
        </div>
    </div>
@stop
