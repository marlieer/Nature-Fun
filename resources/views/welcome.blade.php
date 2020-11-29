<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .fill {
            overflow: hidden;
            background-size: 175px 175px;
            background-repeat: no-repeat;
            background-position: top;
            background-image: url('images/logo.png');
        }
        img {
            max-height: 70px;
            max-width: 70px;
            padding-right: 200px;
            padding-left: 200px;
        }
    </style>
    <title>Nature Fun</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel ="stylesheet" type="text/css" href="/css/style.css"/>
</head>
<body>

        <div class="fill">
       <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        @endif
        @endauth
        </div>

    <div class="container" >
        <div class="title m-b-md">
            Welcome To Nature Fun
        </div>

        <div class="links" style="position: absolute;">
            <a href="http://naturefun.test/session">Our Summer Schedule</a>
            <a href="https://www.facebook.com/scoutisland/">Check Us On Facebook!</a>
            <a href="https://scoutisland.ca/">Scout Island Website</a>
            <a href="/contact_us">Contact Us</a>
        </div>
    </div>
</div>
</div>
</body>
</html>
