@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Order display (ID: {{ $order->id }})</h1>

	<table class='table is-fullwidth is-bordered is-striped prikaz'>
		<thead>
			<tr>
				<th class="has-text-centered">Property (<small class="has-text-grey">Quantity unit</small>)</th>
				<th class="has-text-centered">Value</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Medicine name</td>
				<td>{{ $order->medicines->implode('name', ' | ') }}</td>
			</tr>
			<tr>
				<td>Quantity (Pack)</td>
				<td>
					{{ $order->medicines->pluck('pivot')->implode('quantity', ' | ') }}
				</td>
			</tr>
			<tr>
				<td>Time</td>
				<td>
					{{ date('d/m/Y - H:i', strtotime($order->created_at)) }} |
					<small class="has-text-grey">
						{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
					</small>
				</td>
			</tr>
			<tr>
				<td>Menager</td>
				<td>{{ $order->manager }}</td>
			</tr>
		</tbody>
	</table>
@endsection
