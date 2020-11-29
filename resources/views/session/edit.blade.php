@extends('layout')
@section('title', 'Edit Sessions')
@section('content')

<div class="container-fluid">
<form method="POST" action="/session/{{$session->s_id}}" style="margin-bottom: 1em">
	{{method_field("PATCH")}}
	@csrf
	<div class="field">
		<div class="control">
            <label>Title
                <input type="text" class="input" name="title" placeholder="title" value="{{$session->title}}">
            </label>
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
			<input type="number" name = "min_age" style="width:10%;" required value="{{$session->min_age}}"/>
		</div>
	</div>

	<div class="field">
		<label class="label" for="max_age">Max Age</label>

		<div class="control">
			<input type="number" name = "max_age" style="width:10%;" required value="{{$session->max_age}}"/>
		</div>
	</div>

	<div class="field">
		<label class="label" for="max_attendance">Max Attendance</label>

		<div class="control">
			<input type="number" name = "max_attendance" style="width:15%" required value="{{$session->max_attendance}}"/>
		</div>
	</div>

	<div class="field">
		<div class="control">
			<button type="submit" name="regbtn" class="btn btn-success" style="width:30%">Update Session</button>
		</div>
	</div>
</form>

<form method="POST" action="/session/{{$session->id}}" style="margin-bottom: 1em">
	@method('DELETE')
	@csrf
	<div class="field">
		<div class="control">
			<button type="submit" class="btn btn-secondary" style="width:30%; background-color: grey;">Delete Session</button>
		</div>
	</div>
</form>
</div>


@endsection
