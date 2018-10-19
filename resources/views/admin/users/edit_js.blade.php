<script>
   $(document).on('click','#edit',function(e){
            var id=$(this).data('id');
            console.log(id);
            $.get("{{ URL::to('manager/users/edit')}}", {id: id}, function(data){
                console.log(data);
                $('#frm-update').find('#user_id').val(data.user_data.user_id)
                $('#frm-update').find('#name').val(data.user_data.username)
                $('#frm-update').find('#email').val(data.user_data.email)
                $('#frm-update').find('#role').val(data.user_data.role_id)
                $('#frm-update').find('#posts').val(data.user_data.post_number)
                $('#editUser').modal('show');
            })
  })
   
    $('#frm-update').on('submit',function(e){
            e.preventDefault();
            // var id=document.getElementById("id-update").value;
            // var name=document.getElementById("name-update").value;
            // var parent_name=document.getElementById("parent_id").value;
            // console.log(id);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            // var method = new FormData(this);
            // console.log(method);
            
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
            // 
            // $.post('@{{ URL::to("manager/users/update") }}',{data :},function(data){
            //     console.log(data);
            //     //     if(data.category)
            //     //     {

            //     //     var tr=$("<tr/>",{
            //     //     id:data.category.id
            //     // });
            //     //     tr.append($("<th/>",{
            //     //         text : data.category.id
            //     //     })).append($("<td/>",{
            //     //         text : data.category.name
                        
            //     //     })).append($("<td/>",{
            //     //         text : data.parent_name
                        
            //     //     })).append($("<td/>",{
            //     //         html : '<a href="#" class="btn btn-info btn-xs" id="view" data-id="'+data.category.id+'">View </a> ' + 
            //     //             '<a href="#" class="btn btn-success btn-xs" id="edit" data-id="'+data.category.id+'">Edit </a> ' +
            //     //             '<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="'+data.category.id+'">Delete </a> ' 
            //     //     }))

            //     //         $('#category-info tr#'+data.category.id).replaceWith(tr);
            //     //         $('#editCategory').modal('hide');
            //     //         $('#message').css('display', 'block');
            //     //         $('#message').html(data.message);
            //     //         $('#message').addClass(data.class_name);
            //     //     }

            //     //     else{
            //     //         $('#message-fail').css('display', 'block');
            //     //         $('#message-fail').html(data.message);
            //     //         $('#message-fail').addClass(data.class_name);
            //     //     }




            // })
        })      
</script>