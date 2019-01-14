<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>

<div class="modal fade" id="createPost" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="modal-title">Add Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            @include('partials._message')
            
            {!! Form::open(array('route' => 'posts.store', 'files' => true, 'id'=> "frm-insert")) !!}
                <div class="modal-body">
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('title',"Title") }}
                            {{ Form::text('title',null,array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('slug',"Slug") }}
                            <span class="btn btn-info btn-sm" id="button_auto_slug"><i class="fa fa-info"></i>{{ __('language.auto') }}</span>
                            {{ Form::text('slug',null,array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('body',"Post Body") }}
                            {{ Form::textarea('body',null,array('class'=>'form-control', 'name' => 'body')) }}
                        </div>
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
                    <br>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('category', 'Category:') }}
                            <span class="btn btn-info btn-sm" data-toggle="modal" data-target="#showTreeCategory"><i class="fa fa-eye"></i>Chọn chủ đề</span>

                            <span class="btn btn-info btn-sm" id="clear-category"><i class="fa fa-eraser"></i>Xóa</span>
                            <br><br>
                            {{ Form::text('category', null, ['class' => 'form-control', 'readonly' => 'true', 'placeholder' => 'Categrory...']) }}
                        </div>
                    </div>

                    <div class="col-3-md">
                        <div class="form-group">
                           {{ Form::label('tags', 'Tags:') }}
                           {{ Form::select('tags[]',  $tags->pluck('name', 'id') , null, ['class' => 'form-control select2-multi', 'multiple', 'name'=>'tags[]']) }}  
                    </div>
                    </div>
                    
                        @can('post.publish')
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('published', "Published")}}
                            {{ Form::select('published', ['' => '--------------------', '0' => 'No published', '1' => 'Published'], null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                        @endcan
                </div>
                <div class="alert" id="message" style="display: none"></div>
                <div class="modal-footer">
                    {{ Form::submit('Create Post',array('class'=>'btn btn-success pull-left'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
