@extends('admin.index')

@section('title', '|Users')

@section('stylesheets')

    {!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}

@endsection

@section('main')

@include('admin.users.create')
@include('admin.users.edit')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __('language.manager_user') }}</h3>
              <div class="alert" id="message" style="display: none"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<div class="col-md-12">
            		@can('user.create')
            		<button class="btn btn-info" data-toggle="modal" data-target="#showAddUser"><i class="fas fa-plus-square"></i>{{ __('language.create_new_user') }}</button>
            		@endcan

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Posts</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="user-info">
							@foreach ($users as $user)
							<tr id="{{ $user->id }}">
								<th>{{ $user->id }}</th>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->roles->first()['name'] }}</td>
								<td>{{ $user->posts->count() }}</td>
								
								<td>
									<a href="#" class="btn btn-info btn-xs" id="view">View</a>
									@can('user.update')
									<a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{ $user->id }}">Edit</a>
									@endcan
									@can('user.delete')
									<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{ $user->id }}">Delete</a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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
@include('admin.users.create_js')
@include('admin.users.edit_js')

@endsection