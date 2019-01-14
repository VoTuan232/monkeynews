@extends('admin.index')

@section('title', '|Comments')

@section('stylesheets')

    {!! Html::style('public/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
    {{-- datatable --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
@endsection

@section('main')

{{-- @include('admin.comments.js') --}}


    <div align="right">
        <button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Add</button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <table class="table border" id="manager_comment_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="studentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="student_form">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Add Data</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <span id="form_output"></span>
                        <div class="form-group">
                            <label>Enter First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Enter Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"
              integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
              crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#manager_comment_table').dataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/manager/comments/getComments",
                        "type": "GET"
                    },
                    "columns": [
                        { data: 'id', name: 'id' },
                        { data: 'title', name: 'title' },
                        { data: 'created_at', name: 'created_at' },
                        // { data: 'updated_at', name: 'updated_at' },
                    ]
                } );
            } );

            $('#add_data').click(function(){
                $('#studentModal').modal('show');
                // $('#student_form')[0].reset();
                // $('#form_output').html('');
                // $('#button_action').val('insert');
                // $('#action').val('Add');
            });
        </script>
@endsection