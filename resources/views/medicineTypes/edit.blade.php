@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Edit medicine type</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('medicineTypes.update', compact('medicineType')) }}">
					@method('PATCH')
					@csrf

					<div class="field">
						<label class="label" for="name">Name</label>
						<div class="control">
							<input class="input {{ $errors->has('name') ? 'is-danger' : '' }}"
                                   name="name"
                                   type="text"
                                   placeholder="Enter name"
                                   value="{{ session()->get('oldName') ?? $medicineType->name }}">
							<input type="hidden" name="originalni_naziv" value="{{ $medicineType->name }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'name'])

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Edit medicine type</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
