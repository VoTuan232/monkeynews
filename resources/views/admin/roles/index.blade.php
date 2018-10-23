@extends('admin.index')

@section('title', '|Roles Manager')

@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

								{{ Form::label('role', 'Lựa chọn Role:') }}
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<select type="text" name="role" id="role" class="form-control">
										<option value="">--------------------------------------</option>
										@foreach($roles as $key => $value)
										<option value="{{ $key }}">{{ $value }}</option>
										@endforeach
									</select>
								</div>
							</div>
							@can('role.update')
							<div class="col-md-4">
                            	{{ Form::text('permission',null,array('class'=>'form-control', 'placeholder' => 'Nhấn enter để thêm permission...', 'id' => 'permission')) }}
							</div>
							<div class="col-md-3">
            	{!! Form::open(array('route' => 'roles.update', 'id' => 'update-role')) !!}
            	{{-- @csrf --}}
								{{ Form::submit('Update Role',array('class'=>'btn btn-success pull-right'))}}
             					 <div class="alert" id="message" style="display: none"></div>
							</div>
							@endcan
						</div>
						<hr>
						<div class="row" id="show-permissions">
								@foreach($permissions as $key => $permission)
							<div class="col-md-3">
									<div>
										<input id="<?php echo $permission; ?>" class="checkbox-custom" name="roles[]" type="checkbox" value="<?php echo $permission; ?>">
										<label for="roles" class="checkbox-custom-label">{{ $permission }}</label>
									</div>
							</div>
								@endforeach
						</div>

				</div>
				{!! Form::close() !!}


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
@include('admin.roles.create_js')

@endsection