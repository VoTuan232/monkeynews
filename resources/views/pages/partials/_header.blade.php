<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 fh5co_padding_menu">
            <img src="{{ asset('client/images/logo.png') }}" alt="img" class="fh5co_logo_width"/>
        </div>
        <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
            <div class="styled-select slate">
                 <select name="language" onchange="location = this.value;">
                     <option value="{!! route('user.change-language', ['en']) !!}" <?php if($language == 'en') echo 'selected'; ?> >English</option>
                     <option value="{!! route('user.change-language', ['vn']) !!}" <?php if($language == 'vn') echo 'selected'; ?> >VietNam</option>
                </select>
            </div>
            
            <div class="search" style="padding-right:5px;">
                {!! Form::open(array('route' => 'home.getSearch', 'method' => 'GET', 'class' => 'searchform')) !!}
                @csrf
                            <input type="" name="text" id="textSearch" placeholder="{{ __('language.search_news') }}" >
                                {{ Form::button('<i class="fa fa-search"></i>' ,array('class'=>'btn btn-success pull-left search', 'type' => 'submit')) }}
                {!! Form::close() !!}
            </div>
            <div class="clearfix"></div>


            <div class="text-center d-inline-block">
                <a class="fh5co_display_table" href="https://instagram.com"><div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div></a>
            </div>
            <div class="text-center d-inline-block">
                <a class="fh5co_display_table" href="https://google.com"><div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div></a>
            </div>
            <div class="text-center d-inline-block">
                <a href="https://twitter.com" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div></a>
            </div>
             <div class="text-center d-inline-block">
                <a href="https://fb.com" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div></a>
            </div>
           

            <!--<div class="d-inline-block text-center"><img src="images/country.png" alt="img" class="fh5co_country_width"/></div>-->
            <div class="d-inline-block text-center dd_position_relative ">
                {{-- <select name="locale" id="languageSwitcher">
                          <option value="vn" >Viet Nam</option>
                          <option value="en">English</option>
                </select> --}}
            {{--     <a href="{!! route('user.change-language', ['en']) !!}">English</a>
                <a href="{!! route('user.change-language', ['vn']) !!}">Vietnam</a> --}}

               {{--  <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{URL::asset('')}}language/vn">Tiếng Việt</a></li>
                        <li><a href="{{URL::asset('')}}language/en">Tiếng Anh</a></li>
                        <li><a href="{{URL::asset('')}}language/ja">Tiếng Nhật</a></li>
                </ul> --}}
                {{-- <form action="{{ route('switchLang') }}" class="form-lang" method="post">
                    <select name="locale" onchange='this.form.submit();'>
                          <option value="en">English</option>
                          <option value="vn" selected >Viet Nam</option>
                    </select>
                      {{ csrf_field() }}
                </form> --}}

                {{-- <a href="{{ route('switchLang') }}">English</a> --}}

               {{--  <select class="form-control fh5co_text_select_option">
                    <option>
                        <a href="{!! route('user.change-language', ['en']) !!}">English</a>
                    </option>
                    <option>
                        <a href="{!! route('user.change-language', ['vn']) !!}">Vietnam</a>
                    </option>
                </select> --}}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>               
               
