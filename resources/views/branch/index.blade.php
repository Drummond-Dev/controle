@extends('adminlte::page')

@section('title', 'Controle - Filiais')

@section('content_header')
    <h1>Filiais <a href="{{ route('branch.create') }}" class="btn btn-outline-dark float-right mr-4 mt-2"><i
                    class="far fa-fw fa-plus-square"></i>
            Adicionar</a>
    </h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        @if(isset($filters))
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('branch.index') }}">Filiais</a></li>
        @else
            <li class="breadcrumb-item active" aria-current="page">Filiais</li>
        @endif
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-header">
            <form action="{{ route('branch.search') }}" method="POST" class="form form-inline">
                @csrf
                <label class="sr-only" for="inlineFormInputGroupPesquisar">Pesquisar</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-fw fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" name="filter" id="inlineFormInputGroupPesquisar" placeholder="Pesquisar por CNPJ" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-outline-secondary mb-2">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Compania</th>
                    <th>CNPJ</th>
                    <th>Localização</th>
                    <th style="width: 300px;">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <td>
                            @foreach($companies as $company)
                                @if($company->id === $branch->company_id)
                                    {{ $company->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{ $branch->cnpj }}
                        </td>
                        <td>
                            @foreach($locations as $location)
                                @if($location->id === $branch->location_id)
                                    {{ $location->name }} / {{ $location->uf }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('branch.show', $branch->id) }}" class="btn btn-outline-info"><i class="fa fa-fw fa-info-circle"></i>Visualizar</a>
                            <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-outline-info"><i class="fa fa-fw fa-edit"></i>Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            @if(isset($filters))
                {{ $branches->appends($filters)->links() }}
            @else
                {{ $branches->links() }}
            @endif
        </div>
    </div>
@stop