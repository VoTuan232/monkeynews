@extends('pages.index')

@section('title', '| '.$category->name)

@section('stylesheet')
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container">
	<div class="row">

        @if(!is_null($category->parent))
            @include('pages._parentCategory', [ 'category_parent' => $category->parent ])
        @endif
        <h1 class="category"><a href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}" >{{ $category->name }}</a></h1>
        <p class="sub_cat">
                @if($category->childrens->count() > 0 )
                <i class="fas fa-angle-double-right finger"></i>
            @foreach($category->childrens as $sub_cat)
                <a  class="sub-cat-posts-base-cat" href="{{ route('home.posts', ['id' => $sub_cat->id, 'slug' => str_slug($sub_cat->name)]) }}" class="category">{{ $sub_cat->name }}</a>
            @endforeach
                @else
                @endif
        </p>
    </div>
    @include('pages.tag')
    <br>
    <div class="row">
        @foreach($posts as $post)
	        <div class="col-md-4 row-post">
				<div class="post">
		        	<img src="{{ asset('/images/'.$post->image) }}" alt="Notebook" style="width:100%; height:100%;"/>
				  	<div class="content">
					    <h6 class="title"><a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}">{{ substr(strip_tags($post->title),0,20) }}{{ strlen(strip_tags($post->title))>20 ? "..." : "" }}</a></h6>
                        <h6>{{ $post->created_at }}</h6>
                        <p>{!! substr(strip_tags($post->body), 0, 70) !!}{{ strlen(strip_tags($post->body))>70 ? "..." : ""}}</p>
					</div>
		     	</div>
	        </div>
        @endforeach
    </div>
   {{--  <div class="row">
         <div class="text-center">
                {!! $posts->links(); !!}
        </div>
    </div> --}}
    {{--  <div class="row">
         <div class="text-center">
                {!! paginateCollection($posts, 6) !!}
        </div>
    </div> --}}
    @include('pages.tag')
    {{-- <div class="row">
         <small>
            <span class="btn-group">
                @foreach($tagHomes as $tag)
                    <button class="btn btn-mini">{{ $tag->name }}</button>
                @endforeach
            </span>
        </small>
    </div> --}}
    <br>
</div>
@endsection