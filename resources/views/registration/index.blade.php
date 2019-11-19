@extends('layout')
@section('title', 'My Registered Sessions')
@section('h1', 'My Registered Sessions')
@section('content')

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

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
<p>Registrations for {{ Auth::user()->name }}</p>

<div class="container">

	<div id='calendar'></div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
	<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($registrations as $reg)
                {
                    title : '{{ date('g', strtotime($reg->start_time)) }}{{ ltrim(date('i', strtotime($reg->start_time)), 0) }}-{{ date('g', strtotime($reg->end_time)) }}{{ ltrim(date('i', strtotime($reg->start_time)), 0) }} {{ date('a', strtotime($reg->end_time)) }} \n {{ $reg->child_name }}',
                    start : '{{ $reg->date }}',
                    url : '{{ route('registration.edit', $reg->r_id) }}'
                },
                @endforeach
            ]
        })
    });
</script>
</div>

@endsection