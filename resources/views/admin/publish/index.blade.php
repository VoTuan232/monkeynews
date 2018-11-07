u@extends('admin.index')

@section('title', '| Posts')

@section('stylesheets')

    {!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}

@endsection

@section('main')
   
   @can('post.publish') 
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h2>Quản lí đăng bài</h2>
                <div class="alert" id="message_delete" style="display: none"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             @if($posts->count() > 0 )
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Body</th>
                    <th>image</th>
                    <th>user</th>
                    <th></th>       
                </tr>
                </thead>
                <tbody id="post-info">
                @foreach($posts as $post)
                    <tr id="{{ $post->id }}">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ substr(strip_tags($post->body),0,50) }}{{ strlen(strip_tags($post->body))>50 ? "..." : "" }}</td>
                        <td><image src="{{ asset('images/'.$post->image) }}" alt="img" class="manager-post-image"/></td>
                        <td>{{ $post->username }}</td>
                        <td>
                            <a href="{{ route('draft.posts.single', $post->id) }}" class="btn btn-warning btn-xs" id="view" data-id="{{$post->id}}">View</a>
                            {!! Form::open(['route' => ['posts.draft.accept', $post->id], '  method' => 'POST']) !!}
                            {{ Form::submit('Publish',['class' => 'btn btn-info btn-xs']) }}
                            {!! Form::close() !!}
                            {{-- <a href="#" class="btn btn-info btn-xs" id="view" data-id="{{$post->id}}">publish</a> --}}
                            {!! Form::open(['route' => ['posts.draft.close', $post->id], '  method' => 'POST']) !!}
                            {{ Form::submit('Close',['class' => 'btn btn-danger btn-xs']) }}
                            {!! Form::close() !!}
                           {{--  <a href="#" class="btn btn-danger btn-xs" id="view" data-id="{{$post->id}}">close</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
              </table>
              @else
              <h4>Hiện tại không có yêu cầu nào...</h4>
              @endif
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
    @else
    <h1>Bạn không có quyền này!</h1>
    @endcan
@endsection

@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
