@extends('painel.templates.template') @section('content')

<h1 class="title-pg">
	<a href="{{route('paises.index')}}"><span
		class="glyphicon glyphicon-fast-backward"></span></a> País: <b>{{$country->id}}
		{{$country->name}}</b>
</h1>
<p>
	<b>Ativo:</b> {{$country->active}}
</p>
<p>
	<b>Initials:</b> {{$country->initials}}
</p>
<hr>
@if( isset($errors) && count($errors) > 0 )
<div class="alert alert-danger">
	@foreach( $errors->all() as $error )
	<p>{{$error}}</p>
	@endforeach
</div>
@endif {!! Form::open(['route' => ['paises.destroy', $country->id],
'method' => 'DELETE']) !!} {!! Form::submit("Deletar País:
$country->name", ['class' => 'btn btn-danger']) !!} {!! Form::close() !!}

@endsection
