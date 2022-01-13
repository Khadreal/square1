@extends( 'common.layouts.master' )

@section('content')
	<div class="container-sm col-6">
		<div class="card">
			<div class="card-header">
				Login
			</div>
			<div class="card-body">
				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<form method="post" action="{{ route('auth.register') }}">
					@csrf
					<div class="mb-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" value="{{old('email')}}" class="form-control" id="email" required name="email" placeholder="Email address">
					</div>

					<div class="mb-3">
						<label for="name" class="form-label">Full name</label>
						<input type="text" value="{{old('name')}}" class="form-control" id="name" required name="name" placeholder="Full name">
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-primary">Sign up</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection