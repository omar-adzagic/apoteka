@extends('layout')

@section('content')
	<section class="hero is-medium is-primary is-bold">
		<div class="hero-body">
			{{-- <div class="container"> --}}
				<h1 class="title has-text-centered">Pharmacy</h1>
				<h2 class="subtitle has-text-centered is-italic">Omar Adžagić {{ Carbon\Carbon::now()->year }}</h2>
			{{-- </div> --}}
		</div>
	</section>
@endsection
