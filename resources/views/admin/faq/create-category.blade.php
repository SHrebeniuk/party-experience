@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">
					@if(isset($category))
						Update
					@else
						Create
					@endif
					 category
				</div>
			</div>

			<category-create
			:user="{{ auth()->user() }}"
			@if(isset($category))
			:category="{{ $category }}"
			@endif></category-create>
		</div>
	</div>
</div>
@endsection
