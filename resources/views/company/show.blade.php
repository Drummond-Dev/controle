@extends('adminlte::page')

@section('title', 'Controle - Companias')

@section('content_header')
    <h1>Detalhes da Compania - <strong>{{ $company->name }}</strong></h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('company.index') }}">Companias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Compania - {{ $company->name }}</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="h2">{{ $company->name }}</span><img
                        src="{{ url("storage/{$company->image}") }}" alt="{{ $company->name }}" style="max-width: 60px;"
                        class="float-right"></li>
                <li class="list-group-item">&nbsp;</li>
            </ul>
            <div class="card" style="height: 50vh;overflow-y: auto;">
                <div class="card-header">
                    <h4>Lista de Filiais</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($company->branches as $branch)
                            <li class="list-group-item align-top">
                                <strong>{{ $branch->company->name }}</strong> -
                                {{ $branch->location->name }}/{{ $branch->location->uf }}
                                <br />
                                <strong>CNPJ: </strong>{{ $branch->cnpj }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('company.destroy', $company->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger"
                    onclick="return confirm('Tem certeza que quer apagar esta compania?')"><i
                        class="fa fa-fw fa-trash"></i>Apagar</button>
            </form>
        </div>
    </div>
@stop
