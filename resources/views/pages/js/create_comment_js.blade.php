{{-- <script>
	$('#frm-create-comment').on('submit', function(e){
		e.preventDefault();
		// alert('hiihi');
		var url=$(this).attr('action');
        var post=$(this).attr('method');

         $.ajax({
                type: post,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    // console.log(data.comment.commentable_id);
                    document.getElementById("commment-body").value = "";
                	// console.log(data);
                	// $( ".show_comment_before_add" ).prepend("<image src='/images/demo.jpg' class='img-tran'>").prepend('<strong>'+data.user_name+'</strong>&nbsp;&nbsp;<small>'+data.comment.created_at+'</small>').append('<div class="comment_option"><p style="margin-bottom: 8px;">'+data.comment.body+'</p><a href="" class="show_reply" data-id="'+data.comment.id+'">Trả lời</a> </div>');
                    $( ".show_comment_before_add" ).prepend('<image src="/images/demo.jpg" class="img-tran"><strong>'+data.user_name+'</strong>&nbsp;&nbsp;<small>'+data.comment.created_at+'</small><div class="comment_option"><p style="margin-bottom: 8px;">'+data.comment.body+'</p><a href="" class="show_reply" data-id='+data.comment.id+'>Trả lời</a> </div><div class="frm-comment"  id="comment-'+data.comment.id+'"><form method="post" action="{{ route('comment.add') }}" id="frm-create-comment">@csrf<div class="form-group"><input type="text" name="comment_body" id="input-comment-'+data.comment.id+'" class="form-control"  onkeyup="checkCommentReply()"/><input type="hidden" name="post_id" value="'+data.comment.commentable_id+'" /><input type="hidden" name="comment_id" value="'+data.comment.id+'" /></div><div class="form-group"><input type="button" class="btn btn-warning btn-sm close_comment"  value="Bỏ qua" /><input type="submit" class="btn btn-warning btn-sm" value="Trả lời" placeholder="Trả lời ..." disabled id="send-reply-comment-'+data.comment.id+'" /></div></form></div>');
                    }
            })
	})
</script>

 --}}