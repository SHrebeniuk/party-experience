@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between">
					<h5>Teams management</h5>
					{{-- <a href="/teams/create">Create team</a> --}}
				</div>
			</div>

			<teams-list :user="{{ auth()->user() }}" :teams="{{ $teams }}"></teams-list>
		</div>
	</div>
</div>
@endsection
