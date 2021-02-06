@extends('layout');
@section('title', $sessions[0]->date)
@section('content')

<br>
<div class="float-right">
<button onclick="myFunction()">Print this page</button>
</div>
<br>
@foreach($sessions as $session)
	<p>Date: {{ date('D M j, y', strtotime($session->date)) }} | {{ date('g:i a', strtotime($session->start_time)) }} - {{ date('g:i a', strtotime($session->end_time)) }}</p>
	<p>Total Cash/Chq: ____________________</p>
	<p>Total Punch Card: __________________</p>
	<div class="container">
	<table style="width:100%;">
		<tr>
			<th>Here</th>
			<th>Paid</th>
			<th>Child</th>
			<th>Age</th>
			<th>Contact</th>
			<th>Allergies</th>
			<th>Notes</th>
		</tr>

		@foreach ($childrens as $children)
		@foreach($children as $child)
		@if($child->id == $session->id)
		<tr>
			<td>{{ $child->is_paid }}</td>
			<td>  </td>
			<td>{{ decrypt($child->name) }} {{$child->last_name}}</td>
			<td>{{ $child->age() }} </td>
			<td>{{ $child->phone }}</td>
			<td>{{ $child->allergy_info }}</td>
			<td>{{ $child->notes }}</td>
		</tr>
			@endif
			@endforeach
			@endforeach

			@foreach ($otherChildrens as $children)
		@foreach($children as $child)
		@if($child->session_id == $session->id)
		<tr>
			<td>{{ $child->is_paid }}</td>
			<td>  </td>
			<td>{{ decrypt($child->name) }}</td>
			<td>{{ $child->age() }} </td>
			<td>{{ $child->phone }}</td>
			<td>{{ $child->allergy_info }}</td>
			<td>{{ $child->notes }}</td>
		</tr>
			@endif
			@endforeach
			@endforeach

		</table>
		</div>
	<br>

@endforeach
<p>Punch cards purchased (don't forget to write on the punch card record sheet): __________________________</p>
	<br>
	<a href="/session" class="btn btn-success" style="width:60%;">Back to Summer Schedule</a>


<script>
function myFunction() {
  window.print();
}
</script>

@endsection
