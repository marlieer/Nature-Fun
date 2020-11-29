@extends('layout')
@section('title', 'Registration')
@section('h1', 'Register for Sessions')
@section('content')

<form method="POST" action="/registration">
	{{csrf_field()}}
	<div class="container">
		<hr>

			<input type="hidden" name="session_id" value="{{ $session->id }}"/>
			<p>{{ $session->title }}</p>
			<p>{{ date('F j, Y', strtotime($session->date)) }}</p>
			<p>{{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>

			<p>Register my child(ren)</p>
			@foreach ($children as $child)
            <label>
                <input type="checkbox" value="{{ $child->id }}" name="{{ $child->c_id }}"/>{{ $child->name }}
            </label><br>
			@endforeach

		<hr>
		<button style="width:30%" type="submit" name="sessionbtn" class="btn btn-success">Register</button><br>
		<a href="{{ route('session.index') }}" style=" width:30%; background-color:grey" class="btn btn-secondary">Cancel</a>

	</div>
</form>
@endsection
