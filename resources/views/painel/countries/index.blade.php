@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
<h1 class="title-pg">
    <a href="{{route('paises.index')}}">
        <span class="glyphicon glyphicon-refresh"></span>
    </a>
    Listagem dos paises
</h1>
</div>
<div class="panel-body">
<a href="{{route('paises.create')}}" class="btn btn-primary btn-add">
    <span class="glyphicon glyphicon-plus"></span> Cadastrar
</a>

{!! Form::open(['route' => 'paises.search', 'class' => 'form form-inline form-search']) !!}
    {!! Form::text('search', null, ['placeholder' => 'Pesquisar?', 'class' => 'form-control']) !!}
    {!! Form::submit('search', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
<table class="table table-striped">
    <tr>
        <th>Nome</th>
        <th>Sigla</th>
        <th width="100px">Ações</th>
    </tr>
    @foreach($countries as $country)
    <tr>
        <td>{{$country->name}}</td>
        <td>{{$country->initials}}</td>
        <td>
            <a href="{{route('paises.edit', $country->id)}}" class="actions edit">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('paises.show', $country->id)}}" class="actions delete">
                <span class="glyphicon glyphicon-eye-open"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>

@if( isset($dataForm) )
    {!! $countries->appends($dataForm)->links() !!}
@else
    {!! $countries->links() !!}
@endif
</div>
            </div>
        </div>
</div>

@endsection