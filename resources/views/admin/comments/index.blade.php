@extends('admin.index')

@section('title', '|Comments')

@section('stylesheets')

    {!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}

@endsection

@section('main')


<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Quản lí bình luận</h3>
              <div class="alert" id="message" style="display: none"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-12">
            		{{-- @can('user.create')
            		<button class="btn btn-info" data-toggle="modal" data-target="#showAddUser"><i class="fas fa-plus-square"></i>Thêm người dùng</button>
            		@endcan --}}

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Post</th>
								<th>Comments</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="comment-info">
							@foreach ($posts as $post)
							<tr id="{{ $post->post_id }}">
								<th>{{ $post->post_id }}</th>
								<td>{{ $post->slug }}</td>
								<td>{{ $post->comment_number }}</td>
								<td>
									<a href="{{ route('home.single', ['slug' => $post->slug]) }}" class="btn btn-info btn-xs" id="view">View</a>
									@can('user.update')
									<a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{ $post->post_id }}">Edit</a>
									@endcan
									@can('user.delete')
									<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{ $post->post_id }}">Delete</a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
                    </div>
                    	@include('admin.comments.pagination_comment')
						{{-- {{ $posts->appends(request()->query())->links() }} --}}
            	</div>

            	
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 </section>
@endsection

@section('javascript')
<script>
	  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>

@endsection