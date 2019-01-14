<!DOCTYPE html>
<!--
    24 News by FreeHTML5.co
    Twitter: https://twitter.com/fh5co
    Facebook: https://fb.com/fh5co
    URL: https://freehtml5.co
-->
<html lang="en" class="no-js">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>24 DNews</title>
    <link href="{{ asset('client/css/media_query.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('client/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('client/css/animate.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="{{ asset('client/css/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('client/css/owl.theme.default.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('client/css/style_1.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('client/css/main.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Modernizr JS -->
    <script src="{{ asset('client/js/modernizr-3.5.0.min.js') }}"></script>

    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    
    {{-- toastr  --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    {{-- <script>
          var user = {!! json_encode((array)auth()->user()) !!};
    </script> --}}
    @yield('stylesheet')

</head>
<body>

    @include('users.profile')

<div class="container-fluid fh5co_header_bg">
    <div class="container">
        <div class="row">
            <div class="col-12 fh5co_mediya_center"><a href="#" class="color_fff fh5co_mediya_setting"><i
                    class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;{{ date('d-m-Y', strtotime($trending->trending)) }}</a>
                <div class="d-inline-block fh5co_trading_posotion_relative"><a href="{{ route('home.trending') }}" class="treding_btn">Trending</a>
                    <div class="fh5co_treding_position_absolute"></div>
                </div>
                <a href="{{ route('home.single', ['slug' => str_slug($trending->slug)]) }}" class="color_fff fh5co_mediya_setting">{{ $trending->title }}</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    @include('pages.partials._header')
</div>
{{-- <div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light menu-2">
                <nav class="menu-2">
                    <ul classs="menu-ul-2">
                    <li class="menu-ul-parent"><a href="#">Home</a></li>
                    @foreach($categories as $category)
                        @if($category->childrens->count() > 0 )
                <li class="menu-ul-parent"><a href="#">{{ $category->name }}</a><span class="dropBottom"></span>
                    <ul>
            @include('pages.depends.tree_category', ['categories' => $category->childrens])
                    </ul>
                </li>
                        @else
                             <li class="menu-ul-parent"><a href="about.html">{{ $category->name }}</a></li>
                        @endif
                    @endforeach
                    </ul>
                </nav>
        </nav>
    </div>
</div> --}}
@csrf

{{-- <select name="language" onchange="location = this.value;">
    <option>---</potion>
     <option value="{!! route('user.change-language', ['en']) !!}">English</option>
     <option value="{!! route('user.change-language', ['vn']) !!}">VietNam</option>
</select> --}}

<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="#"><img src="images/logo.png" alt="img" class="mobile_logo_width"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">{{ __('language.home') }} <span class="sr-only">(current)</span></a>
                    </li>
                    @foreach($catsHome as $category)
                        @if($category->childrens->count() > 0 )
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}" id="dropdownMenuButton3" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">{{ $category->name }}<span class="sr-only">(current)</span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                                    @foreach($category->childrens as $sub_category)
                                    <a class="dropdown-item" href="{{ route('home.posts', ['id' => $sub_category->id, 'slug' => str_slug($sub_category->name)]) }}">{{ $sub_category->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}">{{ $category->name }} <span class="sr-only">(current)</span></a>
                    </li>
                        @endif
                    @endforeach
                    
                    @if(!Auth::user())
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('login') }}">
                            <!-- <i class="fa fa-user"></i> -->{{ trans('language.login') }} <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item pull-right">
                        <a class="nav-link" href="{{ route('register') }}">{{ trans('language.register') }}<!-- <i class="fa fa-user-plus"></i> -->  <span class="sr-only">(current)</span></a>
                    </li>
                    @else
                       <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton3" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="sr-only">(current)</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                            @if (auth()->user()->isAdmin())
                            <a class="dropdown-item" href="/admin"><i class="fa fa-home"></i>{{ __('language.manager') }}</a>
                            @else
                            @endif
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile"><i class="fa fa-user"></i>{{ __('language.profile') }}</a>
                            <a class="dropdown-item" href="{{ route('storages.posts.index') }}">
                              <i class="fa fa-archive"></i>{{ __('language.save') }}</a>
                            <a class="dropdown-item" href="{{ route('draft.posts.index') }}">
                               <i class="fa fa-window-restore"></i>{{ __('language.draft') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                               <i class="fa fa-sign-out"></i>{{ __('language.logout') }}</a>
                        </div>
                        </li>
                    @endif

                </ul>
            </div>
        </nav>
    </div>
</div>

    @yield('main')

<div class="container-fluid fh5co_footer_bg pb-3">
    <div class="container animate-box">
        <div class="row">
            <div class="col-12 spdp_right py-5"><img src="{{ asset('client/images/white_logo.png') }}" alt="img" class="footer_logo"/></div>
            <div class="clearfix"></div>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="footer_main_title py-3"> About</div>
                <div class="footer_sub_about pb-3"> Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                </div>
                <div class="footer_mediya_icon">
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer" href="https://instagram.com">
                        <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                    </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer" href="https://google.com">
                        <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                    </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer" href="https://twitter.com">
                        <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                    </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer" href="https://facebook.com">
                        <div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div>
                    </a></div>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                <div class="footer_main_title py-3"> Category</div>
                <ul class="footer_menu">
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Business</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Entertainment</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Environment</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Health</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Life style</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Politics</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Technology</a></li>
                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; World</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-5 col-lg-3 position_footer_relative">
                <div class="footer_main_title py-3"> Most Viewed Posts</div>
                <div class="footer_makes_sub_font"> Dec 31, 2016</div>
                <a href="#" class="footer_post pb-4"> Success is not a good teacher failure makes you humble </a>
                <div class="footer_makes_sub_font"> Dec 31, 2016</div>
                <a href="#" class="footer_post pb-4"> Success is not a good teacher failure makes you humble </a>
                <div class="footer_makes_sub_font"> Dec 31, 2016</div>
                <a href="#" class="footer_post pb-4"> Success is not a good teacher failure makes you humble </a>
                <div class="footer_position_absolute"><img src="{{ asset('client/images/footer_sub_tipik.png') }}" alt="img" class="width_footer_sub_img"/></div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 ">
                <div class="footer_main_title py-3"> Last Modified Posts</div>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/allef-vinicius-108153.jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/32-450x260.jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/download (1).jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/science-578x362.jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/vil-son-35490.jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/zack-minor-15104.jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/download.jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/download (2).jpg') }}" alt="img"/></a>
                <a href="#" class="footer_img_post_6"><img src="{{ asset('client/images/ryan-moreno-98837.jpg') }}" alt="img"/></a>
            </div>
        </div>
        <div class="row justify-content-center pt-2 pb-4">
            <div class="col-12 col-md-8 col-lg-7 ">
                <div class="input-group">
                    <span class="input-group-addon fh5co_footer_text_box" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control fh5co_footer_text_box" placeholder="Enter your email..." aria-describedby="basic-addon1">
                    <a href="#" class="input-group-addon fh5co_footer_subcribe" id="basic-addon12"> <i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Subscribe</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid fh5co_footer_right_reserved">
    <div class="container">
        <div class="row  ">
            <div class="col-12 col-md-6 py-4 Reserved"> © Copyright 2018 by <a href="https://freehtml5.co" title="Free HTML5 Bootstrap templates">Võ Tuấn</a>. </div>
            <div class="col-12 col-md-6 spdp_right py-4">
                <a href="#" class="footer_last_part_menu">Home</a>
                <a href="Contact_us.html" class="footer_last_part_menu">About</a>
                <a href="Contact_us.html" class="footer_last_part_menu">Contact</a>
                <a href="blog.html" class="footer_last_part_menu">Latest News</a></div>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>
<!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<!-- Waypoints -->
<script src="{{ asset('client/js/jquery.waypoints.min.js') }}"></script>
<!-- Main -->
<script src="{{ asset('client/js/main.js') }}"></script>

<script>
 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
 <script type="text/javascript">
        $('.select2-multi').select2();
 </script>

<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

@include('pages.language_js')
@include('partials._alert')

@routes
    <script src="{{ mix('js/show_image.js') }}"></script>
    <script src="{{ mix('js/edit_profile.js') }}"></script>


 @yield('javascript')
</body>
</html>
<script>
</script>