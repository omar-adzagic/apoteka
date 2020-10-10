@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Ljekovi</h1>

	@if(session()->has('message'))
		<div class="notification is-primary">
			<strong>{{ session('message') }}</strong>
		</div>
	@endif

	<form id="pretraga" method="GET" action="{{ route('medicines.index') }}">
		@csrf
		<div class="pretraga field has-addons is-pulled-right">
			<div class="control">
				<input id="search" class="input" name="search" type="text" placeholder="Unesite Naziv Lijeka" value="{{ $search ?? '' }}">
			</div>
			<div class="control">
				<button class="button is-info" type="submit">Pretraga</button>
			</div>
		</div>
	</form>

	<table class='table is-fullwidth is-bordered is-hoverable'>
		<thead>
			<tr>
				<th class="has-text-centered ">
					<a href="{{ route('medicines.sort', ['parametar' => 'id']) }}">
						ID <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('medicines.sort', ['parametar' => 'name']) }}"> {{-- /medicines/sort/naziv --}}
						Naziv Lijeka <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('medicines.sort', ['parametar' => 'medicine_type']) }}">
						Tip Lijeka <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('medicines.sort', ['parametar' => 'quantity']) }}">
						Količina na Stanju (Pakovanje) <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('medicines.sort', ['parametar' => 'price']) }}">
						Cijena (&euro;) <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Napravi Račun</th>
				@if(!Auth::guest() && auth()->user()->role->name == 'Manager')
					<th class="has-text-centered" colspan="2">Alati</th>
				@endif
			</tr>
		</thead>
		<tbody id="tbody">
			{{ session()->get('medicines') ?? '' }}
			@foreach($medicines as $medicine)
				<tr>
					<td class="has-text-centered">{{ $medicine->id }}</td>
					<td class="has-text-centered">{{ $medicine->name }}</td>
					<td class="has-text-centered">
						{{ $medicine->medicineType->name ?? $medicine->medicine_type }}
					</td>
					<td class="has-text-centered">{{ $medicine->quantity }}</td>
					<td class="has-text-centered">{{ $medicine->price }}</td>
					<td class="has-text-centered">
						<a class="button" href="{{ route('receipts.createSingle', compact('medicine')) }}">
							Napravi Račun
						</a>
					</td>
					@if(!Auth::guest() && auth()->user()->role->name == 'Manager')
						<td class="has-text-centered">
							<a class="button is-link" href="{{ route('medicines.edit', compact('medicine')) }}">
								Izmijeni
							</a>
						</td>
						<td class="has-text-centered">
							<form method="POST" action="{{ route('medicines.destroy', compact('medicine')) }}">
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
			<div class="columns">
				@if(!Auth::guest() && auth()->user()->role->name == 'Manager')
					<div class="column is-2">
						<div class="field">
							<div class="control">
								<a class="button is-primary napravi" href="{{ route('medicines.create') }}">Dodaj Lijek</a>
							</div>
						</div>
					</div>
					<div class="column is-10 is-pulled-right">
				@else
					<div class="column is-12 is-pulled-right">
				@endif
					<div class="is-pulled-right">
						{{ $medicines->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		const search = document.getElementById('search');
		const pretragaForma = document.getElementById('pretraga');
		search.addEventListener('keyup', e => {
			if(e.target.value == '') {
				pretragaForma.submit();
			}
		});
	</script>
@endsection
