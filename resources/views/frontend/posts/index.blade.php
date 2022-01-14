@extends( 'common.layouts.master' )

@section('content')
	<div class="row">
		@include('frontend.posts._sidebar')
		<div class="col-sm-9 bg-light p-3">
		<table class="table table-hover">
	  		<thead class="table-dark">
	  			<tr>
	  				<th>Title</th>
	  				<th>Status</th>
	  				<th>Date</th>
	  				<th>Action</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			@if($posts->isEmpty())
	  			<tr>
	  				<td class="text-center" colspan="3">No posts</td>
	  			</tr>
	  			@else
	  				@foreach($posts as $post)
	  				<tr>
	  					<td>{{ $post->title }}</td>
	  					<td>{{ ucfirst($post->status) }}</td>
	  					<td>{{ $post->created_at->format('y-m-d H:i:s a') }}</td>
	  					<td><a href="{{ route('post.edit',$post->id) }}">Edit</a></td>
	  				</tr>
	  				@endforeach
	  			@endif
	  		</tbody>
	  	</table>
	  	{{ $posts->links() }}
	  	</div>
	</div>
@endsection