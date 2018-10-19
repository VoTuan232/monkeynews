<div class="modal fade" id="updatePost" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Post</h4>
            </div>
            {!! Form::open(array('route' => 'posts.update', 'method' => 'POST', 'files' => true, 'id' => 'frm-update')) !!}
            {{-- <form action="#" method="POST" id="frm-update"> --}}
                <div class="modal-body">
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('title', 'Title')}}
                            {{-- <label>Title</label> --}}
                            {{-- <input type="text" name="id" class="form-control" id="id" hidden /> --}}
                            {{ Form::text('title', null, array('class' => 'form-control')) }}
                            {{ Form::hidden('id', null, array('class' => 'form-control'))}}
                            {{-- <input type="text" name="title" class="form-control" id="title" /> --}}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{-- <label>Email</label> --}}
                            {{ Form::label('slug', 'Slug') }}
                            {{ Form::text('slug', null, array('class' => 'form-control')) }}
                            {{-- <input type="email" name="email" class="form-control" id="email"/> --}}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('body', 'Body')}}
                            {{ Form::text('body', null, array('class' => 'form-control'))}}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('image', 'Upload a Featured Image') }}
                            {{ Form::file('image', ['class' => 'image']) }}
                            {{-- <label>Image</label>
                            <input type="text" name="name" class="form-control" /> --}}
                        </div>
                         <div class="form-conntrol">
                            <img src="" id="upload-image-update" width="300px" />
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('categories', 'Category:') }}
                            {{ Form::select('category_id[]', $categoriesNoChildren->pluck('name', 'id'), null, ['class' => 'form-control select2-multi' , 'multiple', 'name'=>'category_id[]']) }}  
                            {{ Form::select('sub_cat_id[]', array() , null, ['class' => 'form-control select2-multi', 'multiple', 'name'=>'sub_cat_id[]']) }}  
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('published', "Published")}}
                            {{ Form::select('published', ['' => '--------------------', '0' => 'No published', '1' => 'Published'], null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="submit" name="" value="Update" class="btn btn-success pull-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
