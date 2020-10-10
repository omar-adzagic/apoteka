@extends('layout')

@section('content')
	<h1 class="title has-text-centered">
		{{ __('Login') }}
	</h1>
	
	<div class="columns">
		<div class="column is-half is-offset-one-quarter">
			<div class="box">
				<form method="POST" action="{{ route('login') }}">
					@csrf

					<div class="field">
						<label class="label">Email Adresa</label>
						<div class="control">
							<input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" {{-- required --}} autocomplete="email" autofocus>
						</div>
					</div>
					
					@error('email')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror

					<div class="field">
						<label class="label">Lozinka</label>
						<div class="control">
							<input id="password" type="password" class="input @error('password') is-danger @enderror" name="password" {{-- required --}} autocomplete="current-password">
						</div>
					</div>

					@error('password')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror
					
					<div class="field">
						<button type="submit" class="button is-primary">
							{{ __('Login') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
