@extends('adminlte::page')

@section('title', 'Controle - Filiais')

@section('content_header')
    <h1>Detalhes da Filial -
        <strong>
            @foreach ($companies as $company)
                @if ($company->id == $branch->company_id)
                    {{ $company->name }} -
                @endif
            @endforeach
            @foreach ($locations as $location)
                @if ($location->id == $branch->location_id)
                    {{ $location->name }}/{{ $location->uf }}
                @endif
            @endforeach
        </strong>
    </h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('branch.index') }}">Filiais</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @foreach ($companies as $company)
                @if ($company->id == $branch->company_id)
                    {{ $company->name }} -
                @endif
            @endforeach
            @foreach ($locations as $location)
                @if ($location->id == $branch->location_id)
                    {{ $location->name }}/{{ $location->uf }}
                @endif
            @endforeach
        </li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item align-middle"><strong>Compania: </strong>
                    @foreach ($companies as $company)
                        @if ($company->id == $branch->company_id)
                            {{ $company->name }}<img class="float-right" src="{{ url("storage/{$company->image}") }}"
                                alt="{{ $company->name }}" style="max-width: 60px;">
                        @endif
                    @endforeach
                </li>
                <li class="list-group-item"><strong>CNPJ: </strong>{{ $branch->cnpj }}</li>
                <li class="list-group-item"><strong>Localização: </strong>
                    @foreach ($locations as $location)
                        @if ($location->id == $branch->location_id)
                            {{ $location->name }}/{{ $location->uf }}
                        @endif
                    @endforeach
                </li>
            </ul>
            <div class="card" style="height: 50vh;overflow-y: auto;">
                <div class="card-body">
                    <h4>Lista de Clientes</h4>
                    @foreach ($clients as $client)
                        {{ $client->name }}
                    @endforeach
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
