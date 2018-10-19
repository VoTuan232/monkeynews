<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>

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
                            {{ Form::textarea('body',null,array('class'=>'form-control', 'name' => 'body')) }}
                        </div>
                          {{--  {{ Form::hidden('body_hidden', null, array('class' => 'form-control', 'id' => 'body_hidden'))}} --}}
                             <script type="text/javascript"> CKEDITOR.replace( 'body', {
                                filebrowserBrowseUrl: '{{ asset('bower_components/ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('bower_components/ckfinder/ckfinder.html?type=Images') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('bower_components/ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                filebrowserImageUploadUrl: '{{ asset('bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                filebrowserFlashUploadUrl: '{{ asset('bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                            } );
                            </script>﻿
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
                            {{ Form::label('category', 'Category:') }}
                            <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#showTreeCategory"><i class="far fa-eye"></i>Chọn chủ đề</span>

                            <span class="btn btn-info btn-sm" id="clear-category"><i class="fas fa-eraser"></i>Xóa</span>
                            <br><br>
                            {{ Form::text('category', null, ['class' => 'form-control', 'readonly' => 'true', 'placeholder' => 'Categrory...']) }}
                           {{--  <select class="form-control" name="category_id">
                                @foreach($categoriesNoChildren  as $category)
                                    <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                @endforeach
                             
                            </select>  --}}
                           {{--  {{ Form::select('category_id[]', $categoriesNoChildren->pluck('name', 'id'), null, ['class' => 'form-control select2-multi' , 'multiple', 'name'=>'category_id[]']) }}  
 --}}
                            
                            {{--  {!! Form::select('sub_cat_id', $categoriesNoChildren->pluck('name', 'id'), null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) !!}             --}}    

                            {{-- {{ Form::select('sub_cat_id[]', array() , null, ['class' => 'form-control select2-multi', 'multiple', 'name'=>'sub_cat_id[]']) }}   --}}

                           {{--  <select class="form-control select2-multi" name="sub_cat_id[]" multiple="multiple" id="sub_cat_id">
                                
                            </select> --}}
                            {{-- {{ Form::label('category', "Category")}}
                            {{ Form::text('category',null,array('class'=>'form-control')) }} --}}
                         {{--    <label>Category</label>
                            <input type="text" name="text" class="form-control" /> --}}
                        </div>
                    </div>

                     <div class="col-3-md">
                        <div class="form-group">
                           {{ Form::label('tags', 'Tags:') }}
                           {{ Form::select('tags[]',  $tags->pluck('name', 'id') , null, ['class' => 'form-control select2-multi', 'multiple', 'name'=>'tags[]']) }}  
                            {{-- <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value='{{ $tag->id }}'>{{ $tag->name }}</option>
                                @endforeach

                            </select> --}}
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
