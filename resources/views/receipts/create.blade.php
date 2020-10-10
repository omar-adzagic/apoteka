@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Napravi Račun</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('receipts.store') }}">
					@csrf

					@for($i = 1; $i <= session('brojLjekova'); $i++)
						<div class="field">
							<label class="label" for="medicine_id_{{ $i }}">Naziv Lijeka</label>
							<div class="select">
								<select name="medicine_id_{{ $i }}">
									<option disabled>Izaberite Lijek</option>
									@foreach($medicines as $medicine)
										<option value="{{ $medicine->id }}" {{ old('medicine_id_' . $i) == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="field">
							<label class="label" for="quantity_{{ $i }}">Količina (Pakovanja)</label>
							<div class="control">
								<input class="input {{ $errors->has('quantity_' . $i) ? 'is-danger' : '' }}" name="quantity_{{ $i }}" type="text" placeholder="Količina" value="{{ old('quantity_' . $i) }}">
							</div>
						</div>

						@if($errors->has('quantity_' . $i))
							<div class="notification is-danger">
								{{ $errors->first('quantity_' . $i) }}
							</div>
						@endif

						<input type="hidden" name="brojLjekova" value="{{ $brojLjekova }}">
						<hr>
					@endfor

					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Napravi Račun</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
