	<div class="container">
        @include('admin.posts.create')
        {{-- @include('admin.posts.edit') --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                <div class="alert" id="message_delete" style="display: none"></div>
                {{-- <div class="alert" id="message" style="display: none"></div> --}}

                    <div class="panel-heading">
                    @can('post.create')
                    <button class="btn btn-info" data-toggle="modal" data-target="#createPost">+{{ trans('language.Create new post') }}
                    </button>
                    @endcan    
                    <button class="btn btn-info pull-right " id="read-data">Hiển thị danh sách bài viết</button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Body</th>
                                    <th>published</th>
                                    <th>image</th>
                                    <th>user</th>
                                    <th>vote</th>
                                    <th>view</th>       
                                    <th></th>       
                                </tr>
                            </thead>

                            <tbody id="post-info">
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>