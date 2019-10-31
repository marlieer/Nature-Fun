@extends('layout');
@section('title', 'Child Sign Up');
@section('content')
<h1 class="centre">Nature Fun Sign Up</h1>

<div id="myProgress">
	<div id="myBar" style="width:100%">Step 3 of 3</div>
</div>

@if ($errors->any())
<div class="alert">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>			
</div>
@endif

<form method="POST" action="/signupPage3">
	{{csrf_field()}}
	<div class="container">
		<h2>Finally, we need your child(ren)'s information. Then you're done with signing up!</h2>

		<hr>
		
		<h3>Child 1:</h3>

		<span>
			<label for="child_name"><b>Name</b>
			</label>
			<input type="text" placeholder="Enter Name" name="child_name" value="{{old('child_name')}}" required/>
		</span>

		<span>
			<label for="birthdate"><b>Birthdate (YYYY-MM-DD)</b>
			</label>
			<input type="date" name="birthdate" value="{{old('birthdate')}}"required/>
		</span>

		<span>
			<label for="med_num"><b>Medical Number</b>
			</label>
			<input type="text" placeholder="Medical Number" name="med_num" value="{{old('med_num')}}"/>
		</span>


		<span>
			<label for="allergy_info"><b>Allergy Information</b>
			</label>
			<input type="text" placeholder="Allergy information" name="allergy_info"
			value="{{old('allergy_info')}}"/>
		</span>

		<span>
			<label for="notes"><b>Any other information we should know about? Ex. learning disabilities, behaviour problems or any other relavent information to help us better care for your child during Nature Fun.</b>
			</label>
			<input type="text" placeholder="Notes" name="notes" value="{{old('notes')}}"/>
		</span>

		<hr>

		<button type="submit" name="regbtn" class="btn">Finish!</button>

	</div>
</form>
@endsection