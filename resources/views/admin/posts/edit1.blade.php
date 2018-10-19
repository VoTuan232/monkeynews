@extends('admin.index')

@section('title', '|Edit Post')

@section('stylesheets')

    {!! Html::style('bower_components/select2/dist/css/select2.min.css')!!}

@endsection

@section('main')

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                
              <h3 class="box-title">Edit Post</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             {!! Form::model($post, ['route' => ['posts.update'], 'method' => 'POST', 'files' => true, 'id' => 'frm-update']) !!}
	                <div class="modal-body">
	                    <div class="col-3-md">
	                        <div class="form-group">
	                            {{ Form::label('title', 'Title')}}
	                            {{ Form::text('title', null, array('class' => 'form-control')) }}
	                            {{ Form::hidden('id', null, array('class' => 'form-control'))}}
	                            {{ Form::hidden('user_id', null, array('class' => 'form-control'))}}
	                        </div>
	                    </div>
	                    <div class="col-3-md">
	                        <div class="form-group">
	                            {{ Form::label('slug', 'Slug') }}
	                            {{ Form::text('slug', null, array('class' => 'form-control')) }}
	                        </div>
	                    </div>
	                    <div class="col-3-md">
	                        <div class="form-group">
	                            {{ Form::label('body', 'Body')}}
	                            {{ Form::textarea('body', null, array('class' => 'form-control'))}}
	                        </div>
	                    </div>
	                    <div class="col-3-md">
	                        <div class="form-group">
	                            {{ Form::label('image', 'Upload a Featured Image') }}
	                            {{ Form::file('image', ['class' => 'image']) }}
	                            {{-- <input type="text" name="name" class="form-control" /> --}}
	                        </div>
	                      {{--   <div class="form-conntrol">
	                            <img src="{{ asset('/images/'.$post->image) }}" id="upload-image" width="300px" />
	                        </div> --}}
	                        {{ HTML::image('images/'.$post->image, 'Image Post', array('id' => 'upload-image', 'width' => '300px')) }}
	                    </div>
	                    <div class="col-3-md">
	                        <div class="form-group">
	                            {{ Form::label('categories', 'Category:') }}
	                           {{ Form::select('categories[]', $categories, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }} 

	                            {{-- {{ Form::select('sub_cat_id[]', array() , null, ['class' => 'form-control select2-multi', 'multiple', 'name'=>'sub_cat_id[]']) }} --}}  
	                        </div>
	                    </div>
	                    @can('post.published')
	                    <div class="col-3-md">
	                        <div class="form-group">
	                            {{ Form::label('published', "Published")}}
	                            {{ Form::select('published', ['' => '--------------------', '0' => 'No published', '1' => 'Published'], null, ['class' => 'form-control']) }}
	                        </div>
	                    </div>
	                    @endcan
						<div class="col-3-md">
							<div class="form-group">
	                    		<div class="alert" id="message" style="display: none"></div>
							</div>
						</div>
	                   
	                </div>
	                {{-- <div class="modal-footer">
	                    {{ Form::submit('Save Change',array('class'=>'btn btn-success pull-left'))}}
                    <input type="submit" name="" value="Save" class="btn btn-success pull-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                </div> --}}
	                <div class="col-md-6 col-offset-4">
						<div class="well">
							<div class="row">
								<div class="col-sm-6">
									{!! Html::linkRoute('posts.index','Cancel',null,array('class'=>'btn btn-danger btn-block')) !!}	
								</div>
								<div class="col-sm-6">
									{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
								</div>
							</div>
						</div>
					</div>
	        {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
    <!-- /.content -->

@endsection

@section('javascript')
	<script>
	 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
	</script>
	
	{!! Html::script('bower_components/select2/dist/js/select2.min.js') !!}
	
	<script type="text/javascript">
        $('.select2-multi').select2();
    </script>

    @include('admin.posts.edit_js')
@endsection