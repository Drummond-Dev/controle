@extends('adminlte::page')

@section('title', 'Controle - Filiais')

@section('content_header')
    <h1>Alterar Filial -
        <strong>
           @foreach($companies as $company)
               @if($company->id == $branch->company_id)
                   {{ $company->name }} -
                @endif
            @endforeach
           @foreach($locations as $location)
               @if($location->id == $branch->location_id)
                   {{ $location->name }}/{{ $location->uf }}
               @endif
           @endforeach
        </strong>
    </h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('branch.index') }}">Filiais</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cadastrar Nova Filial</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <form action="{{ route('branch.update', $branch->id) }}" class="form" method="post">
            @csrf
            @method('PUT')

            @include('branch._partials.form')
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Alterar</button>
            </div>
            </form>
        </div>
    </div>
@stop