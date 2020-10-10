@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Izmijeni Račun</h1>

	<div class="columns">
		<div class="column box is-two-thirds is-offset-2">
			<form method="POST" action="{{ route('receipts.update', compact('receipt')) }}">
				@method('PATCH')
				@csrf

				@if($errors->has('pacijent'))
					<div class="notification is-danger">
						{{ $errors->first('pacijent') }}
					</div>
				@endif

				<div class="field">
					<label class="label" for="medicine_id">Naziv Lijeka</label>
					<div class="control">
						<div class="select">
							<select name="medicine_id">
								<option disabled>Izaberite Lijek</option>
								@foreach($medicines as $medicine)
									<option value="{{ $medicine->id }}"
										@if(!empty(old('medicine_id')))
											{{ old('medicine_id') == $medicine->id ? 'selected' : '' }}
										@else
											{{ $medicine->id == $receipt->medicine->id ? 'selected' : '' }}
											}
										@endif
									>{{ $medicine->naziv }}</option>
								@endforeach
							</select>
						</div>
						{{-- <input class="input" name="medicine_id" type="text" placeholder="Naziv Lijeka"  value="{{ $receipt->medicine->naziv }}" > --}}
					</div>
				</div>

				<div class="field">
					<label class="label" for="quantity">Količina</label>
					<div class="control">
						<input class="input {{ $errors->has('quantity') ? 'is-danger' : '' }}" name="quantity" type="text" placeholder="Količina" value="{{ $receipt->quantity }}">
					</div>
				</div>

				@if($errors->has('quantity'))
					<div class="notification is-danger">
						{{ $errors->first('quantity') }}
					</div>
				@endif

				<div class="field">
					<div class="control">
						<button class="button is-primary" type="submit">Izmijeni Račun</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
