@extends('adminlte::page')

@section('title', 'Controle - Companias')

@section('content_header')
    <h1>Alterar Compania - <strong>{{ $company->name }}</strong></h1>

    <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item" aria-label="Dashboard"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('company.index') }}">Companias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Compania - {{ $company->name }}</li>
    </ol>
@stop

@section('content')
    <div class="card" style="height: 80vh;overflow-y: auto;">
        <div class="card-body">
            <form action="{{ route('company.update', $company->id) }}" class="form" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('company._partials.form')
        </div>
        <div class="card-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary">Alterar</button>
                </div>
            </form>
        </div>
    </div>
@stop