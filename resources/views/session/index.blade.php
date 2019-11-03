@extends('layout')
@section('title', 'Schedule')
@section('h1', 'Our Summer Schedule')
@section('content')

<hr>
<div class="container-fluid">
	<p> If there are no spots available, please register on our waitlist. We'll contact you if a spot opens up.</p>
</div>

<table style = "width:100%">
<tr>
	<th>Weekly Theme</th>
	<th>Date</th>
	<th>Start Time</th>
	<th>End Time</th>
	<th>Spots Available (click t</th>
</tr>
@foreach ($sessions as $session)
<tr>
	<td>{{ $session->title }}</td>
	<td><a href="session/{{ $session->s_id }}/edit">{{ $session->date }}</a></td>
	<td>{{ $session->start_time }}</td>
	<td>{{ $session->end_time }}</td>

	@if ($session->is_full)=='f'
		<td>No. Waitlist</td>
	@else
		<td><a href="registration/{{ $session->s_id }}/create">Yes! Register Me</a></td>
	@endif
</tr>
@endforeach
</table>


@endsection