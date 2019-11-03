@extends('layout')
@section('title', 'Sign Up')
@section('h1','Nature Fun Sign Up')
@section('content')

	<div id="myProgress">
		<div id="myBar" style="width:33%">Step 1 of 3</div>
	</div>
	@if ($errors->Unique())
		<div class="alert">
			  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			  Oops! Looks like your email is already associated to an account. Click <a href="/login">here</a> to go to Log in!
		</div>
	@endif

	@if ($errors->any())
		<div class="alert">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>			
		</div>
	@endif

	<form method="POST" action="/family">
		{{csrf_field()}}
		<div class="container">
			<h2>First, we need some basic family information...</h2>
			<p>Please note that your child must be at least <strong>4 years old</strong> before registering for Nature Fun. This is a strictly enforced policy. Please respect our program guidlines. If your child is under the age of 4, we encourage you to come for Tails and Trails! A free family event run by our staff once a week in the summer. You're welcome to enjoy lunch at our picnic tables afterwards!
			</p>
			<hr>
				<span><label for="first_name"><b>First Name</b></label>
				<input type="text" placeholder="Enter First Name" name="first_name" required value="{{ old('first_name')}}"></span>

				<span><label for="last_name"><b>Last Name</b></label>
				<input type="text" placeholder="Enter Last Name" name="last_name" required value="{{ old('last_name')}}"></span>

				<span><label for="email"><b>Email</b></label>
				<input type="Email" placeholder="Enter Email" name="email" required value="{{ old('email')}}"></span>
				
				<span><label for="phone"><b>Phone Number</b></label>
					<small>Format: 123-456-7890</small>
				<input type="tel" placeholder="Format: 123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" required value="{{ old('phone')}}"></span>

				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required >

				<span><label for="password_confirmation"><b>Confirm Password</b></label>
				<input type="password" placeholder="Confirm Password" name="password_confirmation" required></span>
			</hr>
			<hr>
			<button type="submit" name="regbtn" class="btn">Next</button>
			</hr>
		</div>
	</form>
@endsection