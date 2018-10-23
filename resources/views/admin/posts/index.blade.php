@extends('admin.index')

@section('title', '| Posts')

@section('stylesheets')

    {!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
    {!! Html::style('bower_components/select2/dist/css/select2.min.css')!!}

@endsection

@section('main')
    @include('admin.posts.create')
    @include('admin.categories.tree')
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <div class="alert" id="message_delete" style="display: none"></div>
                @can('post.create')
                <button class="btn btn-info" data-toggle="modal" data-target="#createPost"><i class="fas fa-plus-circle"></i>{{ trans('language.Create new post') }}
                </button>
                @endcan    
                <button class="btn btn-info pull-right " id="read-data">Hiển thị danh sách bài viết</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        
        //load posts
        $('#read-data').on('click', function(){
            console.log('hihi')
            $.get("{{ URL::to('manager/posts/read-data') }}", function(data){
                $('#post-info').empty().html(data);

            })
        })
    </script>
    
    <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    
    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
    @include('admin.posts.create_js')
    @include('admin.posts.delete_js')
    @include('admin.posts.edit_js')

  

@endsection
