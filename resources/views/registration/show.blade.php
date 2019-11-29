@extends('layout')
@section('title', 'Registration')
@section('h1', 'Registered!')
@section('content')

<br>
<p>Registration ID: {{ $registration->r_id }}</p>
<p>Session Date: {{ date('F j, Y', strtotime($session->date)) }}</p>
<p>Session Time: {{ date('g:i a', strtotime($session->start_time)) }} to {{ date('g:i a', strtotime($session->end_time)) }}</p>
@foreach ($children as $child)
<p>Child: {{ $child->child_name }}</p>
@endforeach
<br>

@if ( $id ==1 )
<a href="/session/{{$session->s_id}}" class = "btn btn-success" style="width:60%;">View Class</a><br>
@endif
<a href="/session" class="btn btn-success" style="width:60%;">Back to Summer Schedule</a>


@endsection