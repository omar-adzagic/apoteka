@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Izmijeni Trebovanje</h1>

	<div class="columns">
		<div class="column box is-two-thirds is-offset-2">
			<form method="POST" action="{{ route('orders.update', compact('order')) }}">
				@method('PATCH')
				@csrf

				<div class="field">
					<label class="label" for="medicine_id">Naziv Lijeka</label>
					<div class="select">
						<select name="medicine_id">
							<option disabled>Izaberite Lijek</option>
							@foreach($medicines as $medicine)
								<option value="{{ $medicine->id }}"
									@if(!empty(old('medicine_id')))
										{{ old('medicine_id') == $medicine->id ? 'selected' : '' }}
									@else
										{{ $medicine->id == $order->medicine->id ? 'selected' : '' }}
									@endif
								>{{ $medicine->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="field">
					<label class="label" for="quantity">Količina (Pakovanja)</label>
					<div class="control">
						<input class="input {{ $errors->has('quantity') ? 'is-danger' : '' }}" name="quantity" type="text" placeholder="Količina" value="{{ $order->quantity }}">
					</div>
				</div>

				@if($errors->has('quantity'))
					<div class="notification is-danger">
						{{ $errors->first('quantity') }}
					</div>
				@endif

				<div class="field">
					<label class="label" for="price">Cijena (&euro;)</label>
					<div class="control">
						<input class="input" name="price" type="text" placeholder="Cijena" value="{{ $order->price }}">
					</div>
				</div>

				@if($errors->has('price'))
					<div class="notification is-danger">
						{{ $errors->first('price') }}
					</div>
				@endif

				<div class="field">
					<div class="control">
						<button class="button is-primary" type="submit">Izmijeni Trebovanje</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
