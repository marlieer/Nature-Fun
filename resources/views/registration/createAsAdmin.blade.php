<?php use Illuminate\Support\Facades\Auth; ?>
@extends('layout')
@section('title', 'Registration')
@section('h1', 'Register for Sessions')
@section('content')

<p>{{ $session->title }}</p>
<p>{{ date('F j, Y', strtotime($session->date)) }}</p>
<p>{{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>

<div class="container">
	<form method="POST" action="/registrationAsAdmin">
		{{csrf_field()}}
		<input type="hidden" name="f_id" value="{{ Auth::id() }}">
		</input>
		<input type="hidden" name="s_id" value="{{ $session->s_id }}"></input>

		<p>Search for Child in the System: </p>

		<input id="searchChild" onkeyup="myFunction()" class="form-control" type="text" placeholder="Search" aria-label="Search"/>
		<ul id="children">
			@foreach ($children as $child)
			<li style="display: none;"><div><input type="checkbox" value="{{ $child->c_id }}" name="{{ $child->c_id }}"/>{{ $child->child_name }} {{ $child->last_name }}</div></li>
			@endforeach
		</ul>

		<button style="width:40%" type="submit" name="sessionbtn" class="btn btn-success">Register
		</button>
		<a href="/session" style=" width:40%; background-color:grey" name="cancel"class="btn btn-secondary">Cancel
		</a>
	</form>
</div>

<hr>

<button style="background-color: #070F16; color:white;" id="registerManually" onclick="showForm()"> Not in the System? Register Manually</button>
<br>
<div class="container" style="display: none;" id="registerForm">
	<form method="POST" action="/manualRegistration">
		{{ csrf_field()}}
		<br>
		<input type="hidden" name="s_id" value="{{ $session->s_id }}"></input>
		<div>Child Name<input type="text" name="child_name" placeholder="Child Name"/></div>
		<div>Age<input type="number" name="age" placeholder="age"/></div>
		<div>Contact #<input type="tel" placeholder="Format: 123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone"/></div>
		<div>Allergies<input type="text" name="allergy_info" placeholder="Allergies"/></div>
		<div>Notes<input type="text" name="notes" placeholder="Notes"/></div>

		<hr>
		<button style="width:40%" type="submit" name="sessionbtn" class="btn btn-success">Register</button>
		<a href="/session" style=" width:40%; background-color:grey" name="cancel"class="btn btn-secondary">Cancel
		</a>
	</form>
</div>

<script>
	function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("searchChild");
  filter = input.value.toUpperCase();
  ul = document.getElementById("children");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
  	a = li[i].getElementsByTagName("div")[0];
  	txtValue = a.textContent || a.innerText;
  	if (txtValue.toUpperCase().indexOf(filter) > -1) {
  		li[i].style.display = "";
  	} else {
  		li[i].style.display = "none";
  	}
  }
}

function showForm() {
	document.getElementById("registerForm").style.display = "";
}
</script>
@endsection
