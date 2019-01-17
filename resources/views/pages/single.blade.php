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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    
    {{-- toastr --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <style>
        .img-tran {

        max-width: 100%;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        }
        .comment_option {
        margin-left: 60px;
        }

        .reply_comment_option {
            font-weight: bold;
            margin-left: 61px;
        }

        .frm-comment {
            margin-left: 60px;
        }

        .like {
            margin-right: 15px;
            cursor: pointer;
        }

        .icon-view-post {
            color : #a25757;
            margin-left : 5px;
            cursor: pointer;
        }

        .button {
            background-color: #ffffff;
            border: none;
            cursor: pointer;
        }
        div .body-post img {
            max-width: 100%;
        }
    </style>

</head>

<body class="single">

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
                    @foreach($catsHome as $cat)
                        @if($category->childrens->count() > 0 )
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"href="{{ route('home.posts', ['id' => $cat->id, 'slug' => str_slug($cat->name)]) }}" id="dropdownMenuButton3" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">{{ $cat->name }}<span class="sr-only">(current)</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                            @foreach($cat->childrens as $sub_category)
                            <a class="dropdown-item" href="{{ route('home.posts', ['id' => $sub_category->id, 'slug' => str_slug($sub_category->name)]) }}">{{ $sub_category->name }}</a>
                            @endforeach
                        </div>
                    </li>
                        @else
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('home.posts', ['id' => $cat->id, 'slug' => str_slug($cat->name)]) }}">{{ $cat->name }} <span class="sr-only">(current)</span></a>
                    </li>
                        @endif
                    @endforeach
                   
                    @if(!Auth::user())
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('login') }}">{{ trans('language.login') }}<span class="sr-only">(current)</span></a>
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
<div id="fh5co-title-box" style="background-image: url({{ asset('images/single_post/'.$imageName) }}); background-position: 50% 90.5px;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="page-title">
        {{-- <img src="{{ asset('images/'.$post->image) }}" alt="Free HTML5 by FreeHTMl5.co"> --}}
        <span><i class="fa fa-clock-o"></i> {{ $post->created_at }}</span>
        <h2>{{ $post->title }}</h2>
    </div>
</div>



<div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box body-post" data-animate-effect="fadeInLeft">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                        @if(!is_null($category->parent))
                            @include('pages._parentCategory', [ 'category_parent' => $category->parent ])
                        @endif
                        <a class="cate-parent" href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}" class="category">{{ $category->name }}</a>
                        @if($category->childrens->count() > 0 )
                        @foreach($category->childrens as $sub_cat)
                            <a class="cate-childrens" href="{{ route('home.posts', ['id' => $sub_cat->id, 'slug' => str_slug($sub_cat->name)]) }}" class="category">{{ $sub_cat->name }}</a>
                        @endforeach
                        @else
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                       
                        @can('post.trending')
                            @if ($post->trending == null) 
                                    <a href="{{ route('posts.trending', $post->id) }}" ><i class="fa fa-edit"></i>Create Trending</a>
                            
                            @else 
                                <a href="{{ route('posts.trending', $post->id) }}" ><i class="fa fa-edit"></i>Update Trending</a>
                                <p  class="fh5co_tagg" style="margin-top: -14px;">Trending đã được tạo</p>
                            @endif
                        @endcan
                        <h2>{{ $post->title }}</h2>
                        Thẻ liên quan bài viết:<br>

                        @if($post->trending != null)
                            <a href="{{ route('home.trending') }}" class="btn btn-primary btn-sm">Trending</a>
                        @endif
                        
                        @foreach($tagsPost as $tag)
                            <a href="{{ route('home.tags.posts', ['id' => $tag->id]) }}" class="fh5co_tagg">{{ $tag->name }}</a>
                        @endforeach
                        <br>
                        <span>{{ $post->created_at }}</span> &nbsp;&nbsp;
                        @can('post.update', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" ><i class="fa fa-edit"></i>Edit</a>
                        @endcan
                        @can('post.delete')
                             <a href="" data-id="{{$post->id}}"><i class="fa fa-trash"></i>Delete</a>
                        @endcan
                        <i class="fa fa-eye fa-1x icon-view-post" title="View"></i>{{ $post->view }}
                        <i class="fa fa-comments fa-1x icon-view-post" title="Comment"></i>{{ $post->comments->count() }}
                        {{-- <i class="fa fa-comments fa-1x icon-view-post" title="Comment"></i>{{ $comments->comment_number }} --}}
                        <br>
                        <input id="post-shortlink" value="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}">
                        <button class="button" id="copy-link-post" data-clipboard-target="#post-shortlink" title="Copy url"><i class="fa fa-link" ></i></button>

                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary btn-sm" data-like="{{ isset($postAll) ? $postAll->like : "1"}}" data-id="{{ $post->id }}" title="Like" id="btn-like-post">
                        <i class="fa fa-thumbs-up"></i>
                        <span class="badge" id="number-like-post">{{ $post->like }}</span>
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" data-save="{{ isset($postAll) ? $postAll->like : "1"}}" data-id="{{ $post->id }}" title="Unlike"  id="btn-dislike-post">
                            <i class="fa fa-thumbs-down"></i>
                            <span class="badge" id="number-dislike-post">{{ $post->dislike }}</span>
                        </button>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('home.single', $post->slug) }}&display=popup" target="_blink">
                            <button type="button"  class="btn btn-primary btn-sm" title="Share"><i class="fa fa-share-alt"></i></button>
                        </a>

                        @csrf
                        <button type="button" class="btn btn-primary btn-sm" data-save="{{ isset($postAll) ? $postAll->save : "0"}}" data-id="{{ $post->id }}" title="Save" id="btn-save-post">
                            <i class="fa fa-archive"></i>
                        </button>

                        <div class="alert" id="message-state-post" style="display: none"></div>
                        <br><br>                                    
                    </div>
                </div>
                {!! $post->body !!}

                <hr />
                    <form method="post" action="{{ route('comment.add') }}" id="frm-create-comment">
                    @csrf
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" placeholder="Thêm nhận xét công khai..." onkeyup="checkComment()" id="commment-body"/>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" id="send-comment" class="btn btn-warning" value="Nhận xét" disabled />
                            <div class="alert" id="message-comment" style="display: none"></div>
                        </div>
                    </form>
                <hr>
                @include('pages._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                <hr>

            </div>
            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4"><a class="cate-parent">Tags</a></div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">
                    @include('pages.tag')
                </div>
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4"><a class="cate-parent">Bài viết cùng chủ đề</a></div>
                </div>
                @foreach($postsRelated as $post)
                <div class="row pb-3">
                    <div class="col-5 align-self-center">
                        <img src="{{ asset('images/'.$post->image) }}" alt="img" class="fh5co_most_trading"/>
                    </div>
                    <div class="col-7 paddding">
                        <div class="most_fh5co_treding_font"> <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}">{!! substr(strip_tags($post->title), 0, 20) !!}{{ strlen(strip_tags($post->title))>20 ? "..." : ""}}</a></div>
                        <div class="most_fh5co_treding_font_123"> {{ $post->created_at }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('pages.partials.show_category')

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
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                        <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                    </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                        <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                    </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                        <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                    </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
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
            <div class="col-12 col-md-6 py-4 Reserved"> © Copyright 2018, All rights reserved. Design by <a href="https://freehtml5.co" title="Free HTML5 Bootstrap templates">FreeHTML5.co</a>. </div>
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
@routes
    <script src="{{ mix('js/like_post.js') }}"></script>
    <script src="{{ mix('js/save_post.js') }}"></script>
    <script src="{{ mix('js/edit_profile.js') }}"></script>
    <script src="{{ mix('js/show_image.js') }}"></script>
    <script src="{{ mix('js/delete_comment.js') }}"></script>
@include('pages.js.share_js')
@include('pages.js.custom_comment_js')

<script>
    (function(){
    new Clipboard('#copy-link-post');
})();
</script>




</body>
</html>