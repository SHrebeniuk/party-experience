@extends('admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			
			<h4 class="mb-3">Update your photo</h4>


			@if($user->photo)
				<img src="/storage/{{$user->photo}}" alt="{{$user->name}}" width="100" height="100">
			@endif

			<div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('update-photo') }}"enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="photo" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>



			<div>
				<h4 class="mb-3 mt-5">Update your info</h4>

				<form method="POST" action="{{ route('update-profile') }}">
					@csrf
					{{ method_field('patch') }}

					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">Description</label>

						<div class="col-md-6">
							<textarea id="description" rows="4" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ $user->description }}</textarea>

							@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
