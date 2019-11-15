@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<team-show
			:user="{{ auth()->user() }}"
			@if(isset($team))
			:team="{{ $team }}"
			@endif></team-show>
		</div>
	</div>
</div>
@endsection
