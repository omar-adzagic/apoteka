@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Receipt display (ID: {{ $receipt->id }})</h1>

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
				<td>{{ $receipt->medicines->implode('name', ' | ') }}</td>
			</tr>
			<tr>
				<td>Price (&euro;)</td>
				<td>
					{{ $receipt->medicines->implode('price', ' | ') ?? 'Unknown' }}
				</td>
			</tr>
			<tr>
				<td>Quantity (Pack)</td>
				<td>
					{{ $receipt->medicines->pluck('pivot')->implode('quantity', ' | ') }}
				</td>
			</tr>
			<tr>
				<td>Medicine price (&euro;)</td>
				<td>{{ $receipt->medicines->pluck('pivot')->implode('value', ' | ') }}</td>
			</tr>
			<tr>
				<td>Total price (&euro;)</td>
				<td>{{ $receipt->medicines->pluck('pivot')->sum('value') }}</td>
			</tr>
			<tr>
				<td>Receipt issuing date</td>
				<td>
					{{ date('d/m/Y - H:i', strtotime($receipt->created_at)) }} |
					<small class="has-text-grey">
						{{ Carbon\Carbon::parse($receipt->created_at)->diffForHumans() }}
					</small>
				</td>
			</tr>
			<tr>
				<td>Seller</td>
				<td>{{ $receipt->seller }}</td>
			</tr>
		</tbody>
	</table>
@endsection
