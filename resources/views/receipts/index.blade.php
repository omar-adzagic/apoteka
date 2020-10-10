@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Računi</h1>

	@if(session()->has('message'))
		<div class="notification is-primary has-text-weight-bold">
			{{ session('message') }}
		</div>
	@endif

	<table class='table is-fullwidth is-bordered is-striped'>
		<thead>
			<tr>
				<th class="has-text-centered">
					<a href="{{ route('receipts.sort', ['parametar' => 'id']) }}">
						ID <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Naziv / Nazivi</th>
				<th class="has-text-centered">Cijena / Cijene (&euro;)</th>
				<th class="has-text-centered">Prodata Količina</th>
				<th class="has-text-centered">Iznos za Svaki Lijek (&euro;)</th>
				<th class="has-text-centered">
					<a href="{{ route('receipts.sort', ['parametar' => 'ukupan_iznos']) }}">
						Ukupan Iznos (&euro;) <i class="fas fa-sort"></i>
					</a>
				</th>
				@if(!Auth::guest() && auth()->user()->role->name == 'Manager')
					<th class="has-text-centered" colspan="2">Alati</th>
				@else
					<th class="has-text-centered" colspan="1">Alati</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($receipts as $receipt)
				<tr>
					<td class="has-text-centered">{{ $receipt->id }}</td>
					<td class="has-text-centered">
						{!! $receipt->medicines->implode('name', '<hr>') !!}
					</td>
					<td class="has-text-centered">
						{!! $receipt->medicines->implode('price', '<hr>') !!}
					</td>
					<td class="has-text-centered">
						{!! $receipt->medicines->pluck('pivot')->implode('quantity', '<hr>') !!}
					</td>
					<td class="has-text-centered">
						{!! $receipt->medicines->pluck('pivot')->implode('value', '<hr>') !!}
					</td>
					<td class="has-text-centered">
						{{ $receipt->medicines->pluck('pivot')->sum('value') }}
					</td>
					<td class="has-text-centered">
						<a class="button is-info" href="{{ route('receipts.show', compact('receipt')) }}">Prikaži</a>
					</td>
					@if(!Auth::guest() && auth()->user()->role->name == 'Manager')
						<td class="has-text-centered">
							<form method="POST" action="{{ route('receipts.destroy', compact('receipt')) }}">
								@method('DELETE')
								@csrf
								<button class="button is-danger" type="submit">Izbriši</button>
							</form>
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="field futer">
		<div class="control box sijenka">
			<form method="POST" action="{{ route('receipts.brojLjekova') }}">
				@csrf
				<div class="columns">
					<div class="column is-2">
						<button class="button is-primary napravi" type="submit">Napravi Račun</button>
					</div>
					<div class="column is-3 brojLjekova">
						<input class="input" type="number" name="brojLjekova" placeholder="Unesite Broj Ljekova" value="{{ old('brojLjekova') }}">
					</div>
					<div class="column is-7 is-pulled-right">
						<div class="is-pulled-right">
							{{ $receipts->links()}}
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	@if($errors->has('brojLjekova'))
		<div class="notification is-danger">
			{{ $errors->first('brojLjekova') }}
		</div>
	@endif
@endsection
