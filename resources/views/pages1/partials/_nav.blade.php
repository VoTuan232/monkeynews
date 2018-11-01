      <div class="container">
        <a class="navbar-brand" href="#">News Everything</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home
                <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
      </li>
      @if(!Auth::user())
      <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Sign up</a>
      </li>
      @else
      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
      </li>
      <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                      <a href="#" class="dropdown-toggle user_home" data-toggle="dropdown">
                        <span class="hidden-xs">{{ Auth()->user()->name }}</span>
                    </a>
                    <div>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                              <img src="{{ asset('/images/taylor.jpg') }}" class="img-circle" alt="User Image" width="160" height="70 ">
                        </li>
                        <li class="user-body">
                            @if (auth()->user()->isAdmin())
                            <div class="col-xs-4 text-center">
                              <a href="/admin"><i class="fas fa-home"></i>Manager</a>
                            </div>
                            @else
                            @endif

                          <div class="col-xs-4 text-center">
                              <a href="#"><i class="fas fa-user"></i>Profife</a>
                          </div>
                          <div class="col-xs-4 text-center">
                              <a href="{{ route('storages.posts.index') }}">
                              <i class="fas fa-archive"></i>Save</a>
                          </div>
                          <div class="col-xs-4 text-center">
                              <a href="{{ route('draft.posts.index') }}">
                              <i class="fas fa-drafting-compass"></i>Drawf</a>
                          </div>
                          <hr>
                          <div class="col-xs-4 text-center">
                              <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Logout</a>
                          </div>
                  </li>
              </ul>
          </div>

      </li>
  </ul>
</div>
</nav>

@endif
</ul>
</div>
</div>
