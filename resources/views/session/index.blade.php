@extends('layout')
@section('title', 'Schedule')
@section('content')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>

    <div class="container-fluid">
        <p> If there are no spots available, please phone or email to register on our waitlist. We'll contact you if a
            spot opens up.</p>
    </div>
    <div class="container">

        <div id='calendar'></div>

        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
        <script>
            $(document).ready(function () {
                // page is now ready, initialize the calendar...

                    @if($isAdmin){
                    $('#calendar').fullCalendar({
                        // put your options and callbacks here

                        events: [
                                @foreach($sessions as $session){
                                title: ' {{ date('g', strtotime($session->start_time)) }}-{{ date('g', strtotime($session->end_time)) }} {{ date('a', strtotime($session->end_time)) }} \n {{ $session->max_attendance - $spotsAvailable[$session->id] }} / {{ $session->max_attendance }} spots filled!',
                                start: '{{ $session->date }}',
                                url: 'session/{{$session->id}}',
                                color: '#22822E',
                                textColor: 'white'
                            },
                            @endforeach

                        ]

                    })
                }

                    @else{
                    $('#calendar').fullCalendar({
                        // put your options and callbacks here

                        events: [
                                @foreach($sessions as $session){
                                title: ' {{ date('g', strtotime($session->start_time)) }}{{ ltrim(date('i', strtotime($session->start_time)), 0) }}-{{ date('g', strtotime($session->end_time)) }}{{ ltrim(date('i', strtotime($session->start_time)), 0) }} {{ date('a', strtotime($session->end_time)) }} \n {{ $spotsAvailable[$session->s_id] }} spots left!',
                                start: '{{ $session->date }}',
                                url: 'registration/{{ $session->id }}/create',
                                color: '#22822E',
                                textColor: 'white'
                            },
                            @endforeach

                        ]

                    })
                }
                @endif
            });
        </script>
    </div>
@endsection
