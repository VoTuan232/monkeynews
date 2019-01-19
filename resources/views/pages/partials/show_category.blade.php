<?php $i=2; ?>
@foreach($categories as $category)
    @foreach ($data as $key => $value)
        @if($key == $category->id)
<div class="container-fluid pb-4 pt-5">
        <div class="container animate-box">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                <a class="cate-parent" href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}" class="category">{{ $category->name }}</a>
                @if($category->childrens->count() > 0 )
                @foreach($category->childrens as $sub_cat)
                    <a class="cate-childrens" href="{{ route('home.posts', ['id' => $sub_cat->id, 'slug' => str_slug($sub_cat->name)]) }}" class="category">{{ $sub_cat->name }}</a>
                @endforeach
                @else
                @endif
                </div>

            </div>
            {{-- @php echo $i; @endphp --}}
            <div class="owl-carousel owl-theme" id="slider<?php echo $i; ?>">
                @foreach($value as $post)
                    <div class="item px-2">
                        <div class="fh5co_hover_news_img">
                            <div class="fh5co_news_img"><img src="{{ $post->image }}" alt=""/></div>
                            <div>
                                <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" class="d-block fh5co_small_post_heading" title="{{ $post->title }}"><span class="">{!! substr(strip_tags($post->title), 0, 90) !!}{{ strlen(strip_tags($post->title))>90 ? "..." : ""}}</span></a>
                                <div class="c_g"><i class="fa fa-clock-o"></i> {{ $post->created_at }} </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>  
        @else
        @endif
    @endforeach
        <?php $i +=1; ?>
</div>
@endforeach

<div style="padding-left:40%;">
    {{ $categories->links() }}
</div>