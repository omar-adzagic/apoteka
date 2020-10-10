@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Dodaj Lijek</h1>

	{{ \Session::get('success') }}
	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('medicines.store') }}">
					@csrf

					<div class="field">
						<label class="label" for="name">Naziv</label>
						<div class="control">
							<input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" type="text" placeholder="Naziv" value="{{ session('stariNaziv') ?? old('name') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'name'])

					<div class="field">
						<label class="label" for="tip">Tip</label>
						<div class="select">
							<select class="" name="medicine_type_id">
								<option disabled>Izaberite Tip</option>
								@foreach($medicineTypes as $medicineType)
									<option
										value="{{ session('stariTipId') ?? old('medicine_type_id') ?? $medicineType->id }}"
													 {{ (session('stariTipId') == $medicineType->id ||
															 old('medicine_type_id') == $medicineType->id) ? 'selected' : '' }}
									>
										{{ $medicineType->name }}
									</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="field">
						<label class="label" for="price">Cijena</label>
						<div class="control">
							<input class="input {{ $errors->has('price') ? 'is-danger' : '' }}" name="price" type="text" placeholder="Cijena" value="{{ session('oldPrice') ?? old('price') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'price'])

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Dodaj Lijek</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
