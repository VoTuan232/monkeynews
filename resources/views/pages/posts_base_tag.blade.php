@extends('pages.index')

@section('title', '| '.$tag->name)

@section('stylesheet')
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
            <h2>{{ $tag->name }}</h2>
    </div>
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
  
    @include('pages.tag')
    
    <br>
</div>
@endsection