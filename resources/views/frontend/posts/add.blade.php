@extends( 'common.layouts.master' )

@section('content')
	<div class="row">
		@include('frontend.posts._sidebar')
		<div class="col-sm-9 bg-light p-3">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<form method="post" action="{{ route('post.store') }}">
				@csrf
				<div class="mb-3">
					<label for="title" class="form-label">Title</label>
					<input type="text" value="{{ old('title') }}" class="form-control" id="title" required name="title" placeholder="Post title">
				</div>

				<div class="mb-3">
					<label for="description" class="form-label">Description</label>
					<textarea name="description" required class="form-control">{{ old('description') }}</textarea>
				</div>

				<div class="mb-3">
					<label for="status">Status</label>
					<select name="status" class="form-control" required id="status">
						<option value="publish">Publish</option>
						<option value="draft">Draft</option>
					</select>
				</div>

				<div class="col-12">
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
			</form>
		</div>
	</div>
@endsection