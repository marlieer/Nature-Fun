<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nature Fun</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
      <link rel ="stylesheet" type="text/css" href="{{url('/css/style.css')}}"/>
    </head>
    <body>
	<div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ url('/family/create') }}">Register</a>
                        @endif
                    @endauth
                </div>

            <div class="content">
                <div class="title m-b-md">
                    Welcome To Nature Fun
                </div>

                <div class="links">
                    <a href="http://naturefun.test/family/create">Sign Up</a>
                    <a href="https://laracasts.com">Log In</a>
                    <a href="http://naturefun.test/session">Our Summer Schedule</a>
                    <a href="https://www.facebook.com/scoutisland/">Check Us On Facebook!</a>
                    <a href="https://scoutisland.ca/">Scout Island Website</a>
                </div>
            </div>
        </div>
    </body>
</html>
