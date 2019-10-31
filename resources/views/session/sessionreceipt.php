@extends('layout')
@section('title', 'Session Created')
@section('content')
<h2 class="centre">Session(s) Saved!</h2>

<p>Display information of the sessions that were just saved</p>

<a href="/session/create" class="button">Create another session</a>

<a href="/session" class="button">View all sessions</a>

@endsection