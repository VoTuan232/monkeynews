<script>
   $(document).on('click','#edit',function(e){
            var id=$(this).data('id');
            console.log(id);
            $.get("{{ URL::to('manager/users/edit')}}", {id: id}, function(data) {
                $('#frm-update').find('#user_id').val(data[0].id)
                $('#frm-update').find('#name').val(data[0].name)
                $('#frm-update').find('#email').val(data[0].email)
                if(data[0].roles[0]) {
                    $('#frm-update').find('#role').val(data[0].roles[0].id)
                }
                else {
                    $('#frm-update').find('#role').val(0)
                }
                // $('#frm-update').find('#posts').val(data.user_data.posts);
                $('#editUser').modal('show');
            })
  })
   
    $('#frm-update').on('submit',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            
            $.ajax({
                type: method,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    console.log(data); 
                     if(data.user_data)
                    {

                    var tr=$("<tr/>",{
                    id:data.user_data.id
                });
                    tr.append($("<td/>",{
                        text : data.user_data.user_id
                    })).append($("<td/>",{
                        text : data.user_data.username
                    })).append($("<td/>",{
                        text : data.user_data.email
                 })).append($("<td/>",{
                        text : data.user_data.role_name
                    })).append($("<td/>",{
                        text : 0
                    })).append($("<td/>",{
                        html : '<a href="#" class="btn btn-info btn-xs" id="view" data-id="'+data.user_data.id+'">View </a> ' + 
                            '<a href="" class="btn btn-success btn-xs" id="edit" data-id="'+data.user_data.id+'">Edit </a> ' +
                            '<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="'+data.user_data.id+'">Delete </a>' 
                    }))

                        $('#user-info tr#'+data.user_data.user_id).replaceWith(tr);
                        
                        $('#editUser').modal('hide');
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                         $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                        });
                    }

                    else{
                        $('#message-fail').css('display', 'block');
                        $('#message-fail').html(data.message);
                        $('#message-fail').addClass(data.class_name);
                         $("#message-fail").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-fail").slideUp(500);
                     });
                    }                   
                }
            })
        })      
</script>