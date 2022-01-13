<!doctype html>
<html lang="en">
@include('common.partials.head')
<body>

	<div class="container">
	@include('common.partials.nav')

	@include('common.flash')
	@yield('content')

	@include('common.partials.footer')
	</div>
</body>
</html>