@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Korisnici</h1>

	@if(session()->has('message'))
		<div class="notification is-primary has-text-weight-bold">
			{{ session('message') }}
		</div>
	@endif

	<table class='table is-fullwidth is-bordered is-hoverable'>
		<thead>
			<tr>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'id']) }}">
						ID <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'ime']) }}">
						Ime <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'prezime']) }}">
						Prezime <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'email']) }}">
						Email <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Uloga</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'created_at']) }}">
						Datum Registracije <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered" colspan="2">Alati</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="has-text-centered">{{ $user->id }}</td>
					<td class="has-text-centered">{{ $user->ime }}</td>
					<td class="has-text-centered">{{ $user->prezime }}</td>
					<td class="has-text-centered">{{ $user->email }}</td>
					<td class="has-text-centered">
						{{ $user->role->name == 'Menadzer' ? 'Menadžer' : 'Prodavac' }}
					</td>
					<td class="has-text-centered">
						{{ date('d/m/Y', strtotime($user->created_at)) }} |
						<small class="has-text-grey">
							<em>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</em>
						</small>
					</td>
					<td class="has-text-centered">
						<a class="button is-link" href="/users/{{ $user->id }}/edit">Izmijeni</a>
					</td>
					<td class="has-text-centered">
						<form method="POST" action="{{ route('users.destroy', compact('user')) }}">
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
				<div class="column">
					<a class="button is-primary" href="{{ route('users.create') }}">Dodaj Korisnika</a>
				</div>
				<div class="column is-one-quarter is-pulled-right">
					<div class="is-pulled-right">
						{{ $users->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
