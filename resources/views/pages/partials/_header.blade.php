<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 fh5co_padding_menu">
            <img src="{{ asset('client/images/logo.png') }}" alt="img" class="fh5co_logo_width"/>
        </div>
        <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">

            {!! Form::open(array('route' => 'home.getSearch', 'method' => 'GET')) !!}
            @csrf
	        	<div class="text-center d-inline-block">
	        		<div class="fh5co_verticle_middle">
	            		<input type="" name="text" id="textSearch" placeholder="Search..." >
	        		</div>
	            </div>
                <?php $textSearch =  'a' ?>
	            <div class="text-center d-inline-block">
	                <a class="fh5co_display_table" id="btn-search" href="">
	                	<div class="fh5co_verticle_middle">
	                		{{-- <i class="fa fa-search"></i> --}}{{ Form::button('<i class="fa fa-search"></i>' ,array('class'=>'btn btn-success pull-left', 'type' => 'submit'))}}
	                	</div>
	                </a>
	            </div>

            {!! Form::close() !!}

            <div class="text-center d-inline-block">
                <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div></a>
            </div>
            <div class="text-center d-inline-block">
                <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div></a>
            </div>
            <div class="text-center d-inline-block">
                <a href="https://twitter.com/fh5co" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div></a>
            </div>
             <div class="text-center d-inline-block">
                <a href="https://fb.com/fh5co" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div></a>
            </div>
            <!--<div class="d-inline-block text-center"><img src="images/country.png" alt="img" class="fh5co_country_width"/></div>-->
            <div class="d-inline-block text-center dd_position_relative ">
                <select class="form-control fh5co_text_select_option">
                    <option>English </option>
                    <option>French </option>
                    <option>German </option>
                    <option>Spanish </option>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>               
               
