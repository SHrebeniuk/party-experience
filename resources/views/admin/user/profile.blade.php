@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">Update profile</div>
			</div>

			<user-edit
			:user="{{ auth()->user() }}"></user-edit>
		</div>
	</div>
</div>
@endsection
