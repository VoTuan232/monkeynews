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

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //  public function store(Request $request)
    // {
    //     if(is_null(Auth::user())) {
    //         return response()->json([
    //             'authenticated' => 'Bạn cần đăng nhập mới lưu được bài post này',
    //             'class_name' => 'alert-danger',
    //         ]);
    //     }
    //     else {
    //         $comment = new Comment;
    //         $comment->body = $request->get('comment_body');
    //         $comment->user()->associate(Auth::user()->id);
    //         if(!is_null($request->comment_id))
    //         {
    //             $comment->parent_id = $request->comment_id;
    //         }
    //         $post = Post::find($request->get('post_id'));
    //         $post->comments()->save($comment);

    //         return response()->json([
    //             'comment' => $comment,
    //             'user_name' => $comment->user->name,
    //         ]);
    //     }
    // }

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

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
