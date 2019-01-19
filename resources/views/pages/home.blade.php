@extends('pages.index')

@section('main')
<div class="container-fluid paddding mb-5">
    <div class="row mx-0">
        <div class="col-md-6 col-12 paddding animate-box" data-animate-effect="fadeIn">
            <div class="fh5co_suceefh5co_height">
                {{-- use image local --}}
                {{-- <img src="{{ asset(Config::get('social.image_post').'/'.$new->image) }}" alt="img"/> --}}
                {{-- use image cloudder --}}
                <img src="{{ $new->image }}" alt="img"/>
                <div class="fh5co_suceefh5co_height_position_absolute"></div>
                <div class="fh5co_suceefh5co_height_position_absolute_font">
                    <div class="">
                        <a href="#" class="color_fff"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $new->created_at }}
                        </a>
                    </div>
                    <br>
                    <div class="">
                        <a href="{{ route('home.single', ['slug' => str_slug($new->slug)]) }}" class="fh5co_good_font" title="{{ $new->title }}"> {!! substr(strip_tags($new->title), 0, 100) !!}{{ strlen(strip_tags($new->title))>70 ? "..." : ""}} </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                @foreach($newList as $list)
                <div class="col-md-6 col-6 paddding animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co_suceefh5co_height_2">
                        <img src="{{ $list->image }}" alt="img"/>
                        <div class="fh5co_suceefh5co_height_position_absolute"></div>
                        <div class="fh5co_suceefh5co_height_position_absolute_font_2">
                            <div class=""><a href="#" class="color_fff"> <i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $list->created_at }}
                            </a></div>
                            <div class=""><a href="{{ route('home.single', ['slug' => str_slug($list->slug)]) }}" class="fh5co_good_font_2" title="{{ $list->title }}">  {!! substr(strip_tags($list->title), 0, 70) !!}{{ strlen(strip_tags($list->title))>20 ? "..." : ""}} </a></div>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-3">
    <div class="container animate-box" data-animate-effect="fadeIn">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4"><a class="cate-parent">Tin mới</a></div>

        </div>
        <div class="owl-carousel owl-theme js" id="slider1">
            @foreach($newList as $list)
            <div class="item px-2">
                <div class="fh5co_latest_trading_img_position_relative">
                    <div class="fh5co_latest_trading_img">
                        <img src="{{ $list->image }}" alt="" class="fh5co_img_special_relative"/>
                    </div>
                    <div class="fh5co_latest_trading_img_position_absolute"></div>
                    <div class="fh5co_latest_trading_img_position_absolute_1">
                        <a href="{{ route('home.single', ['slug' => str_slug($list->slug)]) }}" class="text-white" title="{{ $list->title }}"> {!! substr(strip_tags($list->title), 0, 70) !!}{{ strlen(strip_tags($list->title))>20 ? "..." : ""}} </a>
                        <div class="fh5co_latest_trading_date_and_name_color">{{ $list->created_at }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('pages.partials.show_category')

<div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4"><a class="cate-parent">Tin mới</a></div>
                </div>
            @foreach($newList as $post)
                <div class="row pb-4">
                    <div class="col-md-5">
                        <div class="fh5co_hover_news_img">
                            <div class="fh5co_news_img"><img src="{{ $post->image }}" alt="img"/></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="col-md-7 animate-box">
                        <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" class="fh5co_magna py-2" title="{{ $post->title }}"> {!! substr(strip_tags($post->title), 0, 50) !!}{{ strlen(strip_tags($post->title))>50 ? "..." : ""}} </a> <a href="" class="fh5co_mini_time py-3"> {{ $post->user->name }} - {{  Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}
                       {{--  April 18,2016 --}} </a>
                        <div class="fh5co_consectetur"> {!! substr(strip_tags($post->body), 0, 70) !!}{{ strlen(strip_tags($post->body))>70 ? "..." : ""}}
                        </div>
                    </div>
                </div>
            @endforeach
                
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
                    <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4"><a class="cate-parent">Tin nóng</a></div>
                </div>
                @foreach($newsHot as $post)
                <div class="row pb-3">
                    <div class="col-5 align-self-center">
                        <img src="{{ $post->image }}" alt="img" class="fh5co_most_trading"/>
                    </div>
                    <div class="col-7 paddding">
                        <div class="most_fh5co_treding_font"><a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" class="fh5co_magna py-2" title="{{ $post->title }}"> {!! substr(strip_tags($post->title), 0, 20) !!}{{ strlen(strip_tags($post->title))>20 ? "..." : ""}} </a> </div>
                        <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>    
@endsection

@section('javascript')
    @include('pages.search_js')
@endsection