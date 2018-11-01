<div class="card-body">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 cat_nav">
	    	<li class="nav-item {{ Request::is('/') ? "li-manager" : "" }}">
		        <a class="nav-link" href="{{ route('pages.index') }}">Trang chủ</a>
		     </li>
	    	@foreach($catHomes as $category)
		      <li class="nav-item">
		        <a class="nav-link" href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}">{{ $category->name }}</a>
		      </li>
	    	@endforeach
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
	</nav>
</div>

