  <script type="text/javascript">

        $('#frm-insert').on('submit',function(e){
            e.preventDefault();
            var url=$(this).attr('action');
            var post=$(this).attr('method');
            console.log
            $.ajax({
                type: post,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    console.log(data);
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                    });

                    var user_id = data.user_data.user_id;
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
                $('#user-info').append(tr);

                }});
        });
    </script>

