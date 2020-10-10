@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Izmijeni Korisnika</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box">
				<form method="POST" action="{{ route('users.update', compact('user')) }}">
					@method('PATCH')
					@csrf

					<div class="field">
						<label class="label" for="ime">Ime</label>
						<div class="control">
							<input class="input {{ $errors->has('ime') ? 'is-danger' : '' }}" name="ime" type="text" placeholder="Ime" value="{{ old('ime') ?? $user->ime }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'ime'])

					<div class="field">
						<label class="label" for="prezime">Prezime</label>
						<div class="control">
							<input class="input {{ $errors->has('prezime') ? 'is-danger' : '' }}" name="prezime" type="text" placeholder="Prezime" value="{{ old('prezime') ?? $user->prezime }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'prezime'])

					<div class="field">
						<label class="label" for="email">Email</label>
						<div class="control">
							<input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" type="email" placeholder="Email" value="{{ old('email') ?? $user->email }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'email'])

					<div class="field">
						<label class="label" for="role_id">Uloga</label>
						<div class="select">
							<select name="role_id">
								@foreach($roles as $role)
									<option value="{{ $role->id }}"
										@if(!empty(old('role_id')))
											{{ $role->id == old('role_id') ? 'selected' : '' }}
										@else
											{{ $role->id == $user->role->id ? 'selected' : '' }}
										@endif
									>
										{{ old('role_id')->role ?? $role->name == 'Manager' ? 'Manager' : 'Seller' }}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="field">
						<label class="label" for="password">Lozinka | <small>Opciono Polje</small></label>
						<div class="control">
							<input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password" type="password" placeholder="Lozinka"> {{-- value="{{ old('password') ?? $user->password }}" --}}
						</div>
					</div>

					@include('partials.error', ['name' => 'password'])

					<div class="field">
						<label class="label" for="password_confirmation">Potvrda Lozinke</label>
						<div class="control">
							<input class="input" name="password_confirmation" type="password" placeholder="Lozinka"> {{-- value="{{ old('password_confirmation') ?? $user->password }}" --}}
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Izmijeni Korisnika</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
