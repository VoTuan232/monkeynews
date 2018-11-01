@extends('pages.index')
@section('title', trans('translate.create_topic'))

@section('stylesheet')
    <link href="{{ asset('css/style_home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="form-group quiz">
        <div class="form-group">
            <h3 id="title-quiz">{!! trans('translate.create_topic') !!} </h3>
                <div class="form-body">
                    <div class="form-group">
                        {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label']) !!}
                        {{-- <div class="col-md-12">
                            {!! Form::select('category_id', $categories->pluck('name', 'id'), null, ['class' => 'browser-default custom-select']) !!}
                        </div> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('topic_id', 'Topic', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-12">
                            {!! Form::text('topic_name', null, ['class' => 'form-control input-circle', 'placeholder' => 'Enter name of topic']) !!}
                          {{--   @if($errors->has('topic_name'))
                                <span class="help-block" style="color: red;">
                                    <strong>{{ $errors->first('topic_name') }}</strong>
                                </span>
                            @endif --}}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('number-quest', 'Number Question', ['class' => 'col-md-3 control-label']) !!}
                        <div class="row ml-1">
                            <div class="col-md-3" style="min-width: 200px;">
                                {!! Form::number('number-quest', null, ['class' => 'browser-default custom-select']) !!}
                            </div>
                            <div class="col-md-9 pt-2">
                                <span class="text-success add-quest"><i class="fas fa-plus-circle"></i></span>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['method' => 'POST', 'route' => 'pages.index', 'class' => 'form-horizontal create']) !!}
                        <div class="form-body question-form">
                                 
                            {{-- <div class="form-group">
                                {!! Form::label('content', 'Question', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-12">
                                    {!! Form::textarea('content', old('content'), ['class' => 'editor']) !!}
                                    @if($errors->has('content'))
                                        <span class="help-block" style="color: red;">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ml-3">
                                <input type="checkbox" name="correct_ans[]" value="0">
                                <label>Answer A:</label>
                                <input type="text" name="answer[]" class="form-control" value="{!! old('answer[0]') !!}">
                            </div>
                            <div class="form-group ml-3">
                                 <input type="checkbox" name="correct_ans[]" value="1">
                                 <label>Answer B:</label>
                                <input type="text" name="answer[]" class="form-control" value="{!! old('answer[1]') !!}">
                            </div>
                            <div class="form-group ml-3">
                                 <input type="checkbox" name="correct_ans[]" value="2">
                                 <label>Answer C:</label>
                                <input type="text" name="answer[]" class="form-control" value="{!! old('answer[2]') !!}">
                            </div>
                            <div class="form-group ml-3">
                                <input type="checkbox" name="correct_ans[]" value="3">
                                <label>Answer D:</label>
                                <input type="text" name="answer[]" class="form-control" value="{!! old('answer[3]') !!}">
                            </div>
                            <div class="form-group ml-3">
                                {!! Form::label('explain', 'Explain') !!}
                                <div class="col-md-12">
                                    {!! Form::textarea('explain', old('explain'), ['class' => 'editor']) !!}
                                </div>
                            </div> --}}
                        </div>
                    {!! Form::close() !!}

                </div>
                <div class="form-actions pl-2">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
                            <a href="" class="btn btn-light">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('javascript')
    @include('test.new')
@endsection
