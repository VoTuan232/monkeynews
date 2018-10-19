<div class="show_comment_before_add"  style="margin-left:30px;">

</div>
@foreach($comments as $comment)
<div class="display-comment-<?php echo $comment->id;?>"  style="margin-left:30px;">
        <image src="/images/demo.jpg" class="img-tran">
        <strong>{{ $comment->user->name }}</strong>&nbsp;&nbsp;<small>{{ $comment->created_at }}</small>
        {{-- <i class="fa fa-lock"></i> --}}
        <div class="comment_option">
            <p style="margin-bottom: 8px;">{{ $comment->body }}</p>

            {{-- <a href="#">
              <span class="glyphicon glyphicon-thumbs-up"></span>
            </a>
            <a href="#">
              <span class="glyphicon glyphicon-thumbs-down"></span>
            </a> --}}
            <i class="far fa-thumbs-up like"></i>
            <i class="far fa-thumbs-down like"></i>
            <a href="" class="show_reply" data-id="{{ $comment->id }}">Trả lời</a>        
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

