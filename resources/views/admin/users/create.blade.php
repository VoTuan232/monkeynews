<div class="modal fade" id="showAddUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            {!! Form::open(array('route' => 'users.store', 'files' => true, 'id'=> "frm-insert")) !!}
                <div class="modal-body">
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('name',"Name") }}
                            {{ Form::text('name',null,array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('email',"Email") }}
                            {{ Form::email('email',null,array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('password',"Password") }}
                             {{ Form::password('password', ['class' => 'form-control col-md-12']) }}
                        </div>
                    </div>
                     <div class="col-3-md">
                        <div class="form-group">
                            {{ Form::label('password_confirmation',"Password Confirm") }}
                            {{ Form::password('password_confirmation', ['id' => 'password-confirm', 'class' => 'form-control col-md-12']) }}
                        </div>
                    </div>
                     
                    <div class="col-3-md">
                        <div class="form-group">
                           {{ Form::label('role', 'Role:') }}
                           {{-- {{ Form::select('role',  $roles->pluck('name', 'id') , null, ['class' => 'form-control', 'name'=>'role']) }}   --}}
                            <select type="text" name="role" id="role" class="form-control">
                                <option value="">------------------------</option>
                                @foreach($roles as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="alert" id="message" style="display: none"></div>    

                <div class="modal-footer">
                    {{ Form::submit('Create Post',array('class'=>'btn btn-success pull-left'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
