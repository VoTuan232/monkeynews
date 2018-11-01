@extends('pages.index')

@section('title', '|Blog')

@section('stylesheet')
<link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
<link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">

@endsection


@section('content')

{{-- @include('admin.posts.create') --}}

<div class="container">
	{{-- <div class="row">
		<button class="btn btn-info" data-toggle="modal" data-target="#createPost"><i class="fas fa-plus-circle"></i>{{ trans('language.Create new post') }}
                </button>
    </div> --}}
    <br>
		@if($storagesPost->count() > 0)

		    <div class="row">
		        @foreach($storagesPost as $post)
			        <div class="col-md-4 row-post">
						<div class="post">
				        	<img src="{{ asset('/images/'.$post->image) }}" alt="Notebook" style="width:100%; height:100%;"/>
						  	<div class="content">
							    <h6 class="title"><a href="{{ route('home.single', [ 'category' => str_slug($post->category_name), 'slug' => str_slug($post->slug)]) }}">{{ substr(strip_tags($post->title),0,20) }}{{ strlen(strip_tags($post->title))>20 ? "..." : "" }}</a></h6>
		                        <h6>{{ $post->created_at }}</h6>
		                        <p>{!! substr(strip_tags($post->body), 0, 70) !!}{{ strlen(strip_tags($post->body))>70 ? "..." : ""}}</p>
							</div>
				     	</div>
			        </div>
		        @endforeach
		    </div>
		@else
			Không có bài post nào được lưu
		@endif
    <div class="row">
         <small>
            <span class="btn-group">
                @foreach($tagHomes as $tag)
                    <button class="btn btn-mini">{{ $tag->name }}</button>
                @endforeach
            </span>
        </small>
    </div>
    <br>
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
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
 <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@endsection

