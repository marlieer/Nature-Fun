@extends('layout')
@section('title', 'Schedule')
@section('h1', 'Our Summer Schedule')
@section('content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<hr>
<div class="container-fluid">
	<p> If there are no spots available, please register on our waitlist. We'll contact you if a spot opens up.</p>
</div>
<div class="container">

	<div id='calendar'></div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
	<script>
		$(document).ready(function() {
        // page is now ready, initialize the calendar...
        
        @if($id==1){
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            
    		events : [
            @foreach($sessions as $session){    		
	        		title:' {{ date('g', strtotime($session->start_time)) }}{{ ltrim(date('i', strtotime($session->start_time)), 0) }}-{{ date('g', strtotime($session->end_time)) }}{{ ltrim(date('i', strtotime($session->start_time)), 0) }} {{ date('a', strtotime($session->end_time)) }} \n {{ $session->max_attendance - $spotsAvailable[$session->s_id] }} / {{ $session->max_attendance }} spots filled!',
	        		start : '{{ $session->date }}',
	        		url : 'session/{{$session->s_id}}',
	        		color: '#72c27a',
	        		textColor: 'white'
          	},
	        @endforeach

            ]
            
        })
    	}
    	
    	@else{
    		 $('#calendar').fullCalendar({
            // put your options and callbacks here
            
    		events : [
            @foreach($sessions as $session){    		
	        		title:' {{ date('g', strtotime($session->start_time)) }}{{ ltrim(date('i', strtotime($session->start_time)), 0) }}-{{ date('g', strtotime($session->end_time)) }}{{ ltrim(date('i', strtotime($session->start_time)), 0) }} {{ date('a', strtotime($session->end_time)) }} \n {{ $spotsAvailable[$session->s_id] }} spots left!',
	        		start : '{{ $session->date }}',
	        		url : 'registration/{{ $session->s_id }}/create'
          	},
	        @endforeach

            ]
            
        })
    	}
    	@endif
    	});
</script>
</div>
<br><br><hr>
<table style = "width:100%">
	<tr>
		<th>Weekly Theme</th>
		<th>Date</th>
		<th>Start Time</th>
		<th>End Time</th>
		<th>Spots Available</th>
	</tr>
	@foreach ($sessions as $session)
	<tr>
		<td>{{ $session->title }}</td>
		@if ($id == 1)
		<td><a href="session/{{ $session->s_id }}/edit">{{ date('M j, Y', strtotime($session->date)) }}</a></td>
		@else
		<td>{{ date('M j', strtotime($session->date)) }}</td>
		@endif
		<td>{{ date('g:i a', strtotime($session->start_time)) }}</td>
		<td>{{ date('g:i a', strtotime($session->end_time)) }}</td>
		@if ($id == 1)
		@if (($session->is_full) == 't')
		<td><a href="session/{{$session->s_id}}">Full! View List</a></td>
		@else
		<td><a href="session/{{$session->s_id}}">{{ $spotsAvailable[$session->s_id] }} spots left! View Class</a></td>
		@endif
		@else
		@if (($session->is_full)=='t')
		<td><a href="waitlist/{{ $session->s_id}}/create">No, Waitlist Me</a></td>
		@else
		<td><a href="registration/{{ $session->s_id }}/create">{{ $spotsAvailable[$session->s_id] }} spots left! Register Me</a></td>
		@endif
		@endif
	</tr>
	@endforeach
</table>


@endsection
