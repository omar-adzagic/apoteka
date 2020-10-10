@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Dodaj Korisnika</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('users.store') }}">
					@csrf

					<div class="field">
						<label class="label" for="ime">Ime</label>
						<div class="control">
							<input class="input {{ $errors->has('ime') ? 'is-danger' : '' }}" name="ime" type="text" placeholder="Ime" value="{{ old('ime') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'ime'])

					<div class="field">
						<label class="label" for="prezime">Prezime</label>
						<div class="control">
							<input class="input {{ $errors->has('prezime') ? 'is-danger' : '' }}" name="prezime" type="text" placeholder="Prezime" value="{{ old('prezime') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'prezime'])

					<div class="field">
						<label class="label" for="email">Email</label>
						<div class="control">
							<input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'email'])

					<div class="field">
						<label class="label" for="role_id">Uloga</label>
						<div class="select">
							<select name="role_id">
								@foreach($roles as $role)
									<option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
										{{ $role->name == 'Menadzer' ? 'Menadžer' : 'Prodavac' }}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="field">
						<label class="label" for="password">Lozinka</label>
						<div class="control">
							<input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password" type="password" placeholder="Lozinka">
						</div>
					</div>

					@include('partials.error', ['name' => 'password'])

					<div class="field">
						<label class="label" for="password_confirmation">Potvrda Lozinke</label>
						<div class="control">
							<input class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}" name="password_confirmation" type="password" placeholder="Potvrda Lozinke">
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Dodaj Korisnika</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
