@extends('layout')
@section('title', 'Create Sessions')
@section('content')
<h1 class="centre">Create Nature Fun Sessions</h1>

@if ($errors->any())
<div class="alert">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>			
</div>
@endif

<form method="POST" action="/session">
	{{csrf_field()}}
	<div class="container">
		<p>Note: if a Nature Fun session is created during a holiday (Ex. August Long Weekend) with this form, be sure to delete it manually.
		</p>
		<hr>

		<div>
			Date:
			<input type="date" name="session_date" value="{{ old('session_date') }}"/>
		</div>
		<div>
			Start time:
			<input type="time" name="start_time" value="{{old('start_time')}}"/>
		</div>
		<div>
			End Time:
			<input type="time" name="end_time" value="{{old('end_time')}}" />
		</div>

		<div>
			Repeat:
			<input type="checkbox" value="mon" name="mon">Mon
			<input type="checkbox" value="tue" name="tue">Tue
			<input type="checkbox" value="wed" name="wed"/>Wed
			<input type="checkbox" value="thu" name="thu"/>Thu
			<input type="checkbox" value="fri" name="fri"/>Fri<br>
		</div>
		<br>
		<div>
			End Repeat:
			<input type="date" name="end_repeat" value="{{old('end_repeat')}}"/>
		</div>

		<div>
			Max Attendance:
			<select name = "max_attendance" style="width:15%" required>

				<option value = "1">1</option>
				<option value = "2">2</option>
				<option value = "3">3</option>
				<option value = "4">4
				</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12" selected="selected">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
			</select>
		</div>
		<div>
			<div>
				Age Range (in years):
				<select name = "min_age" style="width:10%; " required>
				<option value = "4">4
				</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
			</select>
			</div>
			<div>to:
				<select name = "max_age" style="width:10%" required>
				<option value = "4">4
				</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value ="8" selected="selected">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
			</select>
			</div>
		</div>
	</div>

	<hr>

	
	<button style="width:30%" type="submit" name="sessionbtn" class="btn btn-success">Finish</button><br>
	<a href="/session" style="width:30%; background-color:grey" type="cancel" name="cancel" class="btn btn-secondary">Cancel</a>

</div>
</form>
@endsection