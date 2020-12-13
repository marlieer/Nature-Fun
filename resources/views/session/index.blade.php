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
                                title: '{{ $session->title }} \n {{ $session->max_attendance - $session->spotsAvailable }}/{{ $session->max_attendance }} spots filled',
                                start: '{{ $session->date . 'T' . $session->start_time }}',
                                end: '{{ $session->date . 'T' . $session->end_time }}',
                                url: 'session/{{$session->id}}',
                                color: '{{ $session->spotsAvailable == 0 ? 'gold':'#22822E' }}',
                                textColor: 'white',
                                displayEventEnd: true,
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
                                title: '{{ $session->title }} \n {{ $session->spotsAvailable }} spots left!',
                                start: '{{ $session->date . 'T' . $session->start_time }}',
                                end: '{{ $session->date . 'T' . $session->end_time }}',
                                url: 'registration/{{ $session->id }}/create',
                                color: '{{ $session->spotsAvailable == 0 ? 'gold':'#22822E' }}',
                                textColor: 'white',
                                displayEventEnd: true,
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
