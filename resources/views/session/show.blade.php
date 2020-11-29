@extends('layout');
@section('title', $session->title)
@section('h1', 'Class List')
@section('content')

<div class="text-right">
	<a href="/session/showbydate/{{ $session->date }}">View whole day</a>
</div>
<p>Date: {{ date('F j, Y', strtotime($session->date)) }}</p>
<p>Time: {{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>

<table class="table table-bordered">
	<tr>
		<th>Remove</th>
		<th>Child</th>
		<th>Age</th>
		<th>Contact</th>
		<th>Allergies</th>
		<th>Notes</th>
		<th>Paid</th>
	</tr>

	@foreach ($children as $child)
	<tr>
		<td>
			<form method="POST" action="/registration/{{$child->registration_id}}">
				@method('DELETE')
				@csrf
				<button onclick="return confirm('Are you sure?')" type="submit" style="background: none!important;
				border: none;
				padding: 0!important;
				/*optional*/
				font-family: arial, sans-serif;
				/*input has OS specific font-family*/
				color: #069;
				text-decoration: underline;
				cursor: pointer;">Remove</button>
			</form>
		</td>
		<td>{{ $child->name }} {{ $child->last_name }}</td>
		<td>{{ $child->age }} </td>
		<td>{{ $child->phone }}</td>
		<td>{{ $child->allergy_info }}</td>
		<td>{{ $child->notes }}</td>
		<td>{{ $child->is_paid }}</td>
		@endforeach
	</tr>
	@foreach ($otherChildren as $child)
	<tr>
		<td>
			<form method="POST" action="/registration/{{$child->registration_id}}">
				@method('DELETE')
				@csrf
				<button onclick="return confirm('Are you sure?')" type="submit" style="background: none!important;
				border: none;
				padding: 0!important;
				font-family: arial, sans-serif;
				color: #069;
				text-decoration: underline;
				cursor: pointer;">Remove</button>
			</form>
		</td>
		<td>{{ $child->name }} {{ $child->last_name }}</td>
		<td>{{ $child->age }} </td>
		<td>{{ $child->phone }}</td>
		<td>{{ $child->allergy_info }}</td>
		<td>{{ $child->notes }}</td>
		<td>{{ $child->is_paid }}</td>
		@endforeach
	</tr>
</table>

<br>
<hr>
	<a href="/registration/{{ $session->id}}/create">Add Child to Session</a>
	<br>
	<a style="text-align: center;" href="/session/{{ $session->id }}/edit">Edit Session Details</a>
	<br>
	<hr>
	<a href="/session" class="btn btn-success" style="width:60%;">Back to Summer Schedule</a>
	@endsection
