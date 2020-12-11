<?php use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Nature Fun')</title>

    <!--Style-->
@yield('header')

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">


</head>
<body>
<header>
    <!-- Top nav bar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="{{ route('welcome') }}" class="navbar-brand">Nature Fun</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{$_SERVER['REQUEST_URI'] == '/dashboard' ? ' active' : ''}}">Dashboard</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a href="{{ route('session.index') }}"
                       class="nav-link {{$_SERVER['REQUEST_URI'] == '/session' ? ' active' : ''}}">Summer Calendar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact_us') }}"
                       class="nav-link {{$_SERVER['REQUEST_URI'] == '/contact_us' ? ' active' : ''}}">Contact Us</a>
                </li>
                @auth
                    @if(Auth::user()->isAdmin())
                        <li>
                            <a href="{{ route('session.create') }}"
                               class="nav-link {{ $_SERVER['REQUEST_URI'] == '/report-deadlines' ? ' active' : '' }}">Create
                                Sessions</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ strpos( $_SERVER['REQUEST_URI'], 'training') != false ? ' active' : ''}}"
                               data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">Manage
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('users.index')}}"
                                   class="dropdown-item {{ strpos( $_SERVER['REQUEST_URI'], 'users') != false ? ' active' : ''}}">Users</a>
                                <a href="{{ route('child.index') }}"
                                   class="dropdown-item {{ strpos( $_SERVER['REQUEST_URI'], 'child') != false ? ' active' : ''}}">Children</a>
                            </div>
                        </li>

                    @else
                        <li class="nav-item">
                            <a href="{{ route('registration.index') }}"
                               class="nav-link {{$_SERVER['REQUEST_URI'] == '/registration' ? ' active' : ''}}">My
                                Registrations</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!--Right side of nav bar-->
            <ul class="navbar-nav justify-content-end">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            @if(isset($user_avatar))
                                <img src="{{ $user_avatar }}" class="rounded-circle align-self-center mr-2"
                                     alt="user_avatar"
                                     style="width: 32px;">
                            @else
                                <i class="far fa-user-circle fa-lg rounded-circle align-self-center mr-2"
                                   style="width: 32px;"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <h5 class="dropdown-item-text mb-0">{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</h5>
                            <p class="dropdown-item-text text-muted mb-0">{{ Auth::user()->email }}</p>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{csrf_field()}}
                                Logout
                            </form>
                        </div>
                    </li>
                @endauth

            </ul>
        </div>
    </nav>
</header>
<main>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <div class="container">
        <h1 class=" d-sm-block" style=" text-align: center; padding-top: 15px ;">@yield('h1')</h1>
        @if ($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <p>
                        {{ $error }}
                    </p>
                </div>
            @endforeach
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif
        <br>
        @yield('content')
    </div>
</main>
</body>
</html>
