<header class="d-flex justify-content-between mb-5 py-4">
	<a href="#" class="nav-link">
		Logo
	</a>
	<ul class="nav justify-content-end">
	  <li class="nav-item">
	    <a class="nav-link active" aria-current="page" href="#">Home</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" aria-current="page" href="#">My Posts</a>
	  </li>
	  @auth
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