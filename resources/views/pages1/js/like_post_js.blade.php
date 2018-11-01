<script>
	var like =1;
    var first_status_post = $("#btn-like-post").data('like');
    console.log(first_status_post);
    if(first_status_post == 2) {
        document.getElementById("btn-like-post").title = "Bỏ like";
        document.getElementById("btn-like-post").style.backgroundColor= "#632222";

        document.getElementById("btn-dislike-post").title = "Dislike";
        document.getElementById("btn-dislike-post").style.backgroundColor= "#007bff";

        like = 2;
    }
    if(first_status_post == 0) {
        document.getElementById("btn-like-post").title = "Like";
        document.getElementById("btn-like-post").style.backgroundColor= "#007bff";

        document.getElementById("btn-dislike-post").title = "Bỏ Dislike";
        document.getElementById("btn-dislike-post").style.backgroundColor= "#632222";
        like =0;
    }


    $("#btn-like-post").on('click', function(e) {
    	 e.preventDefault();

        var post_id = $(this).data('id');
        // console.log(post_id);

        if(like != 2) {
            $.get('{{URL::to("state/posts/like")}}',{id:post_id},function(data){
                if(data.authenticated) {
                        console.log(data);
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.authenticated);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
                else {
                        document.getElementById("btn-like-post").title = "Remove Like";
                        document.getElementById("btn-like-post").style.backgroundColor= "#632222";
                        document.getElementById("btn-dislike-post").style.backgroundColor= "#007bff";

                        $("#number-like-post").text(data.post_data.like);
                        $("#number-dislike-post").text(data.post_data.dislike);

                        like = 2;
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.message);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
            })
        }

        else if(like == 2) {
            $.get('{{URL::to("state/posts/removeLike")}}',{id:post_id},function(data){
                        document.getElementById("btn-like-post").title = "Like";
                        document.getElementById("btn-like-post").style.backgroundColor= "#007bff";

                        $("#number-dislike-post").text(data.post_data.dislike);
                        $("#number-like-post").text(data.post_data.like);

                        like = 1;

                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.message);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
            })
        }
        
    })

    $("#btn-dislike-post").on('click', function(e) {
         e.preventDefault();

        var post_id = $(this).data('id');
        console.log(post_id);

        if(like != 0) {
            $.get('{{URL::to("state/posts/dislike")}}',{id:post_id},function(data){
                if(data.authenticated) {
                        console.log(data);
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.authenticated);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
                else {
                        document.getElementById("btn-dislike-post").title = "Bỏ Dislike";
                        document.getElementById("btn-dislike-post").style.backgroundColor= "#632222";
                        document.getElementById("btn-like-post").style.backgroundColor= "#007bff";

                        $("#number-like-post").text(data.post_data.like);
                        $("#number-dislike-post").text(data.post_data.dislike);

                        like = 0;
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.message);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
            })
        }

        else if(like == 0) {
            $.get('{{URL::to("state/posts/removeDislike")}}',{id:post_id},function(data){
                        document.getElementById("btn-dislike-post").title = "Dislike";
                        document.getElementById("btn-dislike-post").style.backgroundColor= "#007bff";

                        $("#number-dislike-post").text(data.post_data.dislike);
                        $("#number-like-post").text(data.post_data.like);

                        like = 1;

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