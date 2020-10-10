	
@extends('layout')

@section('content')
	<h1 class="title has-text-centered">{{ __('Register') }}</h1>

	<div class="columns">
		<div class="column is-half is-offset-one-quarter">
			<div class="box">
				<form method="POST" action="{{ route('register') }}">
					@csrf
					
					<div class="field">
						<label class="label">{{ __('Ime') }}</label>
						<div class="control">
							<input id="ime" type="text" class="input @error('ime') is-danger @enderror" name="ime" value="{{ old('ime') }}" {{-- required --}} autocomplete="ime" placeholder="Ime" autofocus>
						</div>
					</div>
					
					@error('ime')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror
					
					<div class="field">
						<label class="label">{{ __('Prezime') }}</label>
						<div class="control">
							<input id="prezime" type="text" class="input @error('prezime') is-danger @enderror" name="prezime" value="{{ old('prezime') }}" {{-- required --}} autocomplete="prezime" placeholder="Prezime" autofocus>
						</div>
					</div>
					
					@error('prezime')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror

					<div class="field">
						<label class="label">{{ __('Email') }}</label>
						<div class="control">
							<input id="email" type="text" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" {{-- required --}} autocomplete="email" placeholder="Email" autofocus>
						</div>
					</div>
					
					@error('email')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror

					<div class="field">
						<label class="label">{{ __('Lozinka') }}</label>
						<div class="control">
							<input id="password" type="password" class="input @error('password') is-danger @enderror" name="password" value="{{ old('password') }}" {{-- required --}} autocomplete="password" placeholder="Lozinka" autofocus>
						</div>
					</div>
					
					@error('password')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror
					
					<div class="field">
						<label class="label">{{ __('Potvrdi Lozinku') }}</label>
						<div class="control">
							<input id="password_confirmation" type="password" class="input @error('password_confirmation') is-danger @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" {{-- required --}} autocomplete="password_confirmation" placeholder="Potvrdi Lozinku" autofocus>
						</div>
					</div>
					
					@error('password_confirmation')
						<div class="notification is-danger" role="alert">
							{{ $message }}
						</div>
					@enderror

					<div class="field">
						<button class="button is-primary" type="submit">{{ __('Register') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
