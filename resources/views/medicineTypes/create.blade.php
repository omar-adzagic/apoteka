@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Dodaj Tip Lijeka</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('medicineTypes.store') }}">
					@csrf

					<div class="field">
						<label class="label" for="name">Naziv</label>
						<div class="control">
							<input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" placeholder="Naziv" value="{{ session('oldName') ?? old('name') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'name'])

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Dodaj Tip Lijeka</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
