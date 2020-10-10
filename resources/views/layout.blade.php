<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Apoteka')</title>
	{{-- Bulma 0.7.5 CDN --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css">
	{{-- Font Awesome 5.9.0 CDN --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
	{{-- Custom CSS --}}
	<link rel="stylesheet" href="{{ url('/css/app.css') }}">
</head>
<body>
	@include('partials.navbar')
	<div class="container">
		@yield('content')
	</div>
</body>
</html>