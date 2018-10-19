<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        return $this->middleware('auth');
    }

    public function index()
    {
        //
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
    
    //dung ajax
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $comment = new Comment;
    //     $comment->body = $request->get('comment_body');
    //     $comment->user()->associate(Auth::user()->id);
    //     if(!is_null($request->comment_id))
    //     {
    //         $comment->parent_id = $request->comment_id;
    //     }
    //     // $comment->user()->associate($request->user()); //cap nhat moi quan he belogsTo => set khoa ngoai cua model con, neu la disassociate thi 
    //     //https://viblo.asia/p/eloquent-relationships-in-laravel-phan-3-MJykjmxyePB
    //     $post = Post::find($request->get('post_id'));
    //     $post->comments()->save($comment);

    //     return response()->json([
    //         'comment' => $comment,
    //         'user_name' => $comment->user->name,
    //     ]);
    // }

//ko dung ajax
    public function store(Request $request)
    {
            $comment = new Comment;
            $comment->body = $request->get('comment_body');
            $comment->user()->associate(Auth::user()->id);
            $comment->parent_id = $request->comment_id;
            // $comment->user()->associate($request->user()); //cap nhat moi quan he belogsTo => set khoa ngoai cua model con, neu la disassociate thi 
            //https://viblo.asia/p/eloquent-relationships-in-laravel-phan-3-MJykjmxyePB
            $post = Post::find($request->get('post_id'));
            $post->comments()->save($comment);
            
            return back();

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
