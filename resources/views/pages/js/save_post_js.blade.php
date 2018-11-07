<script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
    });

    var save =false;
    var first_status_post = $("#btn-save-post").data('save');
    if(first_status_post == 1) {
        document.getElementById("btn-save-post").title = "Unsave";
        document.getElementById("btn-save-post").style.backgroundColor= "#e40a0a";
        save = true;
    }
    if(first_status_post == 0) {
        document.getElementById("btn-save-post").title = "Save";
        document.getElementById("btn-save-post").style.backgroundColor= "#007bff";
        save =false;
    }


    $("#btn-save-post").on('click', function(e) {
    	 e.preventDefault();
        var post_id = $(this).data('id');

        if(save == false) {
            $.get('{{URL::to("storages/posts/save")}}',{id:post_id},function(data){
                if(data.authenticated) {
                        console.log(data);
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.authenticated);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
                else{
                        document.getElementById("btn-save-post").title = "Unsave";
                        document.getElementById("btn-save-post").style.backgroundColor= "#632222";
                        save = true;
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.message);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });

                }
            })
        }

        else if(save == true) {
            $.get('{{URL::to("storages/posts/remove")}}',{id:post_id},function(data){
                        document.getElementById("btn-save-post").title = "Save";
                        document.getElementById("btn-save-post").style.backgroundColor= "#007bff";
                        save = false;

                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.message);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
            })
        }
        
    })
</script>