@extends('layout')
@section('title', 'Registration')
@section('h1', 'Register for Sessions')
@section('content')

@if ($errors->any())
<div class="alert">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>			
</div>
@endif

<form method="POST" action="/registrationAsAdmin">
	{{csrf_field()}}
	<div class="container">		
		<hr>
		
			<input type="hidden" name="s_id" value="{{ $session->s_id }}"></input>
			<p>{{ $session->title }}</p>
			<p>{{ date('F j, Y', strtotime($session->date)) }}</p>
			<p>{{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>
			<input type="hidden" name="f_id" value="{{ Auth::id() }}"></input>

			<hr>
			
			<p>Search For Child: </p>
			
			<input id="searchChild" onkeyup="myFunction()" class="form-control" type="text" placeholder="Search" aria-label="Search"/>
			<ul id="children">
				@foreach ($children as $child)
					<li style="display: none;"><div><input type="checkbox" value="{{ $child->c_id }}" name="{{ $child->c_id }}"/>{{ $child->child_name }} {{ $child->last_name }}</div></li>
				@endforeach	
			</ul>	

			<hr>
			<button type="button" id="registerManually" onclick="showForm()">Register Manually</button>
			<div style="display: none;" id="registerForm">

				<br>
				<div>Child Name<input type="text" name="child_name" placeholder="Child Name"/></div>
				<div>Age<input type="numeric" name="Age" placeholder="age"/></div>
				<div>Contact #<input type="tel" placeholder="Format: 123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone"/></div>
				<div>Allergies<input type="text" name="allergy_info" placeholder="Allergies"/></div>
				<div>Notes<input type="text" name="notes" placeholder="Notes"/></div>
			</div>

		<hr>
		<button style="width:30%" type="submit" name="sessionbtn" class="btn btn-success">Register</button><br>
		<a href="/session" style=" width:30%; background-color:grey" name="cancel"class="btn btn-secondary">Cancel</a>

	</div>
</form>

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