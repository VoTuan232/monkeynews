@extends('admin.index')

@section('title', '|Categories')

@section('stylesheets')

    {!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
    {!! Html::style('bower_components/select2/dist/css/select2.min.css')!!}
    {!! Html::style('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css')!!}

@endsection

@section('main')

@include('admin.categories.edit')
@include('admin.categories.tree')
@include('admin.categories.delete')


<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Quản lí chủ đề</h3>
              <div class="alert" id="message" style="display: none"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-6">
            		<button class="btn btn-info" data-toggle="modal" data-target="#showTreeCategory"><i class="far fa-eye"></i> Hiển thị chủ đề</button>

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Paren Category</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="category-info">
							@foreach ($categories as $category)
							<tr id="{{ $category->id }}">
								<th>{{ $category->id }}</th>
								<td>{{ $category->name }}</td>
								<td>
								@if(is_null($category->parent))
									null
								@else
									{{ $category->parent->name }}
								@endif
								</td>
								<td>
									<a href="#" class="btn btn-info btn-xs" id="view">View</a>
									@can('category.update')
									<a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{ $category->id }}">Edit</a>
									@endcan
									@can('category.delete')
									<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{ $category->id }}">Delete</a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
            	</div>

				@can('category.create')
            	<div class="col-md-4 pull-right">
            		<div class="well">
						{!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'id' => 'frm-create']) !!}
							<h2>Chủ đề mới</h2>
							{{-- {{ Form::label('name', 'Name:') }} --}}
							{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'category_id', 'placeholder' => 'Nhập tên chủ để...']) }}
							{{-- {{ Form::text('parent_name', null, ['class' => 'form-control input-lg', 'placeholder' => 'enter', 'id' => 'name']) }}
    							<div id="categoryList"></div> --}}
    							<br>
    							<span class="btn btn-info" data-toggle="modal" data-target="#showTreeCategory"><i class="far fa-eye"></i> Chọn chủ đề cha</span>
    							<span class="btn btn-info btn-sm" id="clear-category">Xóa</span>
    							<br>
    							{{ Form::text('parent_id', null, ['class' => 'form-control', 'readonly' => 'true']) }}
    							{{-- <div id="categoryList"></div> --}}
							{{ Form::submit('Tạo', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
						
						{!! Form::close() !!}

								{{-- <input type="text" name="" id="name" class="form-control input-lg" placeholder="Enter Country Name" /> --}}
            		</div>
            	</div>
            	@endcan

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
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>

@include('admin.categories.create_js')
@include('admin.categories.edit_js')
@include('admin.categories.delete_js')
{{-- @include('admin.categories.search_js') --}}

@endsection