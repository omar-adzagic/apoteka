@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Prikaz Trebovanja (id: {{ $order->id }})</h1>

	<table class='table is-fullwidth is-bordered is-striped prikaz'>
		<thead>
			<tr>
				<th class="has-text-centered">Osobina (<small class="has-text-grey">Jedinica Mjere</small>)</th>
				<th class="has-text-centered">Vrijednost</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Naziv Lijeka / Ljekova</td>
				<td>{{ $order->medicines->implode('name', ' | ') }}</td>
			</tr>
			<tr>
				<td>Količina (Pakovanje)</td>
				<td>
					{{ $order->medicines->pluck('pivot')->implode('quantity', ' | ') }}
				</td>
			</tr>
			<tr>
				<td>Vrijeme</td>
				<td>
					{{ date('d/m/Y - H:i', strtotime($order->created_at)) }} |
					<small class="has-text-grey">
						{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
					</small>
				</td>
			</tr>
			<tr>
				<td>Menadžer</td>
				<td>{{ $order->menadzer }}</td>
			</tr>
		</tbody>
	</table>
@endsection
