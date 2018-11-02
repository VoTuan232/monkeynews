<script>
	$(".comment_option").on('click', '.delete', function(e) {
        e.preventDefault();
        // alert('hih');
         // $(".frm-comment").css('display', 'none');
        var comment_id = $(this).data('id');
     	var post_id = $(this).data('post');
     	 if(confirm("Bạn có tiếp tục muốn xóa?")) {
	            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/manager/comments/destroyComment',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, id: comment_id, post_id: post_id},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                        console.log(data.data);
                        // location.reload();
                       // document.getElementsByClassName('display-comment-'+comment_id).remove();
                    }
                }); 
    		}
    });
</script>