$(document).ready(function() {
        if(document.getElementById("commment-body").value==="") { 
            document.getElementById('send-comment').disabled = true; 
        } else { 
            document.getElementById('send-comment').disabled = false;
        }

    checkCommentReply();
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

    $(".comment_option").on('click', '.show_reply', function(e) {
        e.preventDefault();
         $(".frm-comment").css('display', 'none');
         var comment_id = $(this).data('id');
         $('#comment-'+comment_id).show();
         document.getElementById("input-comment-"+comment_id).focus();
         id = comment_id;
    });

    $(".close_comment").on('click', function(e) {
    	 e.preventDefault();
    	$(".frm-comment").css('display', 'none');
    })

    $(".reply_comment_option").on('click', function(e) {
    	 e.preventDefault();
    	var reply_comment_id = $(this).data('id');

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
});
