@extends('pages.index')

@section('title', '| '.$category->name)


@section('stylesheet')
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_home_single.css') }}" rel="stylesheet">
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
            @foreach($category->childrens as $sub_cat)
            <a href="{{ route('home.posts', ['id' => $sub_cat->id, 'slug' => str_slug($sub_cat->name)]) }}" class="category">{{ $sub_cat->name }}</a>
            @endforeach
        </p>
    </div>

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
    <hr>
	<div class="row">
		<div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
        			<h2>{{ $post->title }}</h2>
        			<p>{{ $post->created_at }}</p>
                </div>
                <div class="col-md-4 pull-right">
                    <button type="button" class="btn btn-primary btn-sm" data-like="{{ isset($postAll) ? $postAll->like : "1"}}" data-id="{{ $post->id }}" title="Like" id="btn-like-post">
                        <i class="far fa-thumbs-up"></i>
                        <span class="badge" id="number-like-post">{{ $post->like }}</span>
                    </button>

                    <button type="button" class="btn btn-primary btn-sm" data-save="{{ isset($postAll) ? $postAll->like : "1"}}" data-id="{{ $post->id }}" title="Unlike"  id="btn-dislike-post">
                        <i class="far fa-thumbs-down"></i>
                        <span class="badge" id="number-dislike-post">{{ $post->dislike }}</span>
                    </button>

                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('home.single', $post->slug) }}&display=popup" target="_blink">
                        <button type="button"  class="btn btn-primary btn-sm" title="Share"><i class="fas fa-share-alt"></i></button>
                    </a>

                    @csrf
                    <button type="button" class="btn btn-primary btn-sm" data-save="{{ isset($postAll) ? $postAll->save : "0"}}" data-id="{{ $post->id }}" title="Save" id="btn-save-post">
                        <i class="fas fa-archive"></i>
                    </button>

                    <div class="alert" id="message-state-post" style="display: none"></div>
                </div>
            </div>
			<p>{!! $post->body !!}</p>
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
		<div class="col-md-4 related">
			<h2>Bài viết liên quan</h2>
			@foreach($postsRelated as $post)
	        	<div class="row-post">
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
	</div>
</div>
@endsection

@section('javascript')
<script>
 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
    @include('pages.js.custom_comment_js')
    {{-- @include('pages.js.create_comment_js') --}}
    @include('pages.js.save_post_js')
    @include('pages.js.like_post_js')
    @include('pages.js.share_js')
@endsection
