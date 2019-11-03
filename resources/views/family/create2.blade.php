@extends('layout');
@section('title', 'Sign Up Continued');
@section('h1','Nature Fun Sign Up')
@section('content')

<div id="myProgress">
	<div id="myBar" style="width:67%">Step 2 of 3</div>
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

<form method="POST" action="/family2">
	{{csrf_field()}}
	<div class="container">
		<h2>Second, we need some emergency and medical information</h2>
		<p> There are two options here:</p>
		<p>
			1) Fill in this form online and click next at the bottom to finish signing your children up, OR
		</p>
		<p>
			2) Download the form <a href="registrationForm.doc">here</a> and hand it in to Scout Island (if you've filled out this form before, you just need to sign and redate for this year at Scout Island)
			Then click <a href="/child/create">here</a> to skip this page and sign your children up!
		</p>
		<p>
			Scout Island Nature Centre's Privacy Policy Fact Sheet available on request.
			<hr>
			<span>
				<label for="emerg_contact"><b>Emergency Contact</b>
				</label>
				<input type="text" placeholder="Enter Name of Emergency Contact" name="emerg_contact" required value="{{old('emerg_contact')}}"/>
			</span>

			<span>
				<label for="emerg_phone"><b>Emergency Contact Phone</b>
				</label>
				<input type="tel" placeholder="Format: 123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="emerg_phone" required value="{{ old('emerg_phone')}}">
			</span>

			<span>
				<label for="doctor"><b>Doctor</b>
				</label>
				<input type="text" placeholder="Enter Doctor Name" name="doctor" value="{{ old('doctor')}}"required/>
			</span>

			<span><label for="doc_phone"><b>Doctor Phone</b></label>
				<small>Format: 123-456-7890</small>
				<input type="tel" placeholder="Format: 123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="doc_phone" required value="{{ old('doc_phone')}}">
			</span>

			<script>
				function ShowHideDiv(){
					var chkYes = document.getElementById("chkYes");
					var dvtext = document.getElementById("dvtext");
					dvtext.style.display = chkYes.checked ? "block" : "none";

				}
			</script>

			<span>
				<label for="iscustody">
					<b>Is there a custody agreement in place?</b>
				</label>
				<br><br>
					<input type="radio" name="iscustody" id="chkYes" value = '1' onclick="ShowHideDiv()"/>Yes
				<br>
					<input type="radio" name="iscustody" id="chkNo" value = '0' onclick="ShowHideDiv()"/>No
				<br>
				<div id="dvtext" style="display: none">What are the details that pertain to the child taking the Scout Island Nature Centre summer programs:<br>
					<textarea rows="10" col = "300" id="custody_notes"></textarea>
				</div>
				<br>
			</span>

			<span><label for="child_pickup"><b>Who can pick your child up from Scout Island?</b></label>
				<input type="text" placeholder="Enter Names" name="child_pickup" required value="{{old('child_pickup')}}"/>
			</span>

			<hr>

			<span>
				<label for="can_call_emerg"><b>I give my permission for staff to contact emergency medical services if my child needs this attention:
				</b></label><br><br>
				<input type="radio" name="can_call_emerg" value ='1' checked/>Yes<br><input type="radio" name="can_call_emerg" value ='0'/>No<br><br>
			</span>

			<div><label for="can_take_photos"><b>I give my permission for pictures fo be taken of my child(ren) to be used in general publications:
			</b></label><br>
			<input type="radio" name="can_take_photos" value = '1' checked>Yes<br>
			<input type="radio" name="can_take_photos" value = '0'/>No<br><br></div>

			<hr>

			<button type="submit" name="regbtn" class="btn">Next</button>



			@endsection