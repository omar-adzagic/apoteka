@extends('layout')

@section('content')
	<h1 class="title has-text-centered">Users</h1>

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
					<a href="{{ route('users.sort', ['parametar' => 'name']) }}">
						Name <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'surname']) }}">
						Surname <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'email']) }}">
						Email <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered">Role</th>
				<th class="has-text-centered">
					<a href="{{ route('users.sort', ['parametar' => 'created_at']) }}">
						Registration date <i class="fas fa-sort"></i>
					</a>
				</th>
				<th class="has-text-centered" colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="has-text-centered">{{ $user->id }}</td>
					<td class="has-text-centered">{{ $user->name }}</td>
					<td class="has-text-centered">{{ $user->surname }}</td>
					<td class="has-text-centered">{{ $user->email }}</td>
					<td class="has-text-centered">
						{{ $user->role->name }}
					</td>
					<td class="has-text-centered">
						{{ date('d/m/Y', strtotime($user->created_at)) }} |
						<small class="has-text-grey">
							<em>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</em>
						</small>
					</td>
					<td class="has-text-centered">
						<a class="button is-link" href="/users/{{ $user->id }}/edit">Edit</a>
					</td>
					<td class="has-text-centered">
						<form method="POST" action="{{ route('users.destroy', compact('user')) }}">
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
				<div class="column">
					<a class="button is-primary" href="{{ route('users.create') }}">Add user</a>
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
