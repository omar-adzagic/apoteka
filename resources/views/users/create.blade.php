@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Add user</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('users.store') }}">
					@csrf

					<div class="field">
						<label class="label" for="ime">Name</label>
						<div class="control">
							<input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" placeholder="Enter name" value="{{ old('name') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'name'])

					<div class="field">
						<label class="label" for="prezime">Surname</label>
						<div class="control">
							<input class="input {{ $errors->has('surname') ? 'is-danger' : '' }}" name="surname" type="text" placeholder="Enter surname" value="{{ old('surname') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'surname'])

					<div class="field">
						<label class="label" for="email">Email</label>
						<div class="control">
							<input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" type="email" placeholder="Enter email" value="{{ old('email') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'email'])

					<div class="field">
						<label class="label" for="role_id">Role</label>
						<div class="select">
							<select name="role_id">
								@foreach($roles as $role)
									<option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
										{{ $role->name }}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="field">
						<label class="label" for="password">Password</label>
						<div class="control">
							<input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password" type="password" placeholder="Enter password">
						</div>
					</div>

					@include('partials.error', ['name' => 'password'])

					<div class="field">
						<label class="label" for="password_confirmation">Password confirmation</label>
						<div class="control">
							<input class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}" name="password_confirmation" type="password" placeholder="Confirm password">
						</div>
					</div>

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Add user</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
