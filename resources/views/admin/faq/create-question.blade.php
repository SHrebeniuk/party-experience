@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">
					@if(isset($question))
						Update
					@else
						Create
					@endif
					 question
				</div>
			</div>

			<question-create
			:user="{{ auth()->user() }}"
			@if(isset($question))
			:question="{{ $question }}"
			@endif></question-create>
		</div>
	</div>
</div>
@endsection
