<!doctype html>
<html lang="en">
@include( 'common.partials.header' )
<body>
	@include( 'common.partials.nav' )

	@yield( 'content' )

	@include( 'common.partials.footer' )
</body>
</html>