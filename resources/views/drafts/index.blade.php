@extends('pages.index')

@section('title', '|Draft')

@section('stylesheet')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
<link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">

@endsection


@section('content')

@include('admin.posts.create')
@include('admin.categories.tree')

<div class="container">
	<div class="row">
		<button class="btn btn-info" data-toggle="modal" data-target="#createPost"><i class="fas fa-plus-circle"></i>{{ trans('language.Create new post') }}
                </button>
    </div>
    <br>
	<div class="row">
		<table id="example1" class="table table-bordered table-striped">
	        <thead>
	        <tr>
	            <th>ID</th>
	            <th>Title</th>
	            <th>Slug</th>
	            <th>Body</th>
	            <th></th>       
	            <th>Send request</th>       
	        </tr>
	        </thead>
	        <tbody id="post-info">
	        	@foreach($posts as $post)
					<tr id="{{ $post->id }}">
					    <td>{{ $post->id }}</td>
					    <td>{{ $post->title }}</td>
					    <td>{{ $post->slug }}</td>
					    <td>{{ substr(strip_tags($post->body),0,50) }}{{ strlen(strip_tags($post->body))>50 ? "..." : "" }}</td>
					    <td>
					    	@if(!is_null($post->request))
					        <a href="{{ route('draft.posts.edit', $post->id) }}" class="btn btn-info btn-sm" id="view" data-id="{{$post->id}}">View</a>
					        @endif
					        {{-- @if(!is_null($post->request) && $post->request == false)
					        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm" id="edit" data-id="{{$post->id}}">Edit</a>
					        @endif --}}
					        <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$post->id}}">Delete</a>
					    </td>
					    <td>
					    	@if(is_null($post->request))
					    	<a class="btn btn-danger btn-sm" id="view" data-id="{{$post->id}}">Request closed by admin</a>
					    	@elseif($post->request == false)
					    	{!! Form::open(['route' => ['draft.posts.store', $post->id], 'method' => 'POST']) !!}
                            	{{ Form::submit('Send',['class' => 'btn btn-info btn-sm']) }}
                            {!! Form::close() !!}
					    	{{-- <a href="{{ route('draft.posts.store',['id' => $post->id]) }}" class="btn btn-info btn-sm" id="view" data-id="{{$post->id}}">Send</a> --}}
					    	@elseif ($post->request == true)
						    	@if(!is_null($post->comment))
						    	<a  class="btn btn-warning btn-sm">Commented...</a>
						    	@endif
					    	<a  class="btn btn-info btn-sm">Waiting for accept...</a>
					    	{!! Form::open(['route' => ['draft.posts.destroy', $post->id], 'method' => 'POST']) !!}
                            	{{ Form::submit('Close Request',['class' => 'btn btn-danger btn-sm']) }}
                            {!! Form::close() !!}
					    	{{-- <a href="{{ route('draft.posts.destroy',['id' => $post->id]) }}" class="btn btn-danger btn-sm" id="view" data-id="{{$post->id}}">Close request</a> --}}
					    	
					    	@endif
					    </td>
					</tr>
				@endforeach
	        </tbody>
      </table>
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
 @include('drafts.create_js')
@endsection

