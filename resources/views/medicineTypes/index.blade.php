@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Tipovi Ljekova</h1>

	@if(session()->has('message'))
		<div class="notification is-primary has-text-weight-bold">
			{{ session('message') }}
		</div>
	@endif

	<table class='table is-fullwidth is-bordered is-hoverable'>
		<thead>
			<tr>
				<th class="has-text-centered">
					<a href="{{ route('medicineTypes.sort', ['parametar' => 'id']) }}">
						ID <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('medicineTypes.sort', ['parametar' => 'name']) }}">
						Tip Lijeka <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Ljekovi Ovog Tipa</th>
				<th class="has-text-centered" colspan="2">Alati</th>
			</tr>
		</thead>
		<tbody>
			@foreach($medicineTypes as $medicineType)
				<tr>
					<td class="has-text-centered">{{ $medicineType->id }}</td>
					<td>{{ $medicineType->name }}</td>
					<td>
						{{ $medicineType->medicines->implode('name', ', ') }}
					</td>
					<td class="has-text-centered">
						<a class="button is-link" href="{{ route('medicineTypes.edit', compact('medicineType')) }}">Izmijeni</a>
					</td>
					<td class="has-text-centered">
						<form method="POST" action="{{ route('medicineTypes.destroy', compact('medicineType')) }}">
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
			<div class="columns">
				<div class="column is-2">
					<a class="button is-primary napravi" href="{{ route('medicineTypes.create') }}">Dodaj Tip Lijeka</a>
				</div>

				<div class="column is-10 is-pulled-right">
					<div class="is-pulled-right">
						{{ $medicineTypes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
