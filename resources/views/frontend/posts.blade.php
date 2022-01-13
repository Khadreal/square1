@extends( 'common.layouts.master' )

@section('content')
	<div class="row">
		<div class="col-3 p-3" style="background-color: #cbe9ff;">
			<h2>Menu</h2>
			<ul class="nav flex-column">
				<li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="#">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#">Add post</a>
		        </li>
			</ul>
		</div>
		<div class="col-sm-9 bg-light p-3">
		<table class="table table-hover">
	  		<thead class="table-dark">
	  			<tr>
	  				<th>Title</th>
	  				<th>Status</th>
	  				<th>Date</th>
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
	  					<td>{{ $post->status }}</td>
	  					<td>{{ $post->created_at }}</td>
	  				</tr>
	  				@endforeach
	  			@endif
	  		</tbody>
	  	</table>
	  	{{ $posts->links() }}
	  	</div>
	</div>
@endsection