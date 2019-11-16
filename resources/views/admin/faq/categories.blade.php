@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header d-flex justify-content-between">
					<h5>Faq Categories</h5>
					<a href="/admin/categories/create">Create Category</a>
				</div>
			</div>

			<categories-list :categories="{{ $categories }}"></categories-list>
		</div>
	</div>
</div>
@endsection
