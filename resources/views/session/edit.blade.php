@extends('layout')
@section('title', 'Edit Sessions')
@section('content')
<h1 class="centre">Edit Nature Fun Sessions</h1>

@if ($errors->any())
<div class="alert">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>			
</div>
@endif

<div class="container-fluid">
<form method="POST" action="/session/{{$session->s_id}}" style="margin-bottom: lem">
	{{method_field("PATCH")}}
	{{csrf_field()}}
	<div class="field">
		<label class="label" for="title">Title</label>

		<div class="control">
			<input type="text" class="input" name="title" placeholder="title" value="{{$session->title}}">
		</div>
	</div>

	<div>
		<label>Date</label>
		<div>
			<input type="date" name="session_date" value="{{$session->date}}"/>
		</div>
	</div>

	<div class="field">
		<label class="label" for="start_time">Start Time</label>

		<div>
			<input type="Time" class="input" name="start_time" placeholder="start_time" value="{{$session->start_time}}">
		</div>
	</div>

	<div class="field">
		<label class="label" for="end_time">End Time</label>

		<div class="control">
			<input type="Time" class="input" name="end_time" value="{{$session->end_time}}">
		</div>
	</div>

	<div class="field">
		<label class="label" for="min_age">Min Age</label>
		<div class="control">
			<select name = "min_age" style="width:10%;" required value="{{$session->min_age}}">
				<option value= "4" selected="selected">4
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
	</div>

	<div class="field">
		<label class="label" for="max_age">Max Age</label>

		<div class="control">
			<select name = "max_age" style="width:10%;" required value="{{$session->max_age}}">
				<option value = "4">4
				</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8" selected="selected">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
			</select>
		</div>
	</div>

	<div class="field">
		<label class="label" for="max_attendance">Max Attendance</label>

		<div class="control">
			<select name = "max_attendance" style="width:15%" required value="{{$session->max_attendance}}">

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
	</div>

	<div class="field">
		<div class="control">
			<button type="submit" name="regbtn" class="btn btn-success" style="width:30%">Update Session</button>
		</div>
	</div>
</form>

<form method="POST" action="/session/{{$session->s_id}}" style="margin-bottom: lem">
	@method('DELETE')
	@csrf
	<div class="field">
		<div class="control">
			<button type="submit" class="btn btn-secondary" name="delbtn" style="width:30%; background-color: grey;">Delete Session</button>
		</div>
	</div>
</form>
</div>


@endsection