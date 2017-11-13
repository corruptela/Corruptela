@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">
    <a href="{{route('partidos.index')}}"><span class="glyphicon glyphicon-fast-backward"></span></a>
    Gestão Partido: <b>{{$party->name or 'Novo'}}</b>
</h1>

@if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if( isset($party) )
    {!! Form::model($party, ['route' => ['partidos.update', $party->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'partidos.store', 'class' => 'form']) !!}
@endif
    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::text('initials', null, ['class' => 'form-control', 'placeholder' => 'Sigla:']) !!}
    </div>

    <div class="form-group">
        <label>
            {!! Form::checkbox('active') !!}
            Ativo?
        </label>
    </div>

<div class="form-group">
        {!! Form::text('countries_id', null, ['class' => 'form-control', 'placeholder' => 'País:']) !!}
</div>


    {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

@endsection