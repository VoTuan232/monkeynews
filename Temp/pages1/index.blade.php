<!DOCTYPE html>
<html lang="en">
 @include('pages.partials._head')

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      @include('pages.partials._nav')
    </nav>

    <!-- Page Content -->
    <div class="container">
      <!-- Heading Row -->
      <div class="row my-4">
        @include('pages.partials._priview')
      </div>
      <!-- /.row -->
      <!-- Call to Action Well -->
      <div class="card text-white bg-secondary my-4 text-center">
        @include('pages.partials._header')
      </div>
      <!-- Content Row -->
      <div class="row">
        @yield('content')
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
     @include('pages.partials._footer')
    </footer>

  @include('pages.partials._javascript')
  @yield('javascript')
  </body>

</html>
