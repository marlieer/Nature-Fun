@extends('layout');
@section('title', $sessions[0]->date)
@section('h1', 'Class List')
@section('content')

<br>
<div class="float-right">
<button onclick="myFunction()">Print this page</button>
</div>
<br>
@foreach($sessions as $session)
	<p>Date: {{ date('F j, Y', strtotime($session->date)) }}</p>
	<p>Time: {{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>
	<div class="container">
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

		@foreach ($childrens as $children)
		@foreach($children as $child)
		@if($child->s_id == $session->s_id)
		<tr>
			<td>
				<form method="POST" action="/registration/{{$child->r_id}}">
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
			<td>{{ $child->child_name }}</td>
			<td>{{ $child->age }} </td>
			<td>{{ $child->phone }}</td>
			<td>{{ $child->allergy_info }}</td>
			<td>{{ $child->notes }}</td>
			<td>{{ $child->is_paid }}</td>
		</tr>
			@endif
			@endforeach
			@endforeach
			
		</table>
		</div>
	<br>
		<a href="/registration/{{ $session->s_id}}/create">Add Child to Session</a>
		<br>
		<a style="text-align: center;" href="/session/{{ $session->s_id }}/edit">Edit Session Details</a>
		<br><br><hr>

@endforeach
	<br>
	<a href="/session" class="btn btn-success" style="width:60%;">Back to Summer Schedule</a>


<script>
function myFunction() {
  window.print();
}
</script>

@endsection