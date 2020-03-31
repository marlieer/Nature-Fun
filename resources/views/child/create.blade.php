@extends('layout')
@section('title', 'Child Sign Up')
@section('h1','Nature Fun Sign Up')
@section('content')

<div id="myProgress">
	<div id="myBar" style="width:100%">Step 2 of 2</div>
</div>

<form method="POST" action="/child">
	{{csrf_field()}}
	<div class="container">
		<h2>Please fill in your child's information</h2>
		<p>If you want to sign up additional children, go to your profile to add them after submitting this form.</p>

		<hr>

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
			<label for="can_take_photos"><b>Can we take photos of your child?</b>
			</label>
			<input type="radio" name="can_take_photos" value="1" required/>Yes
            <input type="radio" name="can_take_photos" value="0" required/>No
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
