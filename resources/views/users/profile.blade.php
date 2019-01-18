@if (Auth::user() != null)
<div class="modal fade" id="profile" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">{{ __('language.edit_user') }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            @include('partials._message')

            <div class="modal-body">
                <form method="post" id="update_profile" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                {{-- <div class="panel-heading">{{Auth::user()->name}}</div> --}}
                                <div class="panel-body">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="thumbnail">
                                        <h3 align="center">{{ucwords(Auth::user()->name)}}</h3>
                                        @if(Auth::user()->avatar == null)
                                            <img id="upload-image" src="/images/users/anonymos.png" width="120px" height="120px" class="img-circle" style="margin-left: 36%;"/>
                                        @else
                                            <img id="upload-image" src="{{ Auth::user()->avatar }}" width="120px" height="120px" class="img-circle" style="margin-left: 36%;"/>
                                        @endif
                                        <div class="caption">
                                            <p align="center">Việt Nam</p>
                                            {{-- <p align="center">  <a href="{{url('/')}}/changePhoto"  class="btn btn-primary" role="button">Change Image</a></p> --}}
                                            <label for="image">Choose profile</label>
                                            <input type="file" name="image" id="image" class="hidden" />
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">

                                            {{-- <div class="col-md-6">
                                                <div class="input-group">
                                                    <span  id="basic-addon1">City Name</span>
                                                    <input type="text" class="form-control" placeholder="City Name" name="city" value="$data->city">
                                                </div>
                                                <br>
                                                <div class="input-group">
                                                    <span  id="basic-addon1">Country Name</span>
                                                    <input type="text" class="form-control" placeholder="Country Name" name="country" value="$data->country">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span  id="basic-addon1">About</span>
                                                    <textarea type="text" class="form-control" name="about">$data->about</textarea>
                                                </div>
                                                <br>
                                            </div> --}}
                                            <input type="submit" class="btn btn-success" value="Lưu" id="edit_user_submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

                <div class="alert" id="message" style="display: none"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif