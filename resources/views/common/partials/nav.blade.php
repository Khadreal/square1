<header class="d-flex justify-content-between mb-5 py-4">
	<a href="{{ route('home') }}" class="nav-link">
		SQ1
	</a>
	<ul class="nav justify-content-end">
	  <li class="nav-item">
	    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
	  </li>
	  
	  @auth
	  <li class="nav-item">
	    <a class="nav-link active" aria-current="page" href="{{ route('my.posts') }}">My Posts</a>
	  </li>
	  @else
	  <li class="nav-item">
	    <a class="nav-link" href="{{ route('login') }}">Login</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="{{ route('register') }}">Register</a>
	  </li>
	  @endauth
	</ul>
</header>