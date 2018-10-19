<div class="modal fade" id="deleteTag" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            {{-- <div class="alert alert-danger" style="display:none"></div> --}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Tag</h4>
            </div>
            {!! Form::open(array('route' => 'tags.destroy','id'=> "frm-delete")) !!}
             <div class="modal-body">
               {{ Form::label('name',"Name") }}
               {{ Form::text('name',null,array('class'=>'form-control', 'readonly' => 'true')) }}
               {{ Form::hidden('id',null,array('class'=>'form-control', 'id' => 'id')) }}
               <br>
                <p>Do you want to continue?</p>
              </div>
            <div class="modal-footer">
                    {{ Form::submit('Yes',array('class'=>'btn danger'))}}
              {{-- <a href="#" id="btnYes" class="btn danger">Yes</a> --}}
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
