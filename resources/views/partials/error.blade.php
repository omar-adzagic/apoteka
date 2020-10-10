@if($errors->has($name))
	<div class="notification is-danger">
		{{ $errors->first($name) }}
	</div>
@endif