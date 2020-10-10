@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Trebovanja</h1>

	@if(session()->has('message'))
		<div class="notification is-primary has-text-weight-bold">
			{{ session('message') }}
		</div>
	@endif

	<table class='table is-fullwidth is-bordered is-striped'>
		<thead>
			<tr>
				<th class="has-text-centered">
					<a href="{{ route('orders.sort', ['parametar' => 'id']) }}">
						ID <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Naziv Lijeka / Ljekova</th>
				<th class="has-text-centered">Količina / Količine</th>
				<th class="has-text-centered">
					<a href="{{ route('orders.sort', ['parametar' => 'created_at']) }}">
						Vrijeme <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered" colspan="2">Alati</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
				<tr>
					<td class="has-text-centered centriraj">{{ $order->id }}</td>
					<td class="has-text-centered">
						{!! $order->medicines->implode('naziv', '<hr>') !!}
					</td>
					<td class="has-text-centered">
						{!! $order->medicines->pluck('pivot')->implode('quantity', '<hr>') !!}
					</td>
					<td class="has-text-centered">
						{{ date('d/m/Y - H:i', strtotime($order->created_at)) }} |
						<small class="has-text-grey">
							<em>{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</em>
						</small>
					</td>
					<td class="has-text-centered">
						<a class="button is-info" href="{{ route('orders.show', compact('order')) }}">Prikaži</a>
					</td>
					<td class="has-text-centered">
						<form method="POST" action="{{ route('orders.destroy', compact('order')) }}">
							@method('DELETE')
							@csrf
							<button class="button is-danger" type="submit">Izbriši</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="field">
		<div class="control box sijenka">
			<form method="POST" action="{{ route('orders.brojLjekova') }}">
				@csrf
				<div class="columns">
					<div class="column is-2">
						<button class="button is-primary napravi" type="submit">Napravi Trebovanje</button>
					</div>
					<div class="column is-3 brojLjekova">
						<input class="input" type="number" name="brojLjekova" placeholder="Unesite Broj Ljekova" value="{{ old('brojLjekova') }}">
					</div>
					<div class="column is-7 is-pulled-right">
						<div class="is-pulled-right">
							{{ $orders->links()}}
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
