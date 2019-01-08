
@if (Session::has('message'))
	<div class="alert alert-success" role="alert">
		{{ Session::get('message') }}
	</div>
@endif

{{-- @if (count($errors) >0 )

	<div class="alert alert-danger" role="alert">
		<strong>Error: </strong>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>

@endif --}}