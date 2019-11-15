@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between links">
					<h5 class="text-uppercase">Choose team</h5>
					<span>OR</span>
					<a href="/teams/create" class="mb-0">Create team</a>
				</div>
			</div>

			<all-teams :teams="{{ $teams }}" :user="{{ auth()->user() }}"></all-teams>
		</div>
	</div>
</div>
@endsection
