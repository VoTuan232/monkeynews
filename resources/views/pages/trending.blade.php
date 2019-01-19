@extends('pages.index')

@section('stylesheet')
    <link href="{{ asset('css/trending.css') }}" rel="stylesheet">
@endsection

@section('main')
   <div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                       <h2>Trending Post</h2> 
                    </div>
                    @foreach($trending_list as $post)
                    <div class="container">
                        <div class="col-md-10" style="float:right;">
                            <a href="#"><strong style="color:#5488c7;">{{ $post->user->name }}</strong></a> 
                            <span style="color:#ad9ba1;">Trending about 
                            {{ \Carbon\Carbon::parse($post->trending)->diffForHumans() }} </span>
                            <br>
                            <b><a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" style="color:#292b5a;" title="{{ $post->title }}">{{ $post->title }}</a></b>
                            <br>
                            <a href="{{ route('home.trending') }}" class="btn btn-primary btn-sm">Trending</a>
                            @if($post->tags->count() > 0)
                                @foreach($post->tags as $tag)
                                <a href="{{ route('home.tags.posts', ['id' => $tag->id]) }}" class="btn btn-primary btn-sm">{{ $tag->name }}</a>
                                @endforeach
                            @endif
                            <br>
                            <i class="fa fa-eye fa-1x icon-view-post" title="View" style="color:#9b9ba7;"></i>{{ $post->view }}
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <i class="fa fa-comments fa-1x icon-view-post" title="Comment" style="color:#9b9ba7;"></i>{{ $post->comments->count() }}
                        </div>
                        <div class="col-md-2" >
                            @if ($post->user->avatar != null)
                                <image src="{{ $post->user->avatar }}" class="img-tran"/>
                            @else
                                <image src="/images/users/anonymos.png" class="img-tran"/>
                            @endif
                        </div> 
                    </div>
                    <div class="clearfix"></div>
                    
                    <hr>

                    @endforeach
                    <div class="paginate_trending">
                        {{ $trending_list->links() }}
                    </div>

                </div>
            </div>

            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4"><a class="cate-parent">Tags</a></div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">
                    @include('pages.tag')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    @include('pages.search_js')
@endsection