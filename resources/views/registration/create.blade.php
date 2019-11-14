@extends('layout')
@section('title', 'Registration')
@section('h1', 'Register for Sessions')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>			
</div>
@endif

<form method="POST" action="/registration">
	{{csrf_field()}}
	<div class="container">		
		<hr>
		
			<input type="hidden" name="s_id" value="{{ $session->s_id }}"></input>
			<p>{{ $session->title }}</p>
			<p>{{ date('F j, Y', strtotime($session->date)) }}</p>
			<p>{{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>
			<input type="hidden" name="f_id" value="{{ Auth::id() }}"></input>

			<p>Register my child(ren)</p>
			@foreach ($children as $child)
				<input type="checkbox" value="{{ $child->c_id }}" name="{{ $child->c_id }}"> {{ $child->child_name }}</input><br>
			@endforeach

		<hr>
		<button style="width:30%" type="submit" name="sessionbtn" class="btn btn-success">Register</button><br>
		<a href="/session" style=" width:30%; background-color:grey" name="cancel"class="btn btn-secondary">Cancel</a>

	</div>
</form>
@endsection