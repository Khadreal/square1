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
			<form method="post" action="{{ route('post.update', $post->id) }}">
				@csrf
				<input type="hidden" name="id" value="{{ $post->id }}">
				<div class="mb-3">
					<label for="title" class="form-label">Title</label>
					<input type="text" value="{{ $post->title }}" class="form-control" id="title" required name="title" placeholder="Post title">
				</div>

				<div class="mb-3">
					<label for="content" class="form-label">Description</label>
					<textarea name="description" required class="form-control">{{ $post->content }}</textarea>
				</div>

				<div class="mb-3">
					<label for="status">Status</label>
					<select name="status" class="form-control" required id="status">
						@foreach(['publish','draft'] as $status)
						<option {{ $post->status === $status ? 'selected' : '' }} value="{{ $status }}">{{ ucfirst($status) }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-12">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
@endsection