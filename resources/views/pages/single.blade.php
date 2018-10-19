{{-- @php dd($category->parent->first()->name)@endphp --}} {{-- ngoai hang anh => the thao --}}
{{-- @php dd($category->parent->name)@endphp --}} {{-- ngoai hang anh => bong da --}}

@extends('pages.index')

@section('title', 'Name Post')


@section('stylesheet')
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_home_single.css') }}" rel="stylesheet">
    {{-- {!! HTML::style('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome.css') !!} --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"> --}}
    <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">


    
@endsection

@section('content')
<div class="container">
	<div class="row">
        {{-- @php dd($category->parent->name) @endphp --}}

        @if(!is_null($category->parent))
        {{-- @php dd($category->parent->first()->name) @endphp --}}
            @include('pages._parentCategory', [ 'category_parent' => $category->parent ])
        @endif
        <h1 class="category"><a href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}" >{{ $category->name }}</a></h1>
        <p class="sub_cat">
            @foreach($category->childrens as $sub_cat)
            <a href="{{ route('home.posts', ['id' => $sub_cat->id, 'slug' => str_slug($sub_cat->name)]) }}" class="category">{{ $sub_cat->name }}</a>
            @endforeach
        </p>
    </div>

	<div class="row">
         <small>
            <span class="btn-group">
                @foreach($tagHomes as $tag)
                    <button class="btn btn-mini">{{ $tag->name }}</button>
                @endforeach
            </span>
        </small>
    </div>
    <hr>
	<div class="row">
		<div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
        			<h2>{{ $post->title }}</h2>
        			<p>{{ $post->created_at }}</p>
                </div>
                <div class="col-md-4 pull-right">
                    <button type="button" class="btn btn-primary btn-sm" title="Like"><i class="far fa-thumbs-up"></i></button>
                    <button type="button" class="btn btn-primary btn-sm"  title="Unlike"><i class="far fa-thumbs-down"></i></button>
                    <button type="button" class="btn btn-primary btn-sm" title="Share"><i class="fas fa-share-alt"></i></button>
                    @csrf
                    <button type="button" class="btn btn-primary btn-sm" data-save="{{ Auth::user() ? $postAll->save : "0"}}" data-id="{{ $post->id }}" title="Save" id="btn-save-post"><i class="fas fa-archive"></i></button>

                    <div class="alert" id="message-state-post" style="display: none"></div>
                </div>
            </div>
			<p>{!! $post->body !!}</p>
			{{-- <p>{{ $post->body }}</p> --}}

			{{-- Comment --}}
			 <hr />
	            {{-- <h4>Nhận xét</h4> --}}
	           {{--  @foreach($post->comments as $comment)
	                <div class="display-comment">
	                    <strong>{{ $comment->user->name }}</strong>
	                    <p>{{ $comment->body }}</p>
	                </div>
	            @endforeach --}}
	            <form method="post" action="{{ route('comment.add') }}" id="frm-create-comment">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" placeholder="Thêm nhận xét công khai..." onkeyup="checkComment()" id="commment-body"/>
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" id="send-comment" class="btn btn-warning" value="Nhận xét" disabled />
                    </div>
                </form>
            <hr>
	        @include('pages._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
            <hr>
            {{-- EndComment --}}


		</div>
		<div class="col-md-4 related">
			<h2>Bài viết liên quan</h2>
			@foreach($postsRelated as $post)
	        	<div class="row-post">
					<div class="post">
			        	<img src="{{ asset('/images/'.$post->image) }}" alt="Notebook" style="width:100%; height:100%;"/>
					  	<div class="content">
						    <h6 class="title"><a href="{{ route('home.single', [ 'category' => str_slug($category->name), 'slug' => str_slug($post->slug)]) }}">{{ substr(strip_tags($post->title),0,20) }}{{ strlen(strip_tags($post->title))>20 ? "..." : "" }}</a></h6>
	                        <h6>{{ $post->created_at }}</h6>
                        	<p>{!! substr(strip_tags($post->body), 0, 70) !!}{{ strlen(strip_tags($post->body))>70 ? "..." : ""}}</p>

						    {{-- <p>{{ strlen(strip_tags($post->body))>70 ? substr(strip_tags($post->body),0,70)."..."  :  $post->body }}</p> --}}

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
    {{-- @include('pages.js.create_comment_js') --}}
    @include('pages.js.custom_comment_js')
    @include('pages.js.save_post_js')
@endsection
