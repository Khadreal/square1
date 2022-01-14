@extends( 'common.layouts.master' )

@section( 'content' )
	<div class="col mb-4">
		<form class="filter-form" action="" method="get">
			<div class="form-group">
				<label>Filter by pubication date</label>
				<select onchange="document.querySelector('.filter-form').submit()" name="filter" class="form-control">
					<option>Filter by date</option>
					@foreach(['asc' => 'old', 'desc' => 'latest'] as $key => $value)
					<option value="{{ $key }}" {{ app('request')->input('filter') === $key ? 'selected' : '' }} >{{ strtoupper($value) }}</option>
					@endforeach
				</select>
			</div>
		</form>
	</div>
	<div class="row justify-content-start">
		@foreach($posts as $post)
		<div class="col-4">
			<div class="card p-3 mb-5">
				<h3>{{$post->title}}</h3>
				<p>
					{{$post->content}}
				</p>
				<div class="meta d-flex justify-content-between">
					<span>
						By <strong>{{ $post->user->name}}</strong>
					</span>
					<span>
						{{ $post->publication_date->diffForHumans() }}
					</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>
@endsection