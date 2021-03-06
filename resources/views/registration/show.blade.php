@extends('layout')
@section('title', 'Registration')
@section('content')

    <br>
    <p>Registration ID: {{ $registration->id }}</p>
    <p>Session Date: {{ date('F j, Y', strtotime($session->date)) }}</p>
    <p>Session Time: {{ date('g:i a', strtotime($session->start_time)) }}
        to {{ date('g:i a', strtotime($session->end_time)) }}</p>
    @foreach ($children as $child)
        <p>Child: {{ $child->name }}</p>
    @endforeach
    <br>

    @if(Auth::user()->isAdmin())
        <a href="/session/{{$session->id}}" class="btn btn-success" style="width:60%;">View Class</a><br>
    @endif
    <a href="/session" class="btn btn-success" style="width:60%;">Back to Summer Schedule</a>


@endsection
