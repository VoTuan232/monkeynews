<div class="modal fade" id="editUser" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update User</h4>
            </div>
            {!! Form::open(array('route' => 'users.update','id'=> "frm-update")) !!}
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
                           {{ Form::label('role', 'Role:') }}
                           <select type="text" name="role" id="role" class="form-control">
                                <option value="">------------------------</option>
                                @foreach($roles as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>  
                        </div>
               </div>
              
               {{ Form::hidden('user_id',null,array('class'=>'form-control', 'id' => 'user_id')) }}
               {{ Form::hidden('posts',null,array('class'=>'form-control', 'id' => 'user_id')) }}

              <div class="alert" id="message-fail" style="display: none"></div>

              </div>

            <div class="modal-footer">
              {{ Form::submit('Update',array('class'=>'btn danger'))}}
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
