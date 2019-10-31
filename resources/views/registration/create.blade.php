@extends('layout')
@section('title', 'Registration')
@section('h1', 'Register for Sessions')
@section('content')

<h1 class="centre">Register for Our Summer Programs!</h1>
<form method="POST" action="/registration">
	{{csrf_field()}}
	<div class="container">		
		<hr>
		
			<p>Session ID: {{ $session->s_id }}</p>
			<p>Session Title: {{ $session->title }}</p>
			<p>Session Date: {{ $session->date }}</p>
			<p>Family ID: {{ session('id')}}</p>
			@foreach ($children as $child)
				<p>Child Name: {{ $child->child_name }}</p>
			@endforeach

		<hr>

		<button style="width:30%; background-color:grey" type="cancel" name="cancel" class="btn">Cancel</button>
		<button style="width:30%" type="submit" name="sessionbtn" class="btn">Finish</button>

	</div>
</form>
@endsection