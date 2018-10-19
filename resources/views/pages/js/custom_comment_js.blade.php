<script>
    function checkComment() {
     if(document.getElementById("commment-body").value==="") { 
            document.getElementById('send-comment').disabled = true; 
        } else { 
            document.getElementById('send-comment').disabled = false;
        }
    }

    var id;
    function checkCommentReply() {
     if(document.getElementById("input-comment-"+id).value==="") { 
            document.getElementById('send-reply-comment-'+id).disabled = true; 
        } else { 
            document.getElementById('send-reply-comment-'+id).disabled = false;
        }
    }

    $(".frm-comment").css('display', 'none');
    $(".reply-comment").css('display', 'none');

    $(".show_reply").on('click', function(e) {
    	 e.preventDefault();
        $(".frm-comment").css('display', 'none');
         var comment_id = $(this).data('id');
         console.log(comment_id);
        $('#comment-'+comment_id).show();
         document.getElementById("input-comment-"+comment_id).focus();
         // checkCommentReply(comment_id);
         id = comment_id;
    })

    $(".close_comment").on('click', function(e) {
    	// alert('hihi');
    	 e.preventDefault();
    	$(".frm-comment").css('display', 'none');
    	 // var comment_id = $(this).data('id');
    	 // console.log(comment_id);
    	// $('#comment-'+comment_id).show();
    })

    $(".reply_comment_option").on('click', function(e) {
    	 e.preventDefault();
    	var reply_comment_id = $(this).data('id');
    	// $('.reply-comment-'+reply_comment_id).show();

    	var divelement = document.getElementById('reply-comment-'+reply_comment_id);

    	if(divelement.style.display == 'none') {
    		divelement.style.display = 'block';
            $('#view-opion-'+reply_comment_id).text('Ân câu trả lời');
        }
        else {

            divelement.style.display = 'none';
            $('#view-opion-'+reply_comment_id).text('Xem các câu trả lời');
    	}
	})
</script>