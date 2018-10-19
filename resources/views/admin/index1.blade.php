
<!DOCTYPE html>
<html>
   <head>
      {{-- <base href="{{ asset('bower_components/bower-admin') }}/"> --}}
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>News Management @yield('title') </title>
      <link href="{{ asset('bower_components/bower-admin/css/bootstrap.css') }}" rel="stylesheet">
      <!-- <link href="css/datepicker3.css" rel="stylesheet"> -->
      <link href="{{ asset('bower_components/bower-admin/css/styles.css') }}" rel="stylesheet">
      <!-- <script type="text/javascript" src="ckeditor/ckeditor.js') }}"></script> -->
      <script src="{{ asset('bower_components/bower-admin/js/lumino.glyphs.js') }}"></script>

       {{-- <base href="{{ asset('/')}}"> --}}
       
       @yield('stylesheets')
   </head>
   <body>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container-fluid">
            <div class="navbar-header">
               <a class="navbar-brand" href="#">Quản lí tin tức</a>
               <ul class="user-menu">
                  <li class="dropdown pull-right">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->name }}
                        <svg class="glyph stroked male-user">
                           <use xlink:href="#stroked-male-user"></use>
                        </svg>
                        <span class="caret"></span>
                     </a>
                     <ul class="dropdown-menu" role="menu">
                        <li>
                           <a href="{{ asset('logout') }}">
                              <svg class="glyph stroked cancel">
                                 <use xlink:href="#stroked cancel"></use>
                              </svg>
                              Logout
                           </a>
                        </li>
                     </ul>

                  </li>
               </ul>
            </div>
         </div>
         <!-- /.container-fluid -->
      </nav>
      <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
         <ul class="nav menu">
            <li role="presentation" class="divider"></li>
            <li class="{{ Request::is('admin') ? "active" : "" }}">
               <a href="{{ route('admin.index') }}">
                  <svg class="glyph stroked dashboard-dial">
                     <use xlink:href="#stroked-dashboard-dial"></use>
                  </svg>
                  Trang chủ
               </a>
            </li>
           
            <li class="{{ Request::is('manager/posts') ? "active" : "" }}">
               <a href="{{ route('posts.index') }}">
                  <svg class="glyph stroked calendar">
                     <use xlink:href="#stroked-calendar"></use>
                  </svg>
                  Bài viết
               </a>
            </li>  
            <li>
               <a href="{{ route('posts.index') }}">
                  <svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
                  Người dùng
               </a>
            </li>
              <li>
               <a href="{{ route('posts.index') }}">
                 <svg class="glyph stroked sound on"><use xlink:href="#stroked-sound-on"/></svg>
                  Phân quyền
               </a>
            </li>
              <li>
               <a href="{{ route('posts.index') }}">
                  <svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>
                  Chuyên mục
               </a>
            </li>
            <li>
               <a href="{{ route('tags.index') }}">
                  <svg class="glyph stroked line-graph">
                     <use xlink:href="#stroked-line-graph"></use>
                  </svg>
                  Thẻ
               </a>
            </li>
            <li>
               <a href="#">
                  <svg class="glyph stroked line-graph">
                     <use xlink:href="#stroked-line-graph"></use>
                  </svg>
                  Bình luận
               </a>
            </li>
            <li>
               <a href="#">
                  <svg class="glyph stroked clock"><use xlink:href="#stroked-clock"/></svg>
                  Kho lưu trữ
               </a>
            </li>
            <li role="presentation" class="divider"></li>
         </ul>
      </div>
      <!--/.sidebar-->
      @yield('main');
      <script src="{{ asset('bower_components/jquery/dist/jquery.js') }}"></script>
      <script src="{{ asset('bower_components/bower-admin/js/bootstrap.js') }}"></script>
      {{-- <script src="{{ asset('bower_components/bower-admin/js/chart.min.js"></script>
      <script src="{{ asset('bower_components/bower-admin/js/chart-data.js"></script>
      <script src="{{ asset('bower_components/bower-admin/js/easypiechart.js"></script>
      <script src="{{ asset('bower_components/bower-admin/js/easypiechart-data.js"></script>
      <script src="{{ asset('bower_components/bower-admin/js/bootstrap-datepicker.js"></script>
      <script type="text/javascript" src="xemlich.js"></script> --}}
      @yield('javascript')
   </body>
</html>

