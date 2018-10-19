<div class="modal fade" id="createPost" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            {{-- <div class="alert alert-danger" style="display:none"></div> --}}
            

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Post</h4>
            </div>

            @include('partials._message')

            {!! Form::open(array('route' => 'posts.store', 'files' => true, 'id'=> "frm-insert")) !!}
            {{-- <form action="{{ URL::to('posts/store') }}" method="POST" id="frm-insert"> --}}
                <div class="modal-body">
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('title',"Title") }}
                            {{ Form::text('title',null,array('class'=>'form-control')) }}
                           {{--  <label>Title</label>
                            <input type="text" name="name" class="form-control" /> --}}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('slug',"Slug") }}
                            {{-- <label>Slug</label> --}}
                            {{ Form::text('slug',null,array('class'=>'form-control')) }}

                            {{-- <input type="text" name="slug" class="form-control" /> --}}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('body',"Post Body") }}
                            {{ Form::textarea('body',null,array('class'=>'form-control')) }}
                            {{-- <label>Body</label>
                            <input type="text" name="name" class="form-control" /> --}}
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
                            <img src="" id="upload-image" width="300px" />
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('categories', 'Category:') }}
                           {{--  <select class="form-control" name="category_id">
                                @foreach($categoriesNoChildren  as $category)
                                    <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                @endforeach
                             
                            </select>  --}}
                            {{ Form::select('category_id[]', $categoriesNoChildren->pluck('name', 'id'), null, ['class' => 'form-control select2-multi' , 'multiple', 'name'=>'category_id[]']) }}  

                            
                            {{--  {!! Form::select('sub_cat_id', $categoriesNoChildren->pluck('name', 'id'), null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) !!}             --}}    

                            {{ Form::select('sub_cat_id[]', array() , null, ['class' => 'form-control select2-multi', 'multiple', 'name'=>'sub_cat_id[]']) }}  

                           {{--  <select class="form-control select2-multi" name="sub_cat_id[]" multiple="multiple" id="sub_cat_id">
                                
                            </select> --}}
                            {{-- {{ Form::label('category', "Category")}}
                            {{ Form::text('category',null,array('class'=>'form-control')) }} --}}
                         {{--    <label>Category</label>
                            <input type="text" name="text" class="form-control" /> --}}
                        </div>
                    </div>
                    
                        @can('post.publish')
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('published', "Published")}}
                            {{-- <label>Published</label> --}}
                            {{-- <select type="text" name="published" id="published" class="form-control">
                                <option value="">-</option>
                                <option value="0">No published</option>
                                <option value="1">Published</option>
                            </select> --}}
                            {{ Form::select('published', ['' => '--------------------', '0' => 'No published', '1' => 'Published'], null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                        @endcan
                </div>
                <div class="alert" id="message" style="display: none"></div>
                <div class="modal-footer">
                    {{ Form::submit('Create Post',array('class'=>'btn btn-success pull-left'))}}
                    {{-- <input type="submit" name="" value="Save" class="btn btn-success pull-left"> --}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
