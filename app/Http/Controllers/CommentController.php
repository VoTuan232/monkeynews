<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        // return $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if( Auth::user())
        {
                $comment = new Comment;
                $comment->body = $request->get('comment_body');
                $comment->user()->associate(Auth::user()->id);
                $comment->parent_id = $request->comment_id;
               
                $post = Post::find($request->get('post_id'));
                $post->comments()->save($comment);
                
                return back();
        }
        else {
            Session::flash('message', 'Bạn cần đăng nhập trước khi bình luận');
            return redirect()->route('login');
        }

    }
}
