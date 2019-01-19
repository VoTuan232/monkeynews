@extends('pages.index')

{{-- @section('title', '| '.$category->name) --}}

@section('main')
<div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <div class="row">
                    <h4 class="">Tags: {{ $tag->name }}</h2>
                </div>
                @foreach($posts as $post)
                    <div class="row pb-4">
                        <div class="col-md-5">
                            <div class="fh5co_hover_news_img">
                                <div class="fh5co_news_img">
                                    <img src="{{ $post->image }}" alt=""/>
                                </div>
                                <div></div>
                            </div>
                        </div>
                        <div class="col-md-7 animate-box">
                            <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" class="fh5co_magna py-2" title="{{ $post->title }}"> {!! substr(strip_tags($post->title), 0, 50) !!}{{ strlen(strip_tags($post->title))>50 ? "..." : ""}} </a>
                            <a href="#" class="fh5co_mini_time py-3">{{ $post->created_at }}</a> 
                            <div class="fh5co_consectetur"> {!! substr(strip_tags($post->body), 0, 200) !!}{{ strlen(strip_tags($post->body))>200 ? "..." : ""}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tags</div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">
                    @include('pages.tag')
                </div>
            </div>
        </div>
        <div class="row mx-0">
             <div class="col-12 text-center pb-4 pt-4">
                @include('pages.pagination_base_tag')
            </div>
        </div>
    </div>
</div>

@include('pages.partials.show_category')
@endsection