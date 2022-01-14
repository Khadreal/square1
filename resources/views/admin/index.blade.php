@extends( 'common.layouts.master' )

@section('content')
	<div class="row mb-5">
	  <div class="col-sm-4">
	    <div class="card">
	      <div class="card-body">
	        <h5 class="card-title">Total posts</h5>
	        <p class="card-text">{{ $allPostCount }}</p>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-4">
	    <div class="card">
	      <div class="card-body">
	        <h5 class="card-title">Admin Post</h5>
	        <p class="card-text">{{ $adminPostCount }}</p>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-4">
	    <div class="card">
	      <div class="card-body">
	        <h5 class="card-title">Contributors Post</h5>
	        <p class="card-text">{{ $contributorCount }}</p>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="row">
		@include('admin._sidebar')
		<div class="col-sm-9 bg-light p-3">
		<table class="table table-hover">
	  		<thead class="table-dark">
	  			<tr>
	  				<th>Title</th>
	  				<th>Status</th>
	  				<th>Date</th>
	  				<th>Author</th>
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
	  					<td>{{ $post->user->name }}</td>
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