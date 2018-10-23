@extends('pages.index')

@section('title', '| Review Post')


@section('stylesheet')
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_home_single.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    @include('pages.tag')
    <hr>
	<div class="row">
		<div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
        			<h2>{{ $post->title }}</h2>
        			<p>{{ $post->created_at }}</p>
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
@endsection
