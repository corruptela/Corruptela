@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
<h1 class="title-pg">
    <a href="{{route('paises.index')}}"><span class="glyphicon glyphicon-fast-backward"></span></a>
    Gestão País: <b>{{$country->name or 'Novo'}}</b>
</h1>

@if( isset($errors) && count($errors) > 0 )
    <div class="alert alert-danger">
        @foreach( $errors->all() as $error )
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if( isset($country) )
    {!! Form::model($country, ['route' => ['paises.update', $country->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'paises.store', 'class' => 'form']) !!}
@endif
    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::text('initials', null, ['class' => 'form-control', 'placeholder' => 'Sigla:']) !!}
    </div>

    <div class="form-group">
         
        {!! Form::text('oficialid', null, ['class' => 'form-control', 'placeholder' => 'Código Oficial Bacen:']) !!}
       
    </div>
  
      

    {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
</div>
    </div>
        </div>
@endsection