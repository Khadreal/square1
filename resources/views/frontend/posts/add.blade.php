@extends( 'common.layouts.master' )

@section('content')
	<div class="row">
		<div class="col-3 p-3" style="background-color: #cbe9ff;">
			<h2>Menu</h2>
			<ul class="nav flex-column">
				<li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="{{ route('my.posts') }}">My Posts</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="{{ route('post.add') }}">Add post</a>
		        </li>
			</ul>
		</div>
		<div class="col-sm-9 bg-light p-3">
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