@extends('admin.index')

@section('title', '|Tags')

@section('main')

@include('admin.tags.delete')
@include('admin.tags.edit')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Quản lí thẻ</h3>
              <div class="alert" id="message" style="display: none"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-6">
            		<h1>{{-- Tags --}}</h1>
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="tag-info">
							@foreach ($tags as $tag)
							<tr id="{{ $tag->id }}">
								<th>{{ $tag->id }}</th>
								<td><a href="#">{{ $tag->name }}</a></td>
								<td>
									<a href="#" class="btn btn-info btn-xs" id="view">View</a>
									@can('tag.update')
									<a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{ $tag->id }}">Edit</a>
									@endcan
									@can('tag.delete')
									<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{ $tag->id }}">Delete</a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
            	</div>
				@can('tag.create')
            	<div class="col-md-4 pull-right">
            		<div class="well">
						{!! Form::open(['route' => 'tags.store', 'method' => 'POST', 'id' => 'frm-create']) !!}
							<h2>Tạo thẻ mới</h2>
							{{-- {{ Form::label('name', 'Tên thẻ:') }} --}}
							{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nhập tên thẻ...']) }}
							<br>
							{{ Form::submit('Tạo', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
						
						{!! Form::close() !!}
					</div>
            	</div>
            	@endcan
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
	@include('admin.tags.create_js')
	@include('admin.tags.delete_js')
	@include('admin.tags.edit_js')
@endsection