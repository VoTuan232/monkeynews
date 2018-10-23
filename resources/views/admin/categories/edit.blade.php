<div class="modal fade" id="editCategory" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Category</h4>
            </div>
            {!! Form::open(array('route' => 'categories.update','id'=> "frm-update")) !!}
             <div class="modal-body">
               {{ Form::label('name',"Tên chủ đề") }}
               {{ Form::text('name',null,array('class'=>'form-control', 'id' => 'name-update')) }}
               {{ Form::hidden('id-update',null,array('class'=>'form-control', 'id' => 'id-update')) }}
               <br>
               <br>
                  <span class="btn btn-info" data-toggle="modal" data-target="#showTreeCategory"><i class="far fa-eye"></i> Chọn chủ đề cha</span>
                  <span class="btn btn-info btn-info" id="clear-category"><i class="fas fa-eraser"></i>Xóa</span>
                  {{ Form::text('parent_id', null, ['class' => 'form-control', 'readonly' => 'true', 'id' => 'parent_id']) }}

                  <br>
                <br>
              <div class="alert" id="message-fail" style="display: none"></div>

                <p>Do you want to proceed?</p>
              </div>
            <div class="modal-footer">
                    {{ Form::submit('Yes',array('class'=>'btn danger'))}}
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
