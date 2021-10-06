@extends('adminlte::page')

@section('title', 'Controle - Companias')

@section('content_header')
    <h1>Companias <a href="{{ route('company.create') }}" class="btn btn-outline-dark float-right mr-4 mt-2"><i
                    class="far fa-fw fa-plus-square"></i>
            Adicionar</a>
    </h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        @if(isset($filters))
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('company.index') }}">Companias</a></li>
        @else
            <li class="breadcrumb-item active" aria-current="page">Companias</li>
        @endif
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-header">
            <form action="{{ route('company.search') }}" method="POST" class="form form-inline">
                @csrf
                <label class="sr-only" for="inlineFormInputGroupPesquisar">Pesquisar</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-fw fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" name="filter" id="inlineFormInputGroupPesquisar" placeholder="Pesquisar" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-outline-secondary mb-2">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th style="width: 200px;">&nbsp;</th>
                        <th>Nome</th>
                        <th style="width: 300px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>
                                <img src="{{ url("storage/{$company->image}") }}" alt="{{ $company->name }}" style="max-width: 60px;">
                            </td>
                            <td class="align-middle">
                                {{ $company->name }}
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('company.show', $company->id) }}" class="btn btn-outline-info"><i class="fa fa-fw fa-info-circle"></i>Visualizar</a>
                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-outline-info"><i class="fa fa-fw fa-edit"></i>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            @if(isset($filters))
                {{ $companies->appends($filters)->links() }}
            @else
                {{ $companies->links() }}
            @endif
        </div>
    </div>
@stop