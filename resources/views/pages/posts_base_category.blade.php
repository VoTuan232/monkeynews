@extends('pages.index')

{{-- @section('title', '| '.$category->name) --}}

@section('main')
<div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
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
	                        <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" class="fh5co_magna py-2" title="{{ $post->title }}"> {!! substr(strip_tags($post->title), 0, 50) !!}{{ strlen(strip_tags($post->title))>50 ? "..." : ""}} </a> <a href="#" class="fh5co_mini_time py-3">{{ $post->created_at }}</a>
	                        <div class="fh5co_consectetur"> {!! substr(strip_tags($post->body), 0, 200) !!}{{ strlen(strip_tags($post->body))>200 ? "..." : ""}}
	                        </div>
	                    </div>
	                </div>
                @endforeach
                    <div class="row mx-0">
                        <div class="col-12 text-center pb-4 pt-4">
                            @include('pages.pagination_base_category')
                        </div>
                    </div>
            </div>

           {{--  {{ $posts->paginate() }} --}}

            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4"><a class="cate-parent">Tags</a></div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">
                    @include('pages.tag')
                </div>
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4"><a class="cate-parent">Bài viết phổ biến liên quan</a></div>
                </div>
                @foreach($postsMostPopular as $post)
	                <div class="row pb-3">
	                    <div class="col-5 align-self-center">
	                        <img src="{{ $post->image }}" alt="img" class="fh5co_most_trading"/>
	                    </div>
	                    <div class="col-7 paddding">
	                        <div class="most_fh5co_treding_font">  <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" title="{{ $post->title }}">{!! substr(strip_tags($post->title), 0, 20) !!}{{ strlen(strip_tags($post->title))>20 ? "..." : ""}}</a></div>
	                        <div class="most_fh5co_treding_font_123"> {{ $post->created_at }}</div>
	                    </div>
	                </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="row mx-0">
            <div class="col-12 text-center pb-4 pt-4">
                <a href="#" class="btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
                <a href="#" class="btn_pagging">1</a>
                <a href="#" class="btn_pagging">2</a>
                <a href="#" class="btn_pagging">3</a>
                <a href="#" class="btn_pagging">...</a>
                <a href="#" class="btn_mange_pagging">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
             </div>
        </div> --}}
    </div>
</div>

@include('pages.partials.show_category')

@endsection