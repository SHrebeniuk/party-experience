@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between">
					<h5>Questions management</h5>
					<a href="/questions/create">Create Question</a>
				</div>
			</div>

			<questions-list :user="{{ auth()->user() }}" :questions="{{ $questions }}"></questions-list>
		</div>
	</div>
</div>
@endsection
