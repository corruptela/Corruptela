@extends('painel.templates.template')

@section('content')

<h1 class="title-pg">
    <a href="{{route('partidos.index')}}">
        <span class="glyphicon glyphicon-refresh"></span>
    </a>
    Listagem dos partidos
</h1>

<a href="{{route('partidos.create')}}" class="btn btn-primary btn-add">
    <span class="glyphicon glyphicon-plus"></span> Cadastrar
</a>

{!! Form::open(['route' => 'partidos.search', 'class' => 'form form-inline form-search']) !!}
    {!! Form::text('search', null, ['placeholder' => 'Pesquisar?', 'class' => 'form-control']) !!}
    {!! Form::submit('search', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
<table class="table table-striped">
    <tr>
        <th>Nome</th>
        <th>Sigla</th>
        <th width="100px">Ações</th>
    </tr>
    @foreach($parties as $party)
    <tr>
        <td>{{$party->name}}</td>
        <td>{{$party->initials}}</td>
        <td>
            <a href="{{route('partidos.edit', $party->id)}}" class="actions edit">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('partidos.show', $party->id)}}" class="actions delete">
                <span class="glyphicon glyphicon-eye-open"></span>
            </a>
        </td>
    </tr>
    @endforeach
</table>

@if( isset($dataForm) )
    {!! $parties->appends($dataForm)->links() !!}
@else
    {!! $parties->links() !!}
@endif

@endsection