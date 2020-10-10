@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Napravi Račun</h1>

	<div class="columns">
		<div class="column is-two-thirds is-offset-2">
			<div class="box sijenka">
				<form method="POST" action="{{ route('receipts.storeSingle') }}">
					@csrf

					{{-- <input type="hidden" name="singleForma" value="true"> --}}
					<div class="field">
						<label class="label" for="medicine_id">Naziv Lijeka</label>
						<div class="control">
							<input class="input" name="medicine_id" type="hidden" value="{{ $medicine->id }}">
							<input class="input" type="text" value="{{ $medicine->name }}" readonly>
						</div>
					</div>

					<div class="field">
						<label class="label" for="quantity_na_stanju">Količina na Stanju (Pakovanje)</label>
						<div class="control">
							<input class="input {{ $errors->has('quantity_na_stanju') ? 'is-danger' : '' }}" name="quantity_na_stanju" type="text" value="{{ $medicine->quantity }}" readonly>
						</div>
					</div>

					<div class="field">
						<label class="label" for="cijena_po_pakovanju">Cijena po Pakovanju (&euro;)</label>
						<div class="control">
							<input class="input {{ $errors->has('cijena_po_pakovanju') ? 'is-danger' : '' }}" name="cijena_po_pakovanju" type="text" value="{{ $medicine->price }}" readonly>
						</div>
					</div>

					<div class="field">
						<label class="label" for="quantity">Količina za Kupovinu</label>
						<div class="control">
							<input class="input {{ $errors->has('quantity') ? 'is-danger' : '' }}" name="quantity" type="text" placeholder="Količina za Kupovinu" value="{{ old('quantity') }}">
						</div>
					</div>

					@include('partials.error', ['name' => 'quantity'])

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
