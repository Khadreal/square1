@extends( 'common.layouts.master' )

@section('content')
	
	<div class="row">
		<form method="get" action="" class="d-flex justify-content-end">
			<div class="row g-3 align-items-center">
			  <div class="col-auto">
			    <label for="name" class="col-form-label">Password</label>
			  </div>
			  <div class="col-auto">
			    <input type="search" id="name" name="q" value="{{ app('request')->input('q') }}" class="form-control" placeholder="Search by username/ name">
			  </div>
			  <div class="col-auto">
			    <button type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</div>
		</form>
	</div>
	<div class="row">
		@include('admin._sidebar')
		<div class="col-sm-9 bg-light p-3">
		<table class="table table-hover">
	  		<thead class="table-dark">
	  			<tr>
	  				<th>Name</th>
	  				<th>Username</th>
	  				<th>Role</th>
	  				<th>Post</th>
	  			</tr>
	  		</thead>
	  		<tbody>
	  			@if($users->isEmpty())
	  			<tr>
	  				<td class="text-center" colspan="3">No users</td>
	  			</tr>
	  			@else
	  				@foreach($users as $user)
	  				<tr>
	  					<td>{{ $user->name }}</td>
	  					<td>{{ $user->username }}</td>
	  					<td>{{ $user->role }}</td>
	  					<td>{{ $user->posts->count() }}</td>
	  				</tr>
	  				@endforeach
	  			@endif
	  		</tbody>
	  	</table>
	  	{{ $users->links('pagination::bootstrap-4') }}
	  	</div>
	</div>
@endsection