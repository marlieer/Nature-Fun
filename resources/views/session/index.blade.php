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
	<th>Spots Available</th>
</tr>
@foreach ($sessions as $session)
<tr>
	<td>{{ $session->title }}</td>
	@if ($id == 1)
		<td><a href="session/{{ $session->s_id }}/edit">{{ date('M j, Y', strtotime($session->date)) }}</a></td>
	@else
		<td>{{ date('M j', strtotime($session->date)) }}</td>
	@endif
	<td>{{ date('g:i a', strtotime($session->start_time)) }}</td>
	<td>{{ date('g:i a', strtotime($session->end_time)) }}</td>
@if ($id == 1)
    @if (($session->is_full) == 't')
        <td><a href="session/{{$session->s_id}}">Full! View List</a></td>
    @else
        <td><a href="session/{{$session->s_id}}">{{ $spotsAvailable[$session->s_id] }} spots left! View Class</a></td>
    @endif
@else
	@if (($session->is_full)=='t')
		<td><a href="waitlist/{{ $session->s_id}}/create">No, Waitlist Me</a></td>
	@else
		<td><a href="registration/{{ $session->s_id }}/create">{{ $spotsAvailable[$session->s_id] }} spots left! Register Me</a></td>
	@endif
@endif
</tr>
@endforeach
</table>


@endsection
