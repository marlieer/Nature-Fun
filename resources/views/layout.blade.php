<!DOCTYPE html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Nature Fun')</title>
	@toastr_css
	<link rel ="stylesheet" type="text/css" href="{{url('/css/style.css')}}"/>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<div class="content">
	        <div class="title m-b-md">
	            @yield('h1')
	        </div>
	    </div>

</head>
<body>
	<ul>
		<li><a href="/">Home</a></li>
		<li><a href="/session">Summer Schedule</a></li>
		<li><a href="/signup">Sign Up</a></li>
	</ul>
	@yield('content')
</body>
@jquery
@toastr_js
@toastr_render
</html>