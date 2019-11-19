@extends('layout')
@section('title', 'Edit Registration')
@section('content')
@section('h1', 'Edit Registration')

@if (Session::has('errors'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ \Session::get('errors') }}</li>
        </ul>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ \Session::get('success') }}</li>
        </ul>
    </div>
@endif

<br>
<p>If you're planning to cancel with less than 24 hour notice, you <strong>MUST</strong> call Scout Island Nature Centre at 250-398-8532 and you will not be refunded.</p>
<div class="container-fluid">

	<p>{{ date('F j, Y', strtotime($session->date)) }}</p>
	<p>{{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>
	<p>{{ $child->child_name}}</p>

	<form method="POST" action="/registration/{{$registration->r_id}}" style="margin-bottom: lem">
		@method('DELETE')
		@csrf
		<div class="field">
			<div class="control">
				<button type="submit" class="btn btn-secondary" name="delbtn" style="width:30%; background-color: grey;">Cancel Registration</button>
			</div>
			<div class="control">
				<a href="/registration" type="submit" class="btn btn-secondary" style="width:30%; background-color: blue">Back</a>
			</div>
		</div>
	</form>
</div>


@endsection