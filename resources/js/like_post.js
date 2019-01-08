	var like =1;
    var first_status_post = $("#btn-like-post").data('like');
    if(first_status_post == 2) {
        document.getElementById("btn-like-post").title = "Bỏ like";
        document.getElementById("btn-like-post").style.backgroundColor= "#e40a0a";

        document.getElementById("btn-dislike-post").title = "Dislike";
        document.getElementById("btn-dislike-post").style.backgroundColor= "#007bff";

        like = 2;
    }
    if(first_status_post == 0) {
        document.getElementById("btn-like-post").title = "Like";
        document.getElementById("btn-like-post").style.backgroundColor= "#007bff";

        document.getElementById("btn-dislike-post").title = "Bỏ Dislike";
        document.getElementById("btn-dislike-post").style.backgroundColor= "#e40a0a";
        like =0;
    }

    $("#btn-like-post").on('click', function(e) {
    	 e.preventDefault();

        var post_id = $(this).data('id');

        if(like != 2) {
            $.get('state/posts/like',{id:post_id},function(data){
                if(data.authenticated) {
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.authenticated);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
                else {
                        document.getElementById("btn-like-post").title = "Remove Like";
                        document.getElementById("btn-like-post").style.backgroundColor= "#e40a0a";
                        document.getElementById("btn-dislike-post").title = "Dislike";
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
            $.get('state/posts/removeLike',{id:post_id},function(data){
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
        if(like != 0) {
            $.get('state/posts/dislike',{id:post_id},function(data){
                if(data.authenticated) {
                        $('#message-state-post').css('display', 'block');
                        $('#message-state-post').html(data.authenticated);
                        $('#message-state-post').addClass(data.class_name);

                        $("#message-state-post").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-state-post").slideUp(500);
                        });
                }
                else {
                        document.getElementById("btn-dislike-post").title = "Bỏ Dislike";
                        document.getElementById("btn-dislike-post").style.backgroundColor= "#e40a0a";
                        document.getElementById("btn-like-post").style.backgroundColor= "#007bff";

                        document.getElementById("btn-like-post").title = "Like";

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
            $.get('state/posts/removeDislike',{id:post_id},function(data){
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
