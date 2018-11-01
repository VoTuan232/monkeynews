@extends('pages.index')

@section('main')

	@if($storagesPost->count() > 0)
	<div class="container-fluid pt-3">
	    <div class="container animate-box" data-animate-effect="fadeIn">
	        <div>
	            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Bài viết được đánh dấu</div>
	        </div>
	        <div class="owl-carousel owl-theme js" id="slider1">
	            @foreach($storagesPost as $post)
	            <div class="item px-2">
	                <div class="fh5co_latest_trading_img_position_relative">
	                    <div class="fh5co_latest_trading_img"><img src="{{ asset('images/'.$post->image) }}" alt=""
	                                                           class="fh5co_img_special_relative"/></div>
	                    <div class="fh5co_latest_trading_img_position_absolute"></div>
	                    <div class="fh5co_latest_trading_img_position_absolute_1">
	                        <a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}" class="text-white"> {!! substr(strip_tags($post->title), 0, 20) !!}{{ strlen(strip_tags($post->title))>20 ? "..." : ""}} </a>
	                        <div class="fh5co_latest_trading_date_and_name_color"> Walter Johson - March 7,2017</div>
	                    </div>
	                </div>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</div>
	@else
		Không có bài post nào được lưu
	@endif
@endsection

