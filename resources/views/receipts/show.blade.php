@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Prikaz Računa (id: {{ $receipt->id }})</h1>

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
				<td>{{ $receipt->medicines->implode('name', ' | ') }}</td>
			</tr>
			<tr>
				<td>Cijena Lijeka / Ljekova (&euro;)</td>
				<td>
					{{ $receipt->medicines->implode('price', ' | ') ?? 'Nedefinisana' }}
				</td>
			</tr>
			<tr>
				<td>Količina (Pakovanje)</td>
				<td>
					{{ $receipt->medicines->pluck('pivot')->implode('quantity', ' | ') }}
				</td>
			</tr>
			<tr>
				<td>Iznos za Svaki Lijek (&euro;)</td>
				<td>{{ $receipt->medicines->pluck('pivot')->implode('value', ' | ') }}</td>
			</tr>
			<tr>
				<td>Ukupan Iznos (&euro;)</td>
				<td>{{ $receipt->medicines->pluck('pivot')->sum('value') }}</td>
			</tr>
			<tr>
				<td>Vrijeme Izdavanja Računa</td>
				<td>
					{{ date('d/m/Y - H:i', strtotime($receipt->created_at)) }} |
					<small class="has-text-grey">
						{{ Carbon\Carbon::parse($receipt->created_at)->diffForHumans() }}
					</small>
				</td>
			</tr>
			<tr>
				<td>Prodavac</td>
				<td>{{ $receipt->prodavac }}</td>
			</tr>
		</tbody>
	</table>
@endsection
