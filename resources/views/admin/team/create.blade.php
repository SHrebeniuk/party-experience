@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">Create new team</div>
			</div>

			<team-create
			:user="{{ auth()->user() }}"
			@if(isset($team))
			:team="{{ $team }}"
			@endif></team-create>
		</div>
	</div>
</div>
@endsection
