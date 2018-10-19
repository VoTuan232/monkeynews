@extends('admin.index')

@section('title', '|Roles Manager')

@section('stylesheets')

{!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}

@endsection

@section('main')



<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Quản lí quyền</h3>
					<div class="alert" id="message" style="display: none"></div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="col-md-12">
            {!! Form::open(array('route' => 'roles.update')) !!}

								{{ Form::label('role', 'Lựa chọn Role:') }}
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									{{-- {{ Form::select('role',  $roles->pluck('name', 'id') , null, ['class' => 'form-control', 'name'=>'role']) }}   --}}
									<select type="text" name="role" id="role" class="form-control">
										<option value="">--------------------------------------</option>
										@foreach($roles as $key => $value)
										<option value="{{ $key }}">{{ $value }}</option>
										@endforeach
									</select>
								</div>
							</div>
							@can('role.create')
							<div class="col-md-4">
                            	{{ Form::text('permission',null,array('class'=>'form-control', 'placeholder' => 'Thêm permission...')) }}
							</div>
							@endcan
							@can('role.update')
							<div class="col-md-3">
								{{ Form::submit('Update Role',array('class'=>'btn btn-success pull-right'))}}
							</div>
							@endcan
						</div>
						<hr>
						<div class="row">
								@foreach($permissions as $key => $permission)
							<div class="col-md-3">
									<div>
										<input id="<?php echo $permission; ?>" class="checkbox-custom" name="roles" type="checkbox" {{-- checked --}} value="<?php echo $permission; ?>">
										<label for="roles" class="checkbox-custom-label">{{ $permission }}</label>
									</div>
							</div>
								@endforeach

						</div>
				{!! Form::close() !!}
            		{{-- <button class="btn btn-info" data-toggle="modal" data-target="#showAddUser">+Add New User</button>

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
							<tr id="{{ $user->user_id }}">
								<th>{{ $user->user_id }}</th>
								<td>{{ $user->username }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->role_name }}</td>
								<td>{{ $user->post_number }}</td>
								
								<td>
									<a href="#" class="btn btn-info btn-xs" id="view">View</a>
									<a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{ $user->user_id }}">Edit</a>
									<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{ $user->user_id }}">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table> --}}
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

@include('admin.roles.role_js')

@endsection