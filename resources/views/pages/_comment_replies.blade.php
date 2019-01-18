<div class="show_comment_before_add"  style="margin-left:30px;">

</div>

<div class="alert" id="message-destroy-comment" style="display: none"></div>

@foreach($comments as $comment)
<div class="display-comment-<?php echo $comment->id;?>"  style="margin-left:30px;">
        @if ($comment->user->avatar != null) 
            <image src="{{ $comment->user->avatar }}" class="img-tran">
        @else
            <image src="/images/anonymos.png" class="img-tran" >
        @endif
        <strong>{{ $comment->user->name }}</strong>&nbsp;&nbsp;<small>{{ $comment->created_at }}</small>
        <div class="comment_option">
            <p style="margin-bottom: 8px;">{{ $comment->body }}</p>

            <i class="fa fa-thumbs-up like">0</i>
            <i class="fa fa-thumbs-down like">0</i>
            @can('comment.edit')
            <a href="" class="edit" data-id="{{ $comment->id }}"><i class="fa fa-edit"></i>Sửa</a>  
            @endcan 
            @can('comment.delete')
            <a href="" class="delete" data-id="{{ $comment->id }}" data-post="{{ $post->id }}"><i class="fa fa-trash"></i>Xóa</a>  
            @endcan      
            <a href="" class="show_reply" data-id="{{ $comment->id }}"><i class="fa fa-reply"></i>Trả lời</a>        
        </div>

        <div class="frm-comment" id="comment-<?php echo $comment->id;?>">
            <form method="post" action="{{ route('comment.add') }}" id="frm-create-comment">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment_body" id="input-comment-<?php echo $comment->id;?>" class="form-control" onkeyup="checkCommentReply()"/>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>

                <div class="form-group">
                    <input type="button" class="btn btn-warning btn-sm close_comment"  value="Bỏ qua" />
                    <input type="submit" class="btn btn-warning btn-sm" value="Trả lời" placeholder="Trả lời ..." disabled id="send-reply-comment-<?php echo $comment->id;?>" />
                </div>
            </form>
        </div>
        @if($comment->replies->count() > 0)
        <a href="" class="reply_comment_option" data-id="{{ $comment->id }}" id="view-opion-<?php echo $comment->id;?>">Xem các câu trả lời</a>
        <div  class="reply-comment" id="reply-comment-<? echo $comment->id; ?>">
            @include('pages._comment_replies', ['comments' => $comment->replies])
        </div>
        @else
        @endif
</div>
    @endforeach
