@extends('painel.templates.template') @section('content')

<h1 class="title-pg">
	<a href="{{route('partidos.index')}}"><span
		class="glyphicon glyphicon-fast-backward"></span></a> Partido: <b>{{$party->id}}
		{{$party->name}}</b>
</h1>
<p>
	<b>Ativo:</b> {{$party->active}}
</p>
<p>
	<b>Initials:</b> {{$party->initials}}
</p>
<hr>
@if( isset($errors) && count($errors) > 0 )
<div class="alert alert-danger">
	@foreach( $errors->all() as $error )
	<p>{{$error}}</p>
	@endforeach
</div>
@endif {!! Form::open(['route' => ['partidos.destroy', $party->id],
'method' => 'DELETE']) !!} {!! Form::submit("Deletar Partido:
$party->name", ['class' => 'btn btn-danger']) !!} {!! Form::close() !!}

@endsection
