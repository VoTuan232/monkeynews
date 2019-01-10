<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manager @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('bower_components/admin-layout/bower_components/assets_backend/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/admin-layout/bower_components/assets_backend/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/admin-layout/bower_components/assets_backend/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/admin-layout/bower_components/assets_backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
        @yield('stylesheets')

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>DM</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                            <select name="language" onchange="location = this.value;">
                                <option value="{!! route('user.change-language', ['en']) !!}" <?php if($language == 'en') echo 'selected'; ?> >English</option>
                                <option value="{!! route('user.change-language', ['vn']) !!}" <?php if($language == 'vn') echo 'selected'; ?> >VietNam</option>
                            </select>

                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">{{ Auth::user()->name }}
                                <span class="glyphicon glyphicon-user"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                        <p>
                                            Võ Anh Tuấn - Web Developer
                                            <small>Member since Nov. 2018</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer col-md-12">
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header" class="active">
                            <h4 align="center">Manager</h4>
                        </li>
                        <li class="{{ Request::is('admin*') ? "li-manager" : "" }}">
                            <a href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <span>{{ __('language.home') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/posts*') ? "li-manager" : "" }}">
                            <a href="{{ route('posts.index') }}">
                           <i class="far fa-newspaper"></i>
                            <span>{{ __('language.manager_post') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/categories*') ? "li-manager" : "" }}">
                            <a href="{{ route('categories.index') }}">
                            <i class="fas fa-align-justify"></i>
                            <span>{{ __('language.manager_category') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/tags*') ? "li-manager" : "" }}">
                            <a href="{{ route('tags.index') }}">
                            <i class="fas fa-tags"></i>
                            <span>{{ __('language.manager_tag') }}</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/comments*') ? "li-manager" : "" }}">
                            <a href="{{ route('comments.index') }}">
                            <i class="fas fa-comments"></i>
                            <span>{{ __('language.manager_comment') }}</span>
                            <span class="pull-right-container">
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/users*') ? "li-manager" : "" }}">
                            <a href="{{ route('users.index') }}">
                            <i class="fas fa-user-plus"></i>
                            <span>{{ __('language.manager_user') }}</span>
                            <span class="pull-right-container">
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/roles*') ? "li-manager" : "" }}">
                            <a href="{{ route('roles.index') }}">
                            <i class="fas fa-user-shield"></i>
                            <span>{{ __('language.manager_role') }}</span>
                            <span class="pull-right-container">
                            </a>
                        </li>
                        <li class="{{ Request::is('manager/publish*') ? "li-manager" : "" }}">
                            <a href="{{ route('publish.index') }}">
                            <i class="fas fa-drafting-compass"></i>
                            <span>{{ __('language.manager_published') }}</span>
                            <span class="pull-right-container">
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('main')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.1.0
                </div>
                <strong>Copyright &copy; 2018 <a href="https://www.facebook.com/vo.tuan.3386">Võ Tuấn</a>.</strong>votuanbk232@gmail.com
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('bower_components/admin-layout/bower_components/assets_backend/dist/js/demo.js') }}"></script>
        @yield('javascript')
    </body>
</html>
