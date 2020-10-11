@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Edit medicine</h1>
	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('medicines.update', ['medicine' => $medicine]) }}">
					@method('PATCH')
					@csrf

					<div class="field">
						<label class="label" for="name">Name</label>
						<div class="control">
							<input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" placeholder="Naziv" value="{{ session('oldName') ?? old('name') ?? $medicine->name }}">
							<input type="hidden" name="original_name" value="{{ $medicine->name }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'name'])

					<div class="field">
						<label class="label" for="tip">Type</label>
						<div class="select">
							<select class="" name="medicine_type_id">
								<option disabled>Choose type</option>
								@foreach($medicineTypes as $medicineType)
									<option value="{{ $medicineType->id }}"
										@if(!empty(old('medicine_type_id')))
											{{ old('medicine_type_id') == $medicineType->id ? 'selected' : '' }}
										@else
											{{ $medicine->medicine_type_id == $medicineType->id ? 'selected' : '' }}
										@endif
									>{{ $medicineType->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="field">
						<label class="label" for="price">Price</label>
						<div class="control">
							<input class="input {{ $errors->has('price') ? 'is-danger' : '' }}"
                                   name="price"
                                   type="text"
                                   placeholder="Enter price"
                                   value="{{ session('oldPrice') ?? old('price') ?? $medicine->price }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'price'])

					<div class="field">
						<div class="control">
							<button class="button is-link" type="submit">Edit medicine</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
