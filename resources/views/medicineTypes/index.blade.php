@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Medicine types</h1>

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
						ID
                        <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('medicineTypes.sort', ['parametar' => 'name']) }}">
						Medicine type <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Medicines of this type</th>
				<th class="has-text-centered" colspan="2">Action</th>
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
						<a class="button is-link" href="{{ route('medicineTypes.edit', compact('medicineType')) }}">
                            Edit
                        </a>
					</td>
					<td class="has-text-centered">
						<form method="POST" action="{{ route('medicineTypes.destroy', compact('medicineType')) }}">
							@method('DELETE')
							@csrf
							<button class="button is-danger" type="submit">Delete</button>
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
					<a class="button is-primary napravi" href="{{ route('medicineTypes.create') }}">Add medicine type</a>
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
